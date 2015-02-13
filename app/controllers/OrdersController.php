<?php
use MrJuliuss\Syntara\Controllers;

class OrdersController extends BaseController
{

    /**
     * Display a listing of the resource.
     * GET /orders
     *
     * @return Response
     */
    public function index()
    {

        $this->layout = View::make('orders.index');
        $this->layout->title = 'Orders';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Orders',
                'link' => URL::route('ListOrders'),
                'icon' => 'glyphicon-home'
            ),

        );
        $columns = Order::orderAllowedCol(Utility::getUserType());
        $this->layout->columns = Utility::underscoreToSpace($columns);

    }

    /**
     * Show the form for creating a new resource.
     * GET /orders/create
     *
     * @return Response
     */
    public function create()
    {

        $this->layout = View::make('orders.create');
        $this->layout->title = 'Create an Order';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'Orders',
                'link' => URL::route('ListOrders'),
                'icon' => 'glyphicon-user'
            ),
            array(
                'title' => 'Create',
                'link' => URL::route('CreateOrders'),
                'icon' => 'glyphicon-plus-sign'
            ),

        );
        $this->layout->products = Product::all()->lists('name', 'id');
    }

    /**
     * Store a newly created resource in storage.
     * POST /orders
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'client' => 'required',
            'sale_price' => 'required',
            'product_list' => 'required',
            'amount_paid' => 'required',
        );

        $validator = Validator::make($data = Input::all(), Order::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::except('password'));
        } else {
            $order = new Order;
            $order->order_date = date('Y-m-d');
            $order->due_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', Input::get('due_date'))));
            $order->client = $data['client'];
            $order->sale_price = $data['sale_price'];
            $order->amount_paid = $data['amount_paid'];
            $order->outstanding = $data['sale_price'] - $data['amount_paid'];
            $order->status = 'TA';
            $order->instructions = $data['instructions'];
            $order->course_outline = $data['course_outline'];
            $order->lecture_notes = $data['lecture_notes'];
            $order->additional_materials = $data['additional_materials'];
            $order->salesman_id = Sentry::getUser()->getId();
            $order->product_name = $data['product_name'];

            $data = array_merge($order->toArray(), Sentry::getUser()->toArray());
            if ($order->save()) {
                // send email to manager
                Mail::queue('emails.new-order-manager', $data, function ($message) {
                    $message->from(Config::get('syntara::mails.email'), Config::get('syntara::mails.contact'))
                        ->subject(Config::get('syntara::mails.new-order-manager-subject'));
                    $message->to(Config::get('syntara::mails.new-order-manager'));
                });
                Session::flash('message', 'Email has been send to Manager.');
            }

            Session::flash('message', 'Order has been created successfully');
            return Redirect::route('ListOrders');
        }
    }

    /**
     * Display the specified resource.
     * GET /orders/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /orders/{id}/edit
     *
     * @param  int $id
     * @return Response
     */

    public function details($id)
    {

        $order = Order::findOrFail($id);
        if ($order->writer_id) {
            $writer = Sentry::getUserProvider()->findById($order->writer_id);
            $order->writer = $writer->first_name . ' ' . $writer->last_name;
        }
        $this->layout = View::make('orders.details')->with('orders', $order);
        $groups = array('Select');
        array_map(function ($item) use (&$groups) {
            if ($item->name == 'Writer' || $item->name == 'QC')
                $groups[$item->id] = $item->name;
        }, Sentry::getGroupProvider()->findAll());

        $this->layout->type = $groups;
        $this->layout->orderFields = Order::orderAllowedCol(Utility::getUserGroup(), false);
        $this->layout->title = 'Orders Details';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'Orders',
                'link' => URL::route('ListOrders'),
                'icon' => 'glyphicon-user'
            ),
            array(
                'title' => 'Details',
                'link' => URL::route('DetailsOrders', $id),
                'icon' => 'glyphicon-eye-open'
            ),
        );


    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /orders/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /orders/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function datatable()
    {
        $userType = Utility::getUserType();
        $col = Order::orderAllowedCol($userType);
        return Datatable::collection(Order::all(array_merge($col, array('writer_id'))))
            ->showColumns($col)
            ->addColumn('model', function ($model) {
                return '<a href="' . URL::route('DetailsOrders', $model->id) . '">Details</a>';
            })
            ->addColumn('writer', function ($order) {
                if ($order->writer_id) {
                    $writer = Sentry::getUserProvider()->findById($order->writer_id);
                    return $writer->first_name . ' ' . $writer->last_name;
                } else
                    return '';
            })
            ->searchColumns($col)
            ->orderColumns($col)
            ->make();
    }

    public function getWriterQc()
    {

        $groupId = Input::get('type');
        $group = Sentry::getGroupProvider()->findById($groupId);
        $list = Sentry::getUserProvider()->findAllInGroup($group);
        $users = array();
        foreach ($list as $user) {
            $users[$user->getId()] = $user->first_name . ' ' . $user->last_name;
        }
        return $users;
    }

    public function assignWriterQc($id)
    {
        $orderId = $id;
        $order = Order::find($orderId);
        $userId = Input::get('user');
        $user = Sentry::getUserProvider()->findById($userId);
        $userGroup = Sentry::getGroupProvider()->findById(Input::get('type'));
        $msg = 'You have an invitation on order <a href="' . URL::route('ShowOrders', ['id' => $orderId]) . '">click</a><br/>' . Input::get('comment');
        //create message
        Message::create([
            'to' => $userId,
            'from' => Sentry::getUser()->getId(),
            'msg' => $msg
        ]);
        //send email to writer
        $data = array();
        if ($userGroup->name == 'Writer') {
            //$order->writer_id = $userId;
            $order->status = 'AC';
            $emailTemplate = 'emails.invitation-to-writer';
        } elseif ($userGroup->name == 'QC') {
            //$order->qc_id = $userId;
            $order->status = 'QC';
            $emailTemplate = 'emails.assign-to-qc';
        }

        //add to invitation table
        Invitation::create([
            'order_id' => $orderId,
            'user_id' => $userId
        ]);

        $data['name'] = $user->first_name . ' ' . $user->last_name;
        $data['id'] = $orderId;

        if ($order->save()) {
            // send email to manager
            Mail::queue($emailTemplate, $data, function ($message) use ($user) {
                $message->from(Config::get('syntara::mails.email'), Config::get('syntara::mails.contact'))
                    ->subject('You have an invitation');
                $message->to($user->email);
            });
            //Session::flash('message', 'Email has been send to Manager.');
        }
        echo json_encode(['success' => 1, 'msg' => 'Ok']);
        exit;
    }

    public function getInvitations($orderId)
    {
        $order = Order::find($orderId);
        $html = View::make('orders.invitations', ['order' => $order])->render();
        echo $html;
        exit;
    }

    public function documenList($orderId)
    {
        $order = Order::find($orderId);
        $html = View::make('orders.docs_and_discussions', ['order' => $order])->render();
        echo $html;
        exit;
    }

    public function deleteInvitaion($orderId, $invitationId)
    {
        $invitationId = Invitation::find($invitationId);
        $data = array();
        if ($invitationId->delete())
            $data['success'] = 1;
        else
            $data['success'] = 0;

        echo $data['success'];
        exit;

    }

    public function uploadDoc($orderId)
    {
        $order = Order::findOrFail($orderId);
        $user = Sentry::getUser();
        $comment = Input::get('comment');
        $upload = false;
        $fileName = '';
        if (Input::hasFile('doc')) {
            $doc = Input::file('doc');
            $fileName = time() . '_' . $doc->getClientOriginalName();
            $file = $doc->move(public_path() . '/upload/', $fileName);
            $upload = true;
        }
        //create document
        Document::create([
            'order_id' => $orderId,
            'user_id' => $user->getId(),
            'comment' => $comment,
            'file_name' => $fileName
        ]);

        //send mail to manager
        $userName = $user->first_name . ' ' . $user->last_name;
        $subject = $userName . ' has updated docs and discussion on Order #' . $orderId;

        $emailData = ['subject' => $subject, 'orderId' => $orderId, 'user' => $userName];

        Mail::queue('emails.order_document_uploaded', $emailData, function ($message) use ($emailData) {
            $message->from(Config::get('syntara::mails.email'), Config::get('syntara::mails.contact'))
                ->subject($emailData['subject']);
            $message->to(Config::get('syntara::mails.new-order-manager'));
        });

        //redirect to details page
        return Redirect::route('DetailsOrders', ['id' => $orderId])->with('message', 'Successfully submitted');
    }

    public function processInvitation($orderId)
    {
        $order = Order::findOrFail($orderId);
        $user = Sentry::getUser();
        $userId = $user->getId();
        $userType = strtolower(Utility::getUserGroup());
        $action = Input::get('action');

        $invitation = Invitation::where('order_id', '=', $orderId)->where('user_id', '=', $userId);
        if ($userType == 'writer')
            $invitation->where('status', '=', 0);

        $orderField = $userType . '_id';
        $invitation = $invitation->first();

        $data = [];
        if ($invitation) {
            $invitation->status = $action;
            $invitation->save();
            //update order table
            $order->{$orderField} = $userId;
            $order->status = $action ? 'AC' : 'Rejected';
            $order->save();

            //Send Email to Manager and Writer
            $writerName = $user->first_name . ' ' . $user->last_name;
            $subject = 'Writer' . $writerName . ' has accepted Order #' . $orderId;
            $emailData = ['subject' => $subject, 'orderId' => $orderId, 'writer' => $writerName];
            Mail::queue('emails.writer-accept-invitation', $emailData, function ($message) use ($emailData) {
                $message->from(Config::get('syntara::mails.email'), Config::get('syntara::mails.contact'))
                    ->subject($emailData['subject']);
                $message->to(Config::get('syntara::mails.new-order-manager'));
            });

            $data['success'] = 1;
        } else
            $data['success'] = 0;

        return Response::json($data);
        exit;
    }
}
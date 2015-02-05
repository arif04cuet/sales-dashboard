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
        $orders = Order::findOrFail($id);
        $this->layout = View::make('orders.details')->with('orders', $orders);
        $this->layout->type = array(4 => 'Writer', 5 => 'Qcs');
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
        return Datatable::collection(Order::all($col))
            ->showColumns($col)
            ->addColumn('model', function ($model) {
                return '<a href="' . URL::route('DetailsOrders', $model->id) . '">Details</a>';
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

        //create message

        //send email to writer

        //changes order status
    }

}
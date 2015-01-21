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
                'link' => 'dashboard/orders',
                'icon' => 'glyphicon-home'
            ),

        );

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
                'link' => Config::get("syntara::config.uri") . '/orders',
                'icon' => 'glyphicon-user'
            ),
            array(
                'title' => 'Create',
                'link' => Config::get("syntara::config.uri") . '/orders/create',
                'icon' => 'glyphicon-plus-sign'
            ),

        );
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
            'order_date' => 'required',
            'client' => 'required',
            'fee' => 'required'
        );

        $validator = Validator::make($data = Input::all(), Order::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::except('password'));
        } else {
            $order = new Order;
            $order->order_date = date('Y-m-d', strtotime($data['order_date']));
            $order->client = $data['client'];
            $order->fee = $data['fee'];
            $order->save();

            Session::flash('message', 'Successfully created an order.');
            return Redirect::to(Config::get('syntara::config.uri') . '/orders');
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
        $userType = 1;
        $col = Utility::orderAllowedCol($userType);
        return Datatable::collection(Order::all($col))
            ->showColumns($col)
            ->searchColumns($col)
            ->orderColumns($col)
            ->make();
    }

}
<?php

class ProductsController extends \BaseController {

	/**
	 * Display a listing of products
	 *
	 * @return Response
	 */
	public function index()
	{
        $this->layout = View::make('products.index', compact('qcs'));
        $this->layout->title = 'Products';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'Products',
                'link' => URL::route('ListProducts'),
                'icon' => 'glyphicon-user'
            ),
        );
	}

	/**
	 * Show the form for creating a new product
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->layout = View::make('products.create');
        $this->layout->title = 'Add New Products';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'Products',
                'link' => URL::route('ListProducts'),
                'icon' => 'glyphicon-user'
            ),
            array(
                'title' => 'Create',
                'link' => URL::route('CreateProducts'),
                'icon' => 'glyphicon-plus-sign'
            ),

        );
	}

	/**
	 * Store a newly created product in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = array(
            'name' => 'required',
            'price' => 'required'
        );

        $validator = Validator::make($data = Input::all(), Order::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::except('password'));
        } else {
            $product = new Product;
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->save();

            Session::flash('message', 'Successfully added a product.');
            return Redirect::route('ListProducts');
        }
	}

	/**
	 * Display the specified product.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $products = Product::findOrFail($id);
        $this->layout = View::make('products.show')->with('products', $products);
        $this->layout->title = 'Show Products';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'Products',
                'link' => URL::route('ListProducts'),
                'icon' => 'glyphicon-user'
            ),
            array(
                'title' => 'Show',
                'link' => URL::route('ShowProducts',$id),
                'icon' => 'glyphicon-eye-open'
            ),

        );
	}

	/**
	 * Show the form for editing the specified product.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $products = Product::find($id);
        $this->layout = View::make('products.edit')->with('products', $products);
        $this->layout->title = 'Edit Products';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'Products',
                'link' => URL::route('ListProducts'),
                'icon' => 'glyphicon-user'
            ),
            array(
                'title' => 'Edit',
                'link' => URL::route('EditProducts', $id),
                'icon' => 'glyphicon-eye-open'
            ),

        );
	}

	/**
	 * Update the specified product in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $rules = array(
            'name' => 'required',
            'price' => 'required'
        );

        $validator = Validator::make($data = Input::all(), Order::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::except('password'));
        } else {
            $product = Product::findOrFail($id);
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->save();

            Session::flash('message', 'Successfully updated a product.');
            return Redirect::route('ListProducts');
        }
	}

	/**
	 * Remove the specified product from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $products = Product::find($id);
        $products->delete();

        Session::flash('message','Successfully deleted a Product.');
        return Redirect::route('ListProducts');
	}

    public function datatable()
    {
        return Datatable::collection(Product::all(array('id', 'name', 'price')))
            ->showColumns('id', 'name', 'price')
            ->addColumn('action', function ($model) {
                return Utility::createActionBtn($model, $route='Products');
            })
            ->searchColumns('id', 'name', 'price')
            ->orderColumns('id', 'name', 'price')
            ->make();
    }

}

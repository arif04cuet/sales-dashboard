<?php

class WritersController extends \BaseController
{

    /**
     * Display a listing of writers
     *
     * @return Response
     */
    public function index()
    {

        //$writers = Writer::all();
        //return View::make('writers.index', compact('writers'));
        $this->layout = View::make('writers.index');
        $this->layout->title = 'Writers';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'Writers',
                'link' => URL::route('ListWriters'),
                'icon' => 'glyphicon-user'
            ),

        );
    }

    /**
     * Show the form for creating a new writer
     *
     * @return Response
     */
    public function create()
    {
        $this->layout = View::make('writers.create');
        $this->layout->title = 'Add New Writers';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'Writers',
                'link' => URL::route('ListWriters'),
                'icon' => 'glyphicon-user'
            ),
            array(
                'title' => 'Add New',
                'link' => URL::route('CreateWriters'),
                'icon' => 'glyphicon-plus-sign'
            ),

        );
    }

    /**
     * Store a newly created writer in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'rate' => 'required',
        );

        $validator = Validator::make($data = Input::all(), Writer::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::except('password'));
        } else {
            $writer = new Writer;
            $writer->name = $data['name'];
            $writer->email = $data['email'];
            $writer->mobile = $data['mobile'];
            $writer->rate = $data['rate'];
            $writer->save();

            Session::flash('message', 'Successfully added a writer.');
            //return Redirect::route('writers.index');
            return Redirect::route('ListWriters');
        }
    }

    /**
     * Display the specified writer.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

        $writers = Writer::find($id);
        $this->layout = View::make('writers.show')->with('writers',$writers);
        $this->layout->title = 'Show Writers';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'Writers',
                'link' => URL::route('ListWriters'),
                'icon' => 'glyphicon-user'
            ),
            array(
                'title' => 'Show',
                'link' => URL::route('ShowWriters',$id),
                'icon' => 'glyphicon-eye-open'
            ),

        );
    }

    /**
     * Show the form for editing the specified writer.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $writers = Writer::find($id);
        $this->layout = View::make('writers.edit')->with('writers',$writers);
        $this->layout->title = 'Edit Writers';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'Writers',
                'link' => URL::route('ListWriters'),
                'icon' => 'glyphicon-user'
            ),
            array(
                'title' => 'Edit',
                'link' => URL::route('EditWriters',$id),
                'icon' => 'glyphicon-pencil'
            ),

        );
    }

    /**
     * Update the specified writer in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'rate' => 'required',
        );

        $validator = Validator::make($data = Input::all(), Writer::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::except('password'));
        } else {
            $writer = Writer::find($id);
            $writer->name = $data['name'];
            $writer->email = $data['email'];
            $writer->mobile = $data['mobile'];
            $writer->rate = $data['rate'];
            $writer->save();

            Session::flash('message', 'Successfully updated a writer.');
            return Redirect::route('ListWriters');
        }
    }

    /**
     * Remove the specified writer from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        /*Writer::destroy($id);
        return Redirect::route('writers.index');*/

        $writers = Writer::find($id);
        $writers->delete();

        Session::flash('message','Successfully deleted a writer.');
        return Redirect::route('ListWriters');
    }

    public function datatable()
    {
        return Datatable::collection(Writer::all(array('id', 'name', 'email', 'mobile', 'rate')))
            ->showColumns('id', 'name', 'email', 'mobile', 'rate')
            ->addColumn('action', function ($model) {
                return Utility::createActionBtn($model, $route='Writers');
            })
            ->searchColumns('id', 'name', 'email', 'mobile', 'rate')
            ->orderColumns('id', 'name', 'email', 'mobile', 'rate')
            ->make();
    }

}

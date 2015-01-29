<?php

class QcsController extends \BaseController
{

    /**
     * Display a listing of qcs
     *
     * @return Response
     */
    public function index()
    {
        $this->layout = View::make('qcs.index', compact('qcs'));
        $this->layout->title = 'Quality Controllers';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'QC',
                'link' => URL::route('ListQc'),
                'icon' => 'glyphicon-user'
            ),
        );
    }

    /**
     * Show the form for creating a new qc
     *
     * @return Response
     */
    public function create()
    {
        $this->layout = View::make('qcs.create');
        $this->layout->title = 'Add New Quality Controllers';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'QC',
                'link' => URL::route('ListQc'),
                'icon' => 'glyphicon-user'
            ),
            array(
                'title' => 'Add New',
                'link' => URL::route('CreateQc'),
                'icon' => 'glyphicon-plus-sign'
            ),

        );
    }

    /**
     * Store a newly created qc in storage.
     *
     * @return Response
     */
    public function store()
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'rate' => 'required',

        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::route(Config::get('syntara::config.uri') . 'qc.create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            // store
            $qc = new Qc();
            $qc->name = Input::get('name');
            $qc->email = Input::get('email');
            $qc->mobile = Input::get('mobile');
            $qc->rate = Input::get('rate');
            $qc->save();

            // redirect
            Session::flash('message', 'Successfully added a QC');
            return Redirect::route('ListQc');
        }

    }

    /**
     * Display the specified qc.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $qc = Qc::findOrFail($id);
        $this->layout = View::make('qcs.show')->with('qc',$qc);
        $this->layout->title = 'Show Quality Controllers';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'QC',
                'link' => URL::route('ListQc'),
                'icon' => 'glyphicon-user'
            ),
            array(
                'title' => 'Show',
                'link' => URL::route('ShowQc',$id),
                'icon' => 'glyphicon-eye-open'
            ),

        );
    }

    /**
     * Show the form for editing the specified qc.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $qc = Qc::find($id);
        $this->layout = View::make('qcs.edit')->with('qc',$qc);
        $this->layout->title = 'Edit Quality Controllers';
        $this->layout->breadcrumb = array(
            array(
                'title' => 'Dashboard',
                'link' => Config::get("syntara::config.uri"),
                'icon' => 'glyphicon-home'
            ),
            array(
                'title' => 'QC',
                'link' => URL::route('ListQc'),
                'icon' => 'glyphicon-user'
            ),
            array(
                'title' => 'Edit',
                'link' => URL::route('EditQc',$id),
                'icon' => 'glyphicon-eye-open'
            ),

        );
    }

    /**
     * Update the specified qc in storage.
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

        $validator = Validator::make($data = Input::all(), Qc::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::except('password'));
        } else {
            $qc = Qc::find($id);
            $qc->name = $data['name'];
            $qc->email = $data['email'];
            $qc->mobile = $data['mobile'];
            $qc->rate = $data['rate'];
            $qc->save();

            Session::flash('message', 'Successfully updated a QC.');
            return Redirect::route('ListQc');
        }
    }

    /**
     * Remove the specified qc from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $qc = Qc::find($id);
        $qc->delete();

        Session::flash('message','Successfully deleted a QC.');
        return Redirect::route('ListQc');
    }

    public function datatable()
    {
        return Datatable::collection(Qc::all(array('id', 'name', 'email', 'mobile', 'rate')))
            ->showColumns('id', 'name', 'email', 'mobile', 'rate')
            ->addColumn('action', function ($model) {
                return Utility::createActionBtn($model, $route='Qc');
            })
            ->searchColumns('id', 'name', 'email', 'mobile', 'rate')
            ->orderColumns('id', 'name', 'email', 'mobile', 'rate')
            ->make();
    }
}

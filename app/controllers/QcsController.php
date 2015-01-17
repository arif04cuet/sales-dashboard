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
        $qcs = Qc::all();

        return View::make('qcs.index', compact('qcs'));
    }

    /**
     * Show the form for creating a new qc
     *
     * @return Response
     */
    public function create()
    {
        return View::make('qcs.create');
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
            Session::flash('message', 'Successfully added QC');
            return Redirect::to(Config::get('syntara::config.uri') . 'qc');
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

        return View::make('qcs.show', compact('qc'));
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

        return View::make('qcs.edit', compact('qc'));
    }

    /**
     * Update the specified qc in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $qc = Qc::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Qc::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $qc->update($data);

        return Redirect::route('qcs.index');
    }

    /**
     * Remove the specified qc from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Qc::destroy($id);

        return Redirect::route('qcs.index');
    }

}

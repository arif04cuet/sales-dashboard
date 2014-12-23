<?php

class WritersController extends \BaseController {

	/**
	 * Display a listing of writers
	 *
	 * @return Response
	 */
	public function index()
	{
		$writers = Writer::all();

		return View::make('writers.index', compact('writers'));
	}

	/**
	 * Show the form for creating a new writer
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('writers.create');
	}

	/**
	 * Store a newly created writer in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Writer::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Writer::create($data);

		return Redirect::route('writers.index');
	}

	/**
	 * Display the specified writer.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$writer = Writer::findOrFail($id);

		return View::make('writers.show', compact('writer'));
	}

	/**
	 * Show the form for editing the specified writer.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$writer = Writer::find($id);

		return View::make('writers.edit', compact('writer'));
	}

	/**
	 * Update the specified writer in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$writer = Writer::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Writer::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$writer->update($data);

		return Redirect::route('writers.index');
	}

	/**
	 * Remove the specified writer from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Writer::destroy($id);

		return Redirect::route('writers.index');
	}

}

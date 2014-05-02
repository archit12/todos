<?php

class TodosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		$email = Session::get('email');
		foreach (User::with('todos')->get() as $user) {
			if ($user->email == $email) {
				return Response::json($user);
				//return $user->todos->toJSON();
			}
		}
	}

	public function check()
	{
		$email = Session::get('email');
		foreach (User::with('todos')->get() as $user) {
			if ($user->email == $email) {
				return Response::json($user);
				//return $user->todos->toJSON();
			}
		}
	} 
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('todos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::get();
		$todo = new Todo;
		$email = Session::get('email');
		$user_id = DB::table('users')
			->where('email', $email)
			->select(['id'])
			->get();
		if (array_key_exists(0, $user_id)) {
			$user_id = $user_id[0]->id;
		}
		$todo->user_id = $user_id;
		$todo->task = Input::get('task');
		$todo->priority = Input::get('priority');
		$todo->deadline = Input::get('deadline');
		if ($todo->save()) {
			return "true";
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
<?php

class UsersController extends \BaseController {

	public function todos()
	{
		return $this->hasMany('Todo');
	}

	public function showLogin()
	{
		return View::make('login');
	}

	public function showIndex()
	{
		return View::make('showIndex')->with(array('email' => Session::get('email')));
	}

	public function login()
	{
		$user = User::where('email', Input::get('email'));
		if ($user) {
			Session::put('email', Input::get('email'));
			return Redirect::to('home');
		}
		else {
			return Redirect::back();
		}
	}

	public function register()
	{
		$user = new User();
		$user->email = Input::get('email');
		$user->save();
	}

	public function logout()
	{
		Session::forget('email');
		return Redirect::to('home');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}
}
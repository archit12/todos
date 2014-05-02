<?php

Route::filter('loggedIn', function()
{
    if (empty(Session::get('email')))
    {
        return Redirect::to('/');
    }
});

Route::get('/', 'UsersController@showLogin');

Route::post('login', 'UsersController@login');

Route::get('logout', 'UsersController@logout');

Route::post('register', 'UsersController@register');

Route::get('store', 'TodosController@store');

Route::get('check', 'TodosController@check');

Route::group(['before' => 'loggedIn'], function() {
	Route::get('home', 'UsersController@showIndex');
	Route::resource('todo', 'TodosController');
	Route::resource('user', 'UsersController', array('only' => array('create', 'store')));
});

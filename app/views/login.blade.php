<h1>Login</h1>
{{ Form::open(array('url' => 'login')) }}
	{{ Form::text('email') }}
	{{ Form::submit('Login') }}
{{ Form::close() }}
<h1>Register</h1>
{{ Form::open(array('url' => 'register')) }}
	{{ Form::text('email') }}
	{{ Form::submit('Login') }}
{{ Form::close() }}
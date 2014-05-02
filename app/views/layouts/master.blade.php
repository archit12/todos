<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="{{url('./vendor/components/backbone/backbone-min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/modules/todo.js') }}"></script>
    </head>
    <body>
        @section('header')
        	<div class="header">
        		<div class="heading">Todo Manager</div>
            	<a href="logout">Logout</a>
        	</div>
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
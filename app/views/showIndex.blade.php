<!DOCTYPE html>
<html>
<head>
	<title>Todos</title>
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://documentcloud.github.com/underscore/underscore-min.js"></script>
	<script src="http://documentcloud.github.com/backbone/backbone-min.js"></script>
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
	<script type="text/javascript">
		$(document).ready(function(){
			window.Todo = Backbone.Model.extend({
				defaults: {
					task: 'sample',
					priority: 1,
					deadline: '2014-04-29 10:10:10',
					done: false
				},
				initialize: function() {
					this.on({
						"change:done": this.show
					});
				},
				fromJSON: function(item){
					this.task = item.task;
					return this;

				},
				toggle: function() {
					this.save({done: !this.get("done")});
				},
				show: function() {
					alert("Changed");
				},
				urlRoot: 'todo'
			});

			window.TodoList = Backbone.Collection.extend({
				model: Todo,
				url: 'todo',
				
			});
			var todoList = new TodoList();
			
			var ItemView = Backbone.View.extend({
				initialize: function() {
					this.render();
				},
				tagName:'li',
				events: {
					"click .mark-done"           : "doneTodo",
					"click .delete"              : "deleteTodo"
				},

				doneTodo: function() {
					console.log(window.aaaa = this);
					this.model.toggle();
					this.model.rg();
				},
				render: function() {

					var item = this.model;
					console.log(item);
					var compiled = _.template( "<div class='priority'><img src='./assets/images/<%= item.priority %>.png'></div><%= item.task %><div class='delete'><img src='./assets/images/a.png'></div><div class='mark-done'><img src='./assets/images/a.png'></div><div class='clearfix'></div><div class='deadline'><%= item.deadline %></div>",
						{item: item});
					$(this.el).html(compiled);
				}
			});
			var todos = new TodoList();

			window.TodosView = Backbone.View.extend({
				initialize: function() {
					this.collection.bind("add", this.render, this);
					this.render();
				},
				events: {
					"click .submit-todo"         : "addTodo",
					"click .sort"                : "sortTodos"
				},
				addTodo: function() {
					todo = new Todo({
						task: $('#new-todo').val(),
						deadline: $('#deadline').val(),
						priority: $('#priority').val()
					});
					console.log(this);
					var itemView = new ItemView({model:todo});
					itemView.render();
					$(this.el).append(itemView.el);

					todos.add(todo);
					todo.save({success: this.render});
				},
				render: function() {
					var todo_json;
					todos.fetch({
						success: function (todo) {
							var compiled = _.template( "<div class='todo-header'>You have <span><%= _.size(todo_list.todos) %></span> Todos </div><br><div class='new-todo-container'><input type='text' id='new-todo' placeholder='enter new Todo' size='100'><div class='submit-todo'><img src='./assets/images/a.png'></div><input type='date' id='deadline'><select id='priority'><option value='3'>low</option><option value='2'>medium</option><option value='1'>high</option></select><div class='clearfix'></div></div><ul id='todoList'></ul>",
								{todo_list: todo.toJSON()[0]});
							$('#todos').html(compiled);

							var list = todo.toJSON()[0].todos;
							window.listbox = $('#todoList');


							for (var i = 0;i< list.length; i++) {
								var item = list[i];
								var todo=new Todo().fromJSON(item);
								var itemView = new ItemView({model:todo});

								itemView.render();
								$(this.el).append(itemView.el);

								todos.add(todo);

							};

						}
					}); 
}
});
var App = new TodosView({el: $('#todos'), collection: todos});
});
</script>
</head>
<body>
	<div class="container">
		<div class="inner-container">
			<div class="header">
				<h1>Todo App</h1>
				<div class="logout-panel">
					{{ $email }} | <a href="logout">Logout</a><br>
					<sub>by <a href="http://www.github.com/archit12">Archit Saxena</a></sub>
				</div>
			</div>
			<div id="todos-container">
				
				<div id="todos">
				</div>
				<div class="todo-footer">
				</div>
			</div>
			<div class="footer">
				<a href="www.github.com/archit12">Archit Saxena</a> | Created Using <a href="http://www.laravel.com">Laravel</a>, <a href="http://www.mysql.com">MySQL</a> and <a href="http://www.backbonejs.org">Backbonejs</a>
			</div>
		</div>
	</div>
</body>
</html>
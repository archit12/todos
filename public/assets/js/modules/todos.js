(function() {
	"use strict"
	var Todo = Backbone.Model.extend({

		defaults: {
			title: '',
			priority: '',
			deadline: '',
			done: false
		},

		//togles the done state of Todo
		toggle: function() {
      		this.save({done: !this.get("done")});
    	}

	});

	var TodoList = Backbone.Collection.extend({
		model: Todo,

		sort: function() {
			//sort todos according to deadline
		},

		url: 'todo'
	});

	var Todos = new TodoList;

	var TodoView = Backbone.View.extend({
		tagName: "li",

		events: {
			"click .toggle"  : "toggleDone",
			"click .destroy" : "clear",
			"click .sort"    : "sort"
		},

		initialize: function() {
      		this.listenTo(this.model, 'destroy', this.remove);
    	},

    	render: function() {
	      this.$el.html(this.model.toJSON());
	      this.$el.toggleClass('done', this.model.get('done'));
	      this.input = this.$('.edit');
	      return this;
    	},

    	toggleDone: function() {
      		this.model.toggle();
    	},

    	 clear: function() {
      		this.model.destroy();
    	}
	});

	var AppView = Backbone.View.extend({
		el: $("#todoapp"),

		events: {
	      "keypress #new-todo":  "createOnEnter",
	      "click #clear-completed": "clearCompleted",
	      "click #toggle-all": "toggleAllComplete"
    	},

    	initialize: function() {
	      this.input = this.$("#new-todo");
	      this.allCheckbox = this.$("#toggle-all")[0];

	      this.listenTo(Todos, 'add', this.addOne);
	      this.listenTo(Todos, 'reset', this.addAll);
	      this.listenTo(Todos, 'all', this.render);

	      this.footer = this.$('footer');
	      this.main = $('#main');

	      Todos.fetch();
    	},

    	 render: function() {
	      var done = Todos.done().length;
	      var remaining = Todos.remaining().length;

	      if (Todos.length) {
	        this.main.show();
	      }

	      this.allCheckbox.checked = !remaining;
	    },

	    addOne: function(todo) {
	      var view = new TodoView({model: todo});
	      this.$("#todo-list").append(view.render().el);
	    },

	    addAll: function() {
	      Todos.each(this.addOne, this);
	    },

	    createOnEnter: function(e) {
	      if (e.keyCode != 13) return;
	      if (!this.input.val()) return;

	      Todos.create({title: this.input.val()});
	      this.input.val('');
	    },

	});

	var todo_view = Backbone.View.extend({
        initialize: function(){
            alert("Alerts suck.");
        },
        render: function(){
            this.$el.html( '<ul>
            	<li>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.</li>
            	<li>Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</li>
            	<li>Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.</li>
            	<li>Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.</li>
            </ul>' );
        }
    });
    
    var todo_view = new todo_view({ el: $("#todos") });

}());
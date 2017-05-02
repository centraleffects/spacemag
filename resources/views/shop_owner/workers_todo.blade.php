@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="WorkersTodoController" @endslot
	
	@slot('left')
		<div class="card hoverable" id="dashleft-sidebar">
			<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Shops</h5>
			<ul class="collection">
				<li class="collection-item" ng-repeat="shop in shops" ng-click="getTodos($index)">
					@include('layouts._partials.dragicon')
					<span>@{{ shop.name }}</span>
					<a href="#!" class="right" title="Delete" ng-click="removeShop($index)">
						<i class="fa fa-trash"></i>
					</a>
			    </li>
			</ul>
		</div>
	@endslot
	@slot('center')
		<div id="todoapp" class="row">
			<div class="card hoverable"><!-- Client's Details -->
				<div class="card-content">
					<span class="card-title">Tasks</span>
					<div>
						<input id="new-todo" type="text" ng-model="todoText"  size="30" placeholder="What needs to be done?" ng-keyup="addTodo()"/>
					</div>
					<div id="main" style="display: block;">
						<div ng-show="isTodo()" class="row">
				        	<input id="toggle-all" type="checkbox" ng-model="markAll" ng-click="toggleMarkAll()"/>
				        	<label for="toggle-all">Mark all as complete</label>
				        </div>
						<ul class="collection todo-list">
							<li class="collection-item row todo-item" ng-repeat="todo in todos" ng-dblclick="toggleEditMode()">
								<span class="col" ng-keyup="editTodo()">
									@component('layouts._partials.dragicon')
										@slot('style') fill-grey @endslot
									@endcomponent
									<label for="_done_@{{$index}}" class="mark-as-complete circular-button-view @{{ todo.done ? 'done' : '' }}" ng-click="toggleDone($index)">
										@include('layouts._partials.checkbox')
									</label>
									<input type="checkbox" ng-model="todo.done" id="_done_@{{$index}}" style="display: none;" />
									
								</span>
								<span class="col s10 m10 l10">
									<span class="done-@{{todo.done}}" >@{{ todo.description }}</span>
									<input class="edit" type="text" ng-model="todo.description" ng-keyup="editOnEnter(todo)" esc-key="toggleEditMode()"/>
								</span>
							</li>
					    </ul>
					</div>
				</div>
				<div class="card-action">
					<div class="row">
						<div class="col">
							<div class="todo-count">@{{remaining()}} of @{{todos.length}} remaining</div>
						</div>
						<div class="col m9 l9">
							<a id="clear-completed" class="btn waves-effect waves-light red small right" ng-click="clear()" ng-show="hasDone()">
								Clear <span >@{{ (todos.length - remaining()) }} @{{itemText()}}</span>.
							</a>
						</div>
					</div>
				</div>
			</div><!-- end Todo -->
		</div>
	@endslot
	@slot('right')
		<div class="row">
			@include('shop_owner.partials._shopinfo')
		</div>
	@endslot

@endcomponent
@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="WorkersTodoController" @endslot
	
	@slot('left')
		<div class="card hoverable" id="dashleft-sidebar">
			<div class="card-content">
				<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Worker</h5>
				@component('layouts._partials.search')
					@slot('search_name') workers @endslot
				@endcomponent
				<div class="collection">
					<a href="javascript:void(0)" class="collection-item" ng-if="selectedShop.workers.length" ng-repeat="x in selectedShop.workers | filter:search" ng-click="setSelectedWorker(x)">
						@include('layouts._partials.dragicon')
						<span>
							@{{ x.first_name+' '+x.last_name }}
						</span>
				    </a>
				    <a href="javascript:void(0)" ng-if="!selectedShop.workers.length">
					    <span>
					    	<i class="fa fa-user-times"></i>
					    	This shop doesn't have any worker at the moment.
					    </span>
				    </a>
				</div>
			</div>
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
				        	<span>
						    	<input ng-model="tasks_filter" name="filters" type="radio" id="all_tasks" value="all_tasks"/>
						    	<label for="all_tasks">All Tasks</label>
						    </span>
						    <span>
						    	<input ng-model="tasks_filter" name="filters" type="radio" id="unassigned_tasks" value="unassigned_tasks"/>
						    	<label for="unassigned_tasks">Unassigned Tasks</label>
						    </span>
						    <span>
						    	<input ng-model="tasks_filter" name="filters" type="radio" id="completed_tasks" value="completed_tasks"/>
						    	<label for="completed_tasks">Completed Tasks</label>
						    </span>
				        </div>
						<ul class="collection todo-list">
							<li class="collection-item row todo-item" ng-repeat="todo in todos" ng-dblclick="toggleEditMode()" custom-autofocus="focusTodo == $index" ng-show="(tasks_filter == 'completed_tasks' && (todo.done == 1 || todo.done == true)) ? true : (tasks_filter == 'unassigned_tasks' && todo.owner == null) ? true : (tasks_filter == 'all_tasks' && (todo.done != true || todo.done != 1) ) ? true : false" autofocus>
								<span class="col" ng-keyup="editTodo()">
									@component('layouts._partials.dragicon')
										@slot('style') fill-grey @endslot
									@endcomponent
									<label for="_done_@{{$index}}" class="mark-as-complete circular-button-view" ng-class="todo.done ? 'done' : ''" ng-click="toggleDone($index)">
										@include('layouts._partials.checkbox')
									</label>
									<input type="checkbox" ng-model="todo.done" id="_done_@{{$index}}" style="display: none;" />
									
								</span>
								<span class="col s8 m8 l8">
									<span class="done-@{{todo.done}}" title="Double click to edit">@{{ todo.description }}</span>
									<input class="edit" type="text" ng-model="todo.description" ng-keyup="editOnEnter(todo)" esc-key="toggleEditMode()" title="Press 'Enter' to save and 'ESC' to cancel."/>
								</span>
								<span class="col right">
									<div class="chip" title="Assigned to" ng-if="todo.owner != null">
									    <img src="@{{ todo.owner.avatar }}" alt="Assigned">
									    @{{ todo.owner.first_name+' '+todo.owner.last_name }}
									    <i class="close material-icons" ng-click="unAssignTask(todo)">close</i>	
									</div>
									<div class="assignto input-field" ng-if="todo.owner == null">
										<angucomplete-alt
							              placeholder="Assign to"
							              pause="300"
							              selected-object="assignTodo"
							              local-data="selectedShop.workers"
							              local-search="localSearch"
							              title-field="first_name,last_name"
							              description-field="email"
							              image-field="avatar"
							              minlength="0"
							              input-class="form-control form-control-small"
							              match-class="highlight"
							              clear-selected="true"
							              focus-in="setFocusTodo(todo)" />
									</div>
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
		<div class="card hoverable">
			<div class="card-content">
				
			</div>
		</div>
	@endslot

@endcomponent
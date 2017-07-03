@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="WorkersTodoController" @endslot
	
	@slot('center')
		<div id="todoapp" class="row">
			<div class="card hoverable"><!-- Client's Details -->
				<div class="card-content">
					<span class="card-title">Tasks</span>
					<div>
						<input id="new-todo" type="text" ng-model="todoText"  size="30" placeholder="What needs to be done?" ng-keyup="addTodo()"/>
					</div>
					<div id="main" style="display: block;">
						<!-- <div ng-show="isTodo()" class="row">
				        	<input id="toggle-all" type="checkbox" ng-model="markAll" ng-click="toggleMarkAll()"/>
				        	<label for="toggle-all">Mark all as complete</label>
				        </div> -->
						<ul class="collection todo-list">
							<li class="collection-item row todo-item" ng-repeat="todo in todos" ng-dblclick="toggleEditMode()" custom-autofocus="focusTodo == $index" autofocus>
								<span class="col" ng-keyup="editTodo()">
									@component('layouts._partials.dragicon')
										@slot('style') fill-grey @endslot
									@endcomponent
									<label for="_done_@{{$index}}" class="mark-as-complete circular-button-view" ng-class="todo.done ? 'done' : ''" ng-click="toggleDone($index)">
										@include('layouts._partials.checkbox')
									</label>
									<input type="checkbox" ng-model="todo.done" id="_done_@{{$index}}" style="display: none;" />
									
								</span>
								<span class="col col s8 m8 l8">
									<span class="done-@{{todo.done}}" >@{{ todo.description }}</span>
									<input class="edit" type="text" ng-model="todo.description" ng-keyup="editOnEnter(todo)" esc-key="toggleEditMode()"/>
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

@endcomponent
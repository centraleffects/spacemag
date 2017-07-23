@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="WorkerController" @endslot

	@slot('left')
		<div class="card hoverable" id="dashleft-sidebar">
			<div class="card-content">
				<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Worker</h5>
				@component('layouts._partials.search')
					@slot('search_name') workers @endslot
				@endcomponent
				<ul class="collection">
					<li class="collection-item" ng-if="workers.length" ng-repeat="x in workers | filter:search" ng-click="viewWorker($index)">
						@include('layouts._partials.dragicon')
						<span>
							@{{ x.first_name+' '+x.last_name }}
						</span>
						<a class="right" title="Delete" ng-click="removeWorker($index)">
							<i class="fa fa-trash"></i>
						</a>
				    </li>
				    <li ng-if="!workers.length">
					    <span>
					    	<i class="fa fa-user-times"></i>
					    	This shop doesn't have any worker at the moment.
					    </span>
				    </li>
				</ul>
				
			</div>
			<div class="card-action">
				<a class="btn-floating btn-large waves-effect waves-light green right tooltipped" data-position="left" data-delay="50" data-tooltip="Add new shop worker" href="#!" ng-click="addNewWorker()">
					<i class="material-icons">add</i>
				</a>
			</div>
		</div>
	@endslot
	@slot('center')
		<div id="" class="row">
			<div class="card hoverable" ng-show="hasSelectedUser"><!-- Client's Details -->
				<div class="card-content">
					<span class="card-title">
						Shop Worker's Details 
						@component('layouts._partials.close_card')
							hasSelectedUser=false;
						@endcomponent
					</span>
					<p></p>
					<div class="worker-details">
						<div class="input-field">
							<input type="text" name="name" value="@{{ selectedUser.first_name+' '+selectedUser.last_name }}" />
							<label>Name</label>
						</div>

						<div class="input-field">
							<input type="email" name="email" class="validate" value="@{{ selectedUser.email }}">
							<label>Email</label>
						</div>

					</div>
				</div>
				<div class="card-action row">
					<div class="col s12 m6 l6">
						<button class="btn waves-effect waves-light orange darken-3" title="Generate Password" ng-click="generatePassword()" ng-disabled="isGeneratingPassword">
							<i class="fa fa-random"></i>
							<span class="hide-on-small-only"> Generate Password</span>
						</button>
					</div>
				</div>
			</div><!-- end Client's Details -->

			<div class="card hoverable"><!-- Shop -->
				<div class="card-content">
					<div class="card-title">Shop Name</div>
					
					<div class="row" ng-if="shops.length" ng-repeat="shop in shops">
						<div class="col">
							<p>@{{$index+1}}. @{{ shop.name }}</p>
						</div>
						<div class="col">
							<p>
								<input type="checkbox" id="status" name="status" value="true" />
								<label for="status">Enable</label>
							</p>
						</div>
						<div class="col">
							<a class="more-info" href="javascript:void(0)" ng-click="">
								<i class="material-icons">info_outline</i>
							</a>
						</div>
					</div>
					
					<p ng-if="!shops.length">{{ __("messages.client_no_shop_yet") }}</p>
					
				</div>
				<div class="card-action"></div>
			</div><!-- End Shop -->

			<div class="card hoverable" ng-show="addNew" id="add_new">
				<div class="card-content">
					<div class="card-title">
						Invite @include('layouts._partials.close_card')
					</div>
					<div class="input-field">
						<input type="text" name="name" class="validate" ng-model="newUser.first_name" required  />
						<label for="name">Name of Shop Worker</label>
					</div>
					<div class="input-field">
						<input type="email" name="email" class="validate" ng-model="newUser.email" required />
						<label>Email Address</label>
					</div>
				</div>
				<div class="card-action">
					<button class="btn waves-effect waves-light green" ng-click="invite()" ng-disabled="isDisabled">
						<i class="glyphicon glyphicon-refresh spinning" ng-show="loading"></i>
						<i class="fa fa-send" ng-show="!loading"></i> Send invitation link/password
					</button>
				</div>
			</div>
		</div>
	@endslot
@endcomponent
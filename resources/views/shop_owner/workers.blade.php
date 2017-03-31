@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="WorkerController" @endslot

	@slot('left')
		<div class="card hoverable" id="dashleft-sidebar">
			<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Worker</h5>
			@component('layouts._partials.search')
				@slot('search_name') workers @endslot
			@endcomponent
			<ul class="collection">
				<li class="collection-item" ng-repeat="x in workers | filter:search">
					@include('layouts._partials.dragicon')
					<span ng-click="viewWorker($index)">
						@{{ x.first_name+' '+x.last_name }}
					</span>
					<a class="right" title="Delete" ng-click="removeWorker($index)">
						<i class="fa fa-trash"></i>
					</a>
			    </li>
			    <li ng-show="noClientAvailable">
				    <span>
				    	<i class="fa fa-user-times"></i>
				    	This shop doesn't have any worker at the moment.
				    </span>
			    </li>
			</ul>
			<div class="card-action">
				<button class="btn waves-effect waves-light green" ng-click="addNewWorker()">
					<i class="fa fa-plus"></i>
					Add Worker
				</button>
			</div>
		</div>
	@endslot
	@slot('center')
		<div id="" class="row">
			<div class="card hoverable" ng-show="hasSelectedWorker"><!-- Client's Details -->
				<div class="card-content">
					<span class="card-title">
						Shop Worker's Details 
						@component('layouts._partials.close_card')
							hasSelectedWorker=false;
						@endcomponent
					</span>
					<p></p>
					<div class="worker-details">
						<div class="input-field">
							<input type="text" name="name" value="@{{ selectedWorker.first_name+' '+selectedWorker.last_name }}" />
							<label>Name</label>
						</div>

						<div class="input-field">
							<input type="email" name="email" class="validate" value="@{{ selectedWorker.email }}">
							<label>Email</label>
						</div>

					</div>
				</div>
				<div class="card-action row">
					<div class="col s12 m6 l6">
						<button class="btn waves-effect waves-light orange darken-3" title="Generate Password">
							<i class="fa fa-random"></i>
							<span class="hide-on-small-only"> Generate Password</span>
						</button>
					</div>
				</div>
			</div><!-- end Client's Details -->

			<div class="card hoverable"><!-- Shop -->
				<div class="card-content">
					<div class="card-title">Shop Name</div>
					<div class="row">
						<div class="col">
							<p>1. Rebuy Shop</p>
						</div>
						<div class="col">
							<p>
								<input type="checkbox" id="status" name="status" value="true" />
								<label for="status">Enable</label>
							</p>
						</div>
					</div>
				</div>
			</div><!-- End Shop -->

			<div class="card hoverable" ng-show="addNew" id="add_new">
				<div class="card-content">
					<div class="card-title">
						Invite @include('layouts._partials.close_card')
					</div>
					<div class="input-field">
						<input type="text" name="name" />
						<label for="name">Name of Shop Worker</label>
					</div>
					<div class="input-field">
						<input type="email" name="email" />
						<label>Email Address</label>
					</div>
				</div>
				<div class="card-action">
					<button class="btn waves-effect waves-light green">
						<i class="fa fa-send"></i>
						Send invitation link/Password
					</button>
				</div>
			</div>
		</div>
	@endslot
	@slot('right')
		<div class="row">
			@include('shop_owner.partials._shopinfo')
		</div>
	@endslot

@endcomponent
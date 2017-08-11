@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="CustomerController" @endslot

	@slot('left')
		<div class="card hoverable">
			<div class="card-content">
				<span class="card-title">List of Customers</span></span>
				@component('layouts._partials.search')
					@slot('search_name') customers @endslot
				@endcomponent
				<ul class="collection">
					<li class="collection-item" ng-repeat="x in customers | filter:search" ng-click="viewCustomer($index)">
						<a href="javascript:;">@{{ x.first_name+' '+x.last_name }}</a>
						<a class="right" title="Delete" ng-click="removeCustomer($index)">
							<i class="fa fa-trash"></i>
						</a>
				    </li>
				    <li ng-show="!customers.length">
					    <span>
					    	<i class="fa fa-user-times"></i>
					    	This shop doesn't have any customer at the moment.
					    </span>
				    </li>
				</ul>
			</div>
			<div class="card-action">
				<a class="btn-floating btn-large waves-effect waves-light green right tooltipped" data-position="left" data-delay="50" data-tooltip="Invite new customer" href="#!" ng-click="addNewCustomer()">
					<i class="material-icons">add</i>
				</a>
			</div>
		</div>
	@endslot
	
	@slot('center')
		<div id="customer_details" class="row">
			<div class="card hoverable" ng-show="hasSelectedUser"><!-- Customer's Details -->
				<div class="card-content">
					<div class="card-title">
						Customer's Details 
						@component('layouts._partials.close_card')
							hasSelectedUser=false
						@endcomponent
					</div>
					<p></p>
					<div class="client-details">
						<div class="input-field">
							<input type="text" name="name" value="@{{ selectedUser.first_name+' '+selectedUser.last_name }}" readonly />
							<label>Name</label>
						</div>

						<div class="input-field">
							<input type="email" name="email" value="@{{ selectedUser.email }}" readonly />
							<label>Email</label>
						</div>

					</div>
				</div>
				<div class="card-action row">
					<div class="col">
						<button class="btn waves-effect waves-light orange darken-3" title="Generate Password" ng-click="generatePassword()" ng-disabled="isGeneratingPassword">
							<i class="fa fa-random"></i>
							<span class="hide-on-small-only"> Generate Password</span>
						</button>
					</div>
				</div>
			</div><!-- end Customer's Details -->

			<div class="card hoverable" ng-show="hasSelectedUser"><!-- Shop -->
				<div class="card-content">
					<div class="card-title">Shop Name</div>
					<div class="row" ng-show="hasSelectedUser">
						<div class="col">
							<p>@{{ selectedShop.name }}</p>
						</div>
						<div class="col">
							<p>
								<input type="checkbox" class="newsletter-subscription" ng-model="selectedUser.pivot.newsletter_subscribed" ng-click="newsletterSubscription($event)" id="newsletter_subscription" />
								<label for="newsletter_subscription">Enable Newsletter</label>
							</p>
						</div>
						<div class="col">
							<a class="chip waves-effect waves-light green white-text" ng-click="loginAs()">
								<i class="fa fa-sign-in"></i> Login Customer A/C
							</a>
						</div>
					</div>
					<div class="row" ng-hide="hasSelectedUser">
						Nothing to show here. Select or Add a customer to this shop right now.
					</div>
				</div>
				<div class="card-action">

				</div>
			</div><!-- End Shop -->

			<div class="card hoverable" ng-show="addNew" id="add_new"><!-- Send Invitation -->
				<div class="card-content">
					<div class="card-title">
						Invite @include('layouts._partials.close_card')
					</div>

					<div class="input-field">
						<input type="text" name="name" class="validate" ng-model="newUser.first_name" required />
						<label>Name of Customer</label>
					</div>
					<div class="input-field ">
						<input type="email" name="email" class="validate" ng-model="newUser.email" required />
						<label>Email Address</label>
					</div>
				</div>
				<div class="card-action">
					<button class="btn waves-effect waves-light green" ng-click="invite()" ng-disabled="isDisabled">
						<i class="glyphicon glyphicon-refresh spinning" ng-show="loading"></i>
						<i class="fa fa-send" ng-show="!loading"></i> Send invitation to this Customer
					</button>
				</div>
			</div>

			<!-- <div class="card hoverable" ng-show="!hasSelectedUser">
				<div class="card-content">
					<h5>Select a customer to get started.</h5>
				</div>
			</div> -->
		</div>
	@endslot

	@slot('right')
		<div class="row">
			@include('shop_owner.partials._shopinfo')
		</div>
	@endslot

@endcomponent
@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="CustomerController" @endslot

	@slot('left')
		<div class="card hoverable" id="dashleft-sidebar">
			<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Customers</h5>
			@component('layouts._partials.search')
				@slot('search_name') clients @endslot
			@endcomponent
			<ul class="collection">
				<li class="collection-item customers" ng-repeat="x in customers | filter:search">
					@include('layouts._partials.dragicon')
					<span ng-click="viewCustomer($index)">@{{ x.first_name+' '+x.last_name }}</span>
					<a class="right" title="Delete" ng-click="removeCustomer($index)">
						<i class="fa fa-trash"></i>
					</a>
			    </li>
			    <li ng-show="customers.length === 0">
				    <span>
				    	<i class="fa fa-user-times"></i>
				    	This shop doesn't have any customer at the moment.
				    </span>
			    </li>
			</ul>
			<div class="card-action">
				<a class="btn waves-effect waves-light blue" href="#!" ng-click="addNewCustomer()">
					<i class="fa fa-plus"></i> Add New Customer
				</a>
			</div>
		</div>
	@endslot
	
	@slot('center')
		<div id="customer_details" class="row">
			<div class="card hoverable" ng-show="hasSelectedCustomer"><!-- Customer's Details -->
				<div class="card-content">
					<div class="card-title">
						Customer's Details 
						@component('layouts._partials.close_card')
							hasSelectedCustomer=false
						@endcomponent
					</div>
					<p></p>
					<div class="client-details">
						<div class="input-field">
							<input type="text" name="name" value="@{{ currentlySelectedCustomer.first_name+' '+currentlySelectedCustomer.last_name }}" readonly />
							<label>Name</label>
						</div>

						<div class="input-field">
							<input type="email" name="email" value="@{{ currentlySelectedCustomer.email }}" readonly />
							<label>Email</label>
						</div>

					</div>
				</div>
				<div class="card-action row">
					<div class="col">
						<button class="btn waves-effect waves-light green" title="Generate Password" ng-click="generatePassword()">
							<i class="fa fa-random"></i> Generate Password
						</button>
					</div>
				</div>
			</div><!-- end Customer's Details -->

			<div class="card hoverable"><!-- Shop -->
				<div class="card-content">
					<div class="card-title">Shop Name</div>
					<div class="row">
						<div class="col">
							<p>1. Rebuy Shop</p>
						</div>
						<div class="col">
							<p>
								<input type="checkbox" id="newsletter_subscription" name="newsletter_subscription" value="true" />
								<label for="newsletter_subscription">Enable Newsletter</label>
							</p>
						</div>
						<div class="col">
							<a class="chip waves-effect waves-light green white-text">
								<i class="fa fa-sign-in"></i> Login Customer A/C
							</a>
						</div>
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
						<input type="text" name="name" />
						<label>Name of Customer</label>
					</div>
					<div class="input-field ">
						<input type="email" name="email" class="validate" />
						<label>Email Address</label>
					</div>
				</div>
				<div class="card-action">
					<button class="btn waves-effect waves-light green">
						<i class="fa fa-send"></i> Send invitation link/password
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
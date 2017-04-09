@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="ClientController" @endslot
	@slot('left')
		<div class="card hoverable" id="dashleft-sidebar">
			<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Clients</h5>
			@component('layouts._partials.search')
				@slot('search_name') clients @endslot
			@endcomponent
			<ul class="collection">
			    <li class="collection-item customers" ng-repeat="x in clients | filter:search">
					@include('layouts._partials.dragicon')
					<span ng-click="viewClient($index)">@{{ x.first_name+' '+x.last_name }}</span>
					<a class="right" title="Delete" ng-click="removeClient($index)">
						<i class="fa fa-trash"></i>
					</a>
			    </li>
			    <li ng-show="emptyList()">
				    <span>
				    	<i class="fa fa-user-times"></i>
				    	This shop doesn't have any client at the moment.
				    </span>
			    </li>
			</ul>
		</div>
	@endslot
	@slot('center')
		<div id="" class="row">
			<div class="card hoverable" ng-show="hasSelectedUser"><!-- Client's Details -->
				<div class="card-content">
					<span class="card-title">Client's Details
						@component('layouts._partials.close_card')
							hasSelectedUser=false
						@endcomponent
					</span>
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
					<div class="col s12 m4 l4">
						<button class="btn waves-effect waves-light orange darken-3" title="Generate Password" ng-click="generatePassword()" ng-disabled="isGeneratingPassword">
							<i class="fa fa-random"></i>
							<span class="hide-on-small-only"> Generate Password</span>
						</button>
					</div>
					<div class="col s12 m12 l4">
						<button class="btn waves-effect waves-light green" title="Login Client Account">
							<i class="fa fa-sign-in"></i>
							<span class="hide-on-small-only"> Login Client A/c</span>
						</button>
					</div>
					<div class="col s12 m4 l4">
						<button class="btn waves-effect waves-light blue" title="Booking">
							<i class="fa fa-calendar"></i>
							<span class="hide-on-small-only"> Booking</span>
						</button>
					</div>
				</div>
			</div><!-- end Client's Details -->

			<div class="card hoverable"><!-- Shop -->
				<div class="card-content">
					<div class="card-title">Shop Name</div>
					<div class="row" ng-show="hasSelectedUser">
						<div class="col">
							<p>@{{ $index+1 }}. @{{ selectedShop.name }}</p>
						</div>
						<div class="col">
							<p>
								<input type="checkbox" id="newsletter_subscription" name="newsletter_subscription" value="true" ng-change="newletterSubscription()"/>
								<label for="newsletter_subscription">Enable Newsletter</label>
							</p>
						</div>
						<div class="col">
							<p>
								Salespots:
								<div class="chips chips-salesspots"></div>
							</p>
						</div>
					</div>
					<div class="row" ng-hide="hasSelectedUser">
						Nothing to show here. Select a client to start.
					</div>
				</div>
				<div class="card-action">
					<a href="/shop/clients/articles" class="btn waves-effect waves-light btn waves-effect waves-light-small green"> Go to Articles</a>
				</div>
			</div><!-- End Shop -->
		</div>
	@endslot
	@slot('right')
		<div class="row">
			@include('shop_owner.partials._shopinfo')
		</div>
	@endslot

@endcomponent
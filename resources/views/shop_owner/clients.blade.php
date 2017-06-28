@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="ClientController as vm" @endslot
	@slot('left')
		<div class="card hoverable" id="dashleft-sidebar">
			<div class="row card-content">
				<span class="card-title">List of Clients</span>
				@component('layouts._partials.search')
					@slot('search_name') clients @endslot
				@endcomponent
				<ul class="collection">
				    <li class="collection-item customers" ng-repeat="x in clients | filter:search" ng-click="viewClient($index)">
						@include('layouts._partials.dragicon')
						<a ng-cloak>@{{ x.first_name+' '+x.last_name }}</a>
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
							<input type="text" name="name" value="@{{ selectedUser.first_name+' '+selectedUser.last_name }}" readonly ng-cloak />
							<label>Name</label>
						</div>

						<div class="input-field">
							<input type="email" name="email" value="@{{ selectedUser.email }}" readonly ng-cloak />
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
						<button class="btn waves-effect waves-light green" title="Login Client Account"  ng-click="loginAs()">
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
							<p ng-cloak ng-bind="($index+1) + '. ' + selectedShop.name "></p>
						</div>
						<div class="col">
							<p>
								<input type="checkbox" class="newsletter-subscription" ng-model="selectedUser.pivot.newsletter_subscribed" ng-click="newsletterSubscription($event)" id="newsletter_subscription" ng-cloak />
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

			<div class="card hoverable" ng-show="hasSelectedUser"><!-- Notes -->
				<div class="card-content">
					<div class="card-title">Notes</div>
					<div class="row">
						<div class="input-field col s12">
				          <textarea id="addNote" class="materialize-textarea" ng-model="vm.newnote"></textarea>
				          <a href="javascript:;;" class="waves-effect waves-light btn right" ng-click="vm.addNote()">Add Note</a>
				          <label for="textarea1" ng-cloak>Add Notes to @{{ selectedUser.first_name+' '+selectedUser.last_name }}</label>
				        </div>
					</div>
					<div class="row">
						<ul class="collection">
							<li class="collection-item" ng-cloak ng-repeat="note in selectedUser.notes | orderBy:'$index':true">
								@{{note.notes}}
								<span class="badge" ng-cloak>@{{note.created_at}}</span>
							</li>
						</ul>
					</div>
				</div>

			</div><!-- End Notes -->

		</div>
	@endslot
	@slot('right')
		<div class="row">
			@include('shop_owner.partials._shopinfo')
		</div>
	@endslot

@endcomponent
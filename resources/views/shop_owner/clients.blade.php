@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="ClientController as vm" @endslot
	@slot('left')
		<div class="card hoverable">
			<div class="row card-content">
				
				<span class="card-title">Client List</span></span>

				<div class="nav-wrapper">
			      <form>
			        <div class="input-field">
			          <input id="search" type="search" required>
			          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
			          <i class="material-icons">close</i>
			        </div>
			      </form>
			    </div>
			    <div><a href="javascript:;;">Filter Result <a href="/shop/clients/new"><span class="badge">Invite New Client</span></a></div>
    			<div>
					<ul class="collection">
								
							@forelse ($clients as $client)
								<li 	
									class="collection-item" 
									id="{{ $client->id }}"  
									>
									<a  href="/shop/clients/{{ $client->id }}">{{$client->first_name.' '.$client->last_name}}</a>
									<a  href="/shop/clients/delete/{{ $client->id }}" class="secondary-content">
										<i class="fa fa-trash-o right" aria-hidden="true"></i>
									</a>
								</li>
							@empty
								<li class="collection-item">{!! __("No result to display") !!}</li>
							@endforelse

					</ul>
				</div>
			</div>
		</div>
	@endslot
	@slot('center')

		@if(empty($selectedClient->id))
			<div class="card hoverable">
	            <div class="card-content">
	              <span class="card-title">Send invites to join Rebuy.</span>
	              	<div class="row">
				        <div class="input-field col s12">
				          <input type="email" name="email" value="" />
				          <label>Enter Email</label>
				        </div>
				        <div class="input-field col s12">
				        	<button type="button" class="btn waves-effect waves-light green">Send</button>
				        </div>
				     </div>
	            </div>
	        </div>
		@else
			<div>
				<div class="row">
					<div class="card hoverable"><!-- Customer's Details -->
						<form name="clientDetails" id="clientDetails" autocomplete="false">
						<div class="card-content">
							<span class="card-title">Details  <i data-activates="lsinfo-option" class="fa fa-ellipsis-v grey-text lighten-2 dropdown-button right cursor-pointer" ng-show="$selectedClient.id" aria-hidden="true" id="info-option"></i>
							<ul id="lsinfo-option" class="dropdown-content">
							  <li><a href="#!"  onclick="$.reBuy.confirm('Are you sure to delete this user?',function(){ deleteUser(); });"><i class="fa fa-times" aria-hidden="true"></i> DEL</a></li>
							</ul></span>
							<p></p>
							<div class="client-details">
								
								<div class="input-field">
									<input type="text" name="first_name"  id="first_name" value="{{ empty($selectedClient->first_name) ? '' : $selectedClient->first_name }}"/>
									<label>First Name</label>
								</div>
								<div class="input-field">
									<input type="text" name="last_name"   id="last_name" value="{{ empty($selectedClient->last_name) ? '' : $selectedClient->last_name}}"/>
									<label>Last Name</label>
								</div>
								<div class="input-field">
									<input type="text" name="email"   id="email" value="{{ empty($selectedClient->first_name) ? '' : $selectedClient->first_name }}"/>

									<label>Email</label>
								</div>
								<div class="input-field"  ng-show="!$selectedClient.id">
									<label>Password</label>
									<small ng-show="$selectedClient.id" class="right help-inline">Click here to generate a new password</small>
								</div>
								<div class="input-field">
									<select name="gender"   id="gender"
											ng-options="obj.value as obj.text for obj in genderOptions">
	    							</select>
									<label>Gender</label>
								</div>
								<div class="input-field">
									<select name="role"   id="role" ng-model="selectedClient.role" 
											ng-options="obj.value as obj.text for obj in roleOptions">
	    							</select>
									<label>Role</label>
								</div>

								<div class="input-field">
									<input type="text"   id="address_1" name="address_1" value="{{ empty($selectedClient->address_1) ? '' :$selectedClient->address_1 }} ">
									<label>Address 1</label>
								</div>

								<div class="input-field">
									<input type="text" name="address_2"   id="address_2" value="{{ empty($selectedClient->address_2) ? '' :$selectedClient->address_2 }} ">
									<label>Address 2</label>
								</div>

								<div class="input-field">
									<input type="text" name="city"   id="city" value="{{ empty($selectedClient->city) ? '' : $selectedClient->city }} ">
									<label>City</label>
								</div>

								<div class="input-field">
									<input type="text" name="zip_code"   id="zip_code" value="{{ empty($selectedClient->zip_code) ? '' : $selectedClient->zip_code }}">
									<label>Zip Code</label>	
								</div>

								<div class="input-field">
									<select name="country"   id="country" ng-model="$selectedClient.country" 
											ng-options="obj.value as obj.text for obj in countryOptions">
	    							</select>
									<label>Country</label>
								</div>

								<div class="input-field">
									<input type="text" name="telephone"    id="telephone" value="{{ empty($selectedClient->telephone) ? '' :$selectedClient->telephone }} ">
									<label>Telephone</label>
								</div>

								<div class="input-field">
									<input type="text" name="mobile"    id="mobile" value="{{ empty($selectedClient->mobile) ? '' : $selectedClient->mobile }} ">
									<label>Mobile</label>
								</div>

								<div class="input-field">
									<select name="lang"   id="lang" ng-model="$selectedClient.lang" 
											ng-options="obj.value as obj.text for obj in langOptions">
	    							</select>
									<label>Default Language</label>
								</div>
								
							</div>
						</div>
						<div class="card-action row">
							<div class="col">
								<br>
								<button class="btn waves-effect waves-light blue hide" id="resetdetails" ng-click="events.viewUser(null,{})">
									<i class="fa fa-random"></i> Clear
								</button>
								<button class="btn waves-effect waves-light green right"  type="submit" title="Generate Password" onclick="updateInfo()">
									<i class="fa fa-floppy-o" aria-hidden="true"></i> {{ !empty($selectedClient->id) ? 'Save New Information' : 'Update Information' }}
								</button><br><br>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		@endif
	@endslot
	@slot('right')
	   @if(!empty($selectedClient->id))
		<div class="card hoverable">
            <div class="card-content">
              <span class="card-title">Notes</span>
              	<div class="row">
			        <div class="input-field col s12">
			          <textarea id="textarea1" class="materialize-textarea" placeholder="Add a notes {{ empty($selectedClient->first_name) ?  '' : ' to '.$selectedClient->first_name }}"></textarea>
			        </div>
			     </div>
              <div></div>
              <div></div>
            </div>
        </div>

        <div class="card hoverable">
            <div class="card-content">
              <span class="card-title">Coupons</span>
              	<div class="row">
			        <div class="input-field col s12">
			          <input placeholder="Add a coupon{{ empty($selectedClient->first_name) ? '' : ' to '.$selectedClient->first_name }}"></input>
			          <button class="btn waves-effect waves-light blue" ng-click="vm.applyCoupon()">Apply</button>
			        </div>
			     </div>
              <div></div>
              <div></div>
            </div>
        </div>
        @endif
	@endslot

@endcomponent
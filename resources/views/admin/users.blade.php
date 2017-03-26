@component('admin.layouts.app')
<div ng-controller="UserController">
	<div class="col s3">
		<div  class="card hoverable" id="dashleft-sidebar">
			<h5><i class="material-icons">face</i> List of Users</h5>
			<ul class="collection" ng-repeat="(key, user) in users.data">

					<li class="collection-item" ng-click="events.viewUser(key,user)">
						<svg class="svgIcon itemRow-dragIcon" viewBox="0 0 32 32" title="drag handle"><path d="M 14 5.5 a 3 3 0 1 1 -3 -3 A 3 3 0 0 1 14 5.5 Z m 7 3 a 3 3 0 1 0 -3 -3 A 3 3 0 0 0 21 8.5 Z m -10 4 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 12.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 12.5 Z m -10 10 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 22.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 22.5 Z"></path></svg>
						<span><a href="">@{{user.first_name+' '+user.last_name}}</a></span> 
						<a href="#">
							<i class="fa fa-pencil-square-o edit-icon right" aria-hidden="true"></i>
						</a>
						<i class="fa fa-trash delete-icon right" aria-hidden="true"></i>
					</li>

				
			</ul>
		</div>
	</div>
	<div class="col s12 m6 l6">
			<div class="row">
				<div class="card hoverable"><!-- Customer's Details -->
					<form name="clientDetails" id="clientDetails">
					<div class="card-content">
						<span class="card-title">User Details - @{{selectedUser.first_name}} <i data-activates="lsinfo-option" class="fa fa-ellipsis-v grey-text lighten-2 dropdown-button right cursor-pointer" ng-show="selectedUser.id" aria-hidden="true" id="info-option"></i>
						<ul id="lsinfo-option" class="dropdown-content">
						  <li><a href="#!"  onclick="$.reBuy.confirm('Are you sure to delete this user?',function(){deleteUser()});"><i class="fa fa-times" aria-hidden="true"></i> DEL</a></li>
						</ul></span>
						<p></p>
						<div class="client-details">
							
							<div class="input-field">
								<input type="text" name="first_name"  id="first_name" ng-model="selectedUser.first_name"/>
								<label>First Name</label>
							</div>
							<div class="input-field">
								<input type="text" name="last_name"   id="last_name" ng-model="selectedUser.last_name"/>
								<label>Last Name</label>
							</div>
							<div class="input-field">
								<input type="text" name="email"   id="email" ng-model="selectedUser.email" ng-show="!selectedUser.id"/>
								<input type="text" ng-show="selectedUser.id" readonly="readonly" value="@{{selectedUser.email}}" />
								<label>Email</label>
								<small ng-show="!selectedUser.id" class="right help-inline" ng-show="!selectedUser.id">A generated password will be sent to this address</small>
								<small ng-show="selectedUser.id" class="right help-inline" ng-show="!selectedUser.id">Click here to generate a new password</small>
							</div>
							<div class="input-field">
								<select name="gender"   id="gender" ng-model="selectedUser.gender" 
										ng-options="obj.value as obj.text for obj in genderOptions">
    							</select>
								<label>Gender</label>
							</div>
							<div class="input-field">
								<select name="role"   id="role" ng-model="selectedUser.role" 
										ng-options="obj.value as obj.text for obj in roleOptions">
    							</select>
								<label>Role</label>
							</div>

							<div class="input-field">
								<input type="text"   id="address_1" name="address_1" ng-model="selectedUser.address_1">
								<label>Address 1</label>
							</div>

							<div class="input-field">
								<input type="text" name="address_2"   id="address_2" ng-model="selectedUser.address_2">
								<label>Address 2</label>
							</div>

							<div class="input-field">
								<input type="text" name="city"   id="city" ng-model="selectedUser.city">
								<label>City</label>
							</div>

							<div class="input-field">
								<input type="text" name="zip_code"   id="zip_code" ng-model="selectedUser.zip_code">
								<label>Zip Code</label>	
							</div>

							<div class="input-field">
								<select name="country"   id="country" ng-model="selectedUser.country" 
										ng-options="obj.value as obj.text for obj in countryOptions">
    							</select>
								<label>Country</label>
							</div>

							<div class="input-field">
								<input type="text" name="telephone"    id="telephone" ng-model="selectedUser.telephone">
								<label>Telephone</label>
							</div>

							<div class="input-field">
								<input type="text" name="mobile"    id="mobile" ng-model="selectedUser.mobile">
								<label>Mobile</label>
							</div>

							<div class="input-field">
								<select name="lang"   id="lang" ng-model="selectedUser.lang" 
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
							<button class="btn waves-effect waves-light green"  type="submit" title="Generate Password" onclick="updateInfo()">
								<i class="fa fa-floppy-o" aria-hidden="true"></i> @{{ !selectedUser.id ? 'Save New Information' : 'Update Information' }}
							</button><br><br>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	<div class="col s3">
			<div class="card hoverable" ng-show="selectedUser.role==='owner'"><!-- Shop -->
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

			<div class="card hoverable hide"><!-- Send Invitation -->
				<div class="card-content">
					<div class="card-title"> Invite</div>

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
</div>
@endcomponent
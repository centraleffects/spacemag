@component('admin.layouts.app')
<div class="col s3">
	<div  class="card hoverable" id="dashleft-sidebar">
		<h5><i class="material-icons">face</i> List of Users</h5>
		<ul class="collection">

			@foreach($users as $user)
				<li class="collection-item">
					<svg class="svgIcon itemRow-dragIcon" viewBox="0 0 32 32" title="drag handle"><path d="M 14 5.5 a 3 3 0 1 1 -3 -3 A 3 3 0 0 1 14 5.5 Z m 7 3 a 3 3 0 1 0 -3 -3 A 3 3 0 0 0 21 8.5 Z m -10 4 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 12.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 12.5 Z m -10 10 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 22.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 22.5 Z"></path></svg>
					<span><a href="{{ url('admin/users/'. $user->id) }}">{{  $user->first_name.' '.$user->last_name  }}</a></span> 
					<a href="{{ url('admin/users/'. $user->id) }}"><i class="fa fa-pencil-square-o edit-icon right" aria-hidden="true"></i></a>
					<i onclick="$.ReBuy.confirmDialog('Are you sure you want to delete this user?', function(){ location.href='{{ url('admin/users/delete/'. $user->id) }}'; });" class="fa fa-trash delete-icon right" aria-hidden="true"></i>
				</li>
			@endforeach
			
		</ul>
	</div>
</div>
<div class="col s12 m6 l6">
		<div id="" class="row">
		{{ Form::open(array('url' => "api/users/update/$user_details->id" )) }}
			<div class="card hoverable"><!-- Customer's Details -->
				<div class="card-content">
					<span class="card-title">User Details</span>
					<p></p>
					<div class="client-details">
						<div class="input-field">
							<input type="text" name="name" value="{{ $user_details->first_name ?: '' }}" />
							<label>First Name</label>
						</div>
						<div class="input-field">
							<input type="text" name="name" value="{{ $user_details->last_name  ?: '' }}" />
							<label>Last Name</label>
						</div>
						<div class="input-field">
							<input type="email" name="email" class="validate" value="{{ $user_details->email  ?: '' }}">
							<label>Email</label>
						</div>

						<div class="input-field">
							<input type="text" name="password" class="" value="">
							<label>Password</label>
						</div>

						<div class="input-field">
							<select name="gender">
								<option value="m" {{ $user_details->gender == 'm' ? 'selected="selected"' : '' }} >Male</option>
								<option value="f" {{ $user_details->gender == 'f' ? 'selected="selected"' : '' }} >Female</option>
							</select>
							<label>Gender</label>
						</div>

						<div class="input-field">
							<select name="gender">
								<option value="admin"  {{ $user_details->role == 'admin' ? 'selected="selected"' : '' }} >Administrator</option>
								<option value="owner"  {{ $user_details->role == 'owner' ? 'selected="selected"' : '' }} >Shop Owner</option>
								<option value="worker"  {{ $user_details->role == 'worker' ? 'selected="selected"' : '' }} >Shop Worker</option>
								<option value="client"  {{ $user_details->role == 'client' ? 'selected="selected"' : '' }} >Client</option>
								<option value="customer" {{ $user_details->role == 'customer' ? 'selected="selected"' : '' }} >Customer</option>
							</select>
							<label>Type</label>
						</div>

						<div class="input-field">
							<input type="text" name="address_1" class="" value="{{ $user_details->address_1  ?: '' }}" autocomplete="false">
							<label>Address 1</label>
						</div>

						<div class="input-field">
							<input type="text" name="address_2" class="" value="{{ $user_details->address_2  ?: '' }}">
							<label>Address 2</label>
						</div>

						<div class="input-field">
							<input type="text" name="city" class="" value="{{ $user_details->city  ?: '' }}">
							<label>City</label>
						</div>

						<div class="input-field">
							<input type="text" name="zip_code" class="" value="{{ $user_details->zip_code  ?: '' }}">
							<label>Zip Code</label>	
						</div>

						<div class="input-field">
							<select name="country">
								<option value="swe" {{ $user_details->country == 'swe' ? 'selected="selected"' : '' }}>Sweden</option>
							</select>
							<label>Country</label>
						</div>

						<div class="input-field">
							<input type="text" name="telephone" class="" value="{{ $user_details->telephone  ?: '' }}">
							<label>Telephone</label>
						</div>

						<div class="input-field">
							<input type="text" name="mobile" class="" value="{{ $user_details->mobile  ?: '' }}">
							<label>Mobile</label>
						</div>

						<div class="input-field">
							<select name="lang">
								<option value="en" {{ $user_details->lang == 'en' ? 'selected="selected"' : '' }}>English</option>
							</select>
							<label>Default Language</label>
						</div>

					</div>
				</div>
				<div class="card-action row">
					<div class="col">
						<button class="btn waves-effect waves-light orange" title="Generate Password">
							<i class="fa fa-random"></i> Generate Password
						</button>
						<button class="btn waves-effect waves-light green"  type="submit" title="Generate Password">
							<i class="fa fa-floppy-o" aria-hidden="true"></i> {{ $user_details->id == '0' ? 'Save Information' : 'Update Information' }}
						</button>
					</div>
				</div>
			</div><!-- end Customer's Details -->
			{{ Form::close() }}
		</div>
	</div>
<div class="col s3">
		<div class="card hoverable hide"><!-- Shop -->
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

		<div ng-controller="userController">
		 		<ul ng-repeat="shop in shops">
		 			<li>@{{shop.name}}</li>
		 		</ul>
		 </div>
			

</div>


@endcomponent
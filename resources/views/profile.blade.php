@component('shop_owner.layouts.app')
	@slot('left')
		<div class="card hoverable">
			<div class="card-content">
				<ul class="collection">
					<li class="collection-item active" data-toggle="tab">
						<a href="#general_info">General Information</a>
					</li>
					<li class="collection-item" data-toggle="tab">
						<a href="#security_settings">Password</a>
					</li>
					<li class="collection-item" data-toggle="tab">
						<a href="#email_settings">Email Setting</a>
					</li>
				</ul>
			</div>
		</div>
	@endslot

	@slot('center')
		<div class="card hoverable">
			<div class="card-content">
				<div id="general_info" class="tab-content">
					<a class="btn-floating halfway-fab waves-effect waves-light green tooltipped" data-tooltip="{{__('messages.save_changes')}}" id="save_profile_changes">
						<i class="material-icons">check</i>
					</a>

					<form method="post" id="form_profile">
						<div class="input-field">
							<input type="text" class="validate" name="first_name" value="{{$user->first_name}}" required />
							<label for="first_name">First Name</label>
						</div>
						<div class="input-field">
							<input type="text" class="validate" name="last_name" value="{{$user->last_name}}" required />
							<label for="last_name">Last Name</label>
						</div>
						<div class="input-field">
							<select name="gender">
								@foreach(\App\Helpers\Helper::getGenders() as $key => $gender)
								<option value="{{$key}}" {{$user->gender == $key ? 'selected' : ''}}>{{$gender}}</option>
								@endforeach
							</select>
							<label for="gender">Gender</label>
						</div>
						<div class="input-field">
							<input type="text" name="telephone" value="{{$user->telephone}}" />
							<label for="telephone">Telephone</label>
						</div>
						<div class="input-field">
							<input type="text" name="mobile" value="{{$user->mobile}}" />
							<label for="mobile">Mobile</label>
						</div>
						<div class="input-field">
							<input type="text" name="social_security_id" value="{{$user->social_security_id}}" />
							<label for="social_security_id">Social Security ID</label>
						</div>
						<div class="input-field">
							<textarea class="materialize-textarea" name="address_1">{{$user->address_1}}</textarea>
							<label for="address_1">Address 1</label>
						</div>
						<div class="input-field">
							<textarea class="materialize-textarea" name="address_2">{{$user->address_2}}</textarea>
							<label for="address_2">Address 2</label>
						</div>
						<div class="input-field">
							<input type="text" name="city" value="{{$user->city}}" />
							<label for="city">City</label>
						</div>
						<div class="input-field">
							<input type="text" name="zip_code" value="{{$user->zip_code}}" />
							<label for="zip_code">Zip Code</label>
						</div>
						<div class="input-field">
							<div class="act-as-label">Country</div>
							<select name="country" class="select2" data-placeholder="Country">
								@foreach(App\Helpers\Helper::getCountries() as $key => $country)
								<option value="{{$key}}" {{$key == $user->country? 'selected': ''}}>{{$country}}</option>
								@endforeach
							</select>
						</div>
						<br/>
						<div class="input-field">
							<select name="lang">
								@foreach (Config::get('languages') as $lang => $language)
									<option value="{{$lang}}" {{$lang == App::getLocale() ? 'selected' : ''}}>{{$language}}</option>
							    @endforeach
							</select>
							<label for="lang">Language</label>
						</div>
					</form>
				</div>

				<div id="security_settings" class="tab-content" style="display: none;">
					<form id="form_security_settings">
						<a class="btn-floating halfway-fab waves-effect waves-light green tooltipped" data-tooltip="{{__('messages.save_changes')}}" id="save_security_settings">
							<i class="material-icons">check</i>
						</a>
						
						<div class="input-field">
							<input type="password" name="new_password" class="validate" />
							<label for="new_password">New Password</label> 
						</div>
						<div class="input-field">
							<input type="password" name="new_password_confirmation" class="validate" />
							<label for="new_password_confirmation">Confirm Password</label>
						</div>
						<div class="input-field">
							<input type="password" name="old_password" class="validate" />
							<label for="old_password">Old Password</label>
						</div>
					</form>
				</div>

				<div id="email_settings" class="tab-content" style="display: none;">
					<form id="form_email_settings">
						<a class="btn-floating halfway-fab waves-effect waves-light green tooltipped" data-tooltip="{{__('messages.save_changes')}}" id="save_email_settings">
							<i class="material-icons">check</i>
						</a>

						<div class="input-field">
							<input type="email" class="validate" data-error="Invalid email address" name="old_email" value="{{$user->email}}" required readonly/>
							<label for="email">Email</label>
						</div>

						<div class="input-field new-email">
							<input type="email" name="email" id="email" class="validate" data-error="Invalid email address" />
							<label for="email">New email</label>
						</div>

						<div class="input-field new-email">
							<input type="email" name="email_confirmation" id="email_confirmation" class="validate" data-error="Invalid email address" />
							<label for="email_confirmation">Confirm Email</label>
						</div>
					</form>
				</div>
			</div>
			<div class="card-action"></div>
		</div>
	@endslot

	@slot('right')
	<div class="card hoverable">
		<div class="card-content">
			<form method="post" action="{{url('profile/change/avatar')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="row">
					<div class="profile-avatar">
						<img class="circle tooltipped" data-tooltip="{{__('messages.change_avatar')}}" src="{{ isset($user->avatar) ? \App\Helpers\Helper::imageAsset($user->avatar) : asset('images/default.svg')}}" id="avatar_holder">
					</div>
				</div>
				<div class="input-field">
					<input type="file" id="change_avatar" name="avatar" style="display:none" required />
					<button class="btn" type="submit">Save</button>
				</div>
			</form>
		</div>
	</div>
	@endslot

	@slot('scripts')
	<script src="{{ mix('js/profile.js') }}"></script>
	@endslot
@endcomponent
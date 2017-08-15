@component('shop_owner.layouts.app')
<div  class="row" ng-controller="couponsController as vm">
	<div class="col s3">
		<div class="card hoverable">
			<div class="row card-content">
				
				<span class="card-title">Select a shop to view coupons</span>
				@if($shops)
					<select name="shop" ng-model="vm.selectedShop" ng-change="vm.updateSelectedShop(this)" ng-init="vm.selectedShop = '{{$shop->id}}'">
						@foreach ($shops as $myshop)
							<option value="{{$myshop->id}}" {{ ($shop->id == $myshop->id) ? 'selected="selected"' : ''}}>{{$myshop->name}}</option>
						@endforeach
					</select>
				@endif 

			</div>
		</div>
		<div class="card hoverable">
			<div class="row card-content">
				
				<span class="card-title">Coupon List</span></span>

				<div class="nav-wrapper">
			      <form>
			        <div class="input-field">
			          <input id="search" type="search" required>
			          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
			          <i class="material-icons">close</i>
			        </div>
			      </form>
			    </div>
			    <div><a href="javascript:;;">Filter Result <a href="/coupons/new"><span class="badge">New Coupon</span></a></div>
    			<div>
					<ul class="collection">
								
							@forelse ($coupons as $coupon)
								<li 	
									class="collection-item" 
									id="{{ $coupon->id }}"  
									>
									<a  href="/coupons/{{ $coupon->id }}">{{$coupon->code}}</a>
									<a  href="javascript:;;" onclick="window.reBuy.confirm('Are you sure to delete this?',function(){ window.location.href='/coupons/delete/{{ $coupon->id }}';})" class="secondary-content">
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
	</div>
	<div class="col s6">
		<div class="card hoverable">
			<form method="POST" id="couponform" name="couponform" action="/coupons/store">
		        <div class="card-content">
		          <span class="card-title">{{ (!$selectedCoupon->id) ? 'New' : 'Edit' }} Coupon</span>
					{{ csrf_field() }}
					<input type="hidden" name="id"  id="id" value="{{ (!$selectedCoupon->id) ? '' : $selectedCoupon->id }}"/>
					<div class="input-field">
						<input type="text" name="code"  required id="code" value="{{ (!$selectedCoupon->code) ? '' : $selectedCoupon->code }}"/>
						<label>Code</label>
					</div>
		          	<div class="input-field">
						<input type="text" name="date_start"  id="date_start" required  class="datepicker" value="{{ (!$selectedCoupon->date_start) ? '' : $selectedCoupon->date_start }}"/>
						<label>Start Date</label>
					</div>
					<div class="input-field">
						<input type="text" name="date_end" id="date_end" class="datepicker" required value="{{ (!$selectedCoupon->date_end) ? '' : $selectedCoupon->date_end }}"/>
						<label>End Date</label>
					</div>
					<div class="input-field">
						<select name="type" id="type" required>
							<option value="percent">Percent</option>
							<option value="amount">Amount</option>
						</select>
						<label>Type</label>
					</div>
					<div class="input-field">
						<input type="text" name="value" required id="value" value="{{ (!$selectedCoupon->value) ? '' : $selectedCoupon->value }}"/>
						<label>Value</label>
					</div>
					<div class="input-field">
							@if($selectedCoupon->is_active == 1)
								<p>
									<input type="radio" name="is_active" class="with-gap" id="activey" value="1" checked="checked" /> 
									<label for="activey">Active</label>
								</p>
								<p>
									<input type="radio" name="is_active" class="with-gap" id="activen" value="0"/> 
									<label for="activen">Inactive</label>
								</p>
							@else
								<p>
									<input type="radio" name="is_active" class="with-gap" id="activey" value="1"  /> 
									<label for="activey">Active</label>
								</p>
								<p>
									<input type="radio" name="is_active" class="with-gap" id="activen" value="0" checked="checked"/>
									<label for="activen">Inactive</label>
								</p>
							@endif
					</div>
		        </div>
		        <div class="card-action">
		        	@if(!empty($selectedCoupon->id ))
		        		<button  type="submit" class="waves-effect waves-light btn">Update Coupon</button>
		        	@else
		        		<button  type="submit" class="waves-effect waves-light btn">Add Coupon</button>
		        	@endif
		        </div>
	        </form>
	    </div>
	    @if(!empty($selectedCoupon->users->toArray())):
	    <div class="card hoverable">
            <div class="card-content">
              <span class="card-title">Coupon uses</span>
              <br>
	             <div class="row">
	             	<table>
				        <thead>
				          <tr>
				              <th>Name</th>
				              <th>Date Added</th>
				          </tr>
				        </thead>

				        <tbody>
				        @foreach($selectedCoupon->users as $user)
				          <tr>
				            <td>{{$user->first_name.' '.$user->last_name}}</td>
				            <td title="{{$user->pivot->created_at}}">{{$user->pivot->created_at->diffForHumans() }}</td>
				          </tr>
				         @endforeach
				        </tbody>
				      </table>
	             </div>
	         </div>
        </div>
        @endif
	</div>
	<div class="col s3">



	</div>

@endcomponent
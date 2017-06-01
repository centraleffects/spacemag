@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="couponsController" @endslot
	@slot('left')
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
			    <div><a href="javascript:;;">Filter Result <a href="/shop/coupons/new"><span class="badge">New Coupon</span></a></div>
    			<div>
					<ul class="collection">
								
							@forelse ($coupons as $coupon)
								<li 	
									class="collection-item" 
									id="{{ $coupon->id }}"  
									>
									<a  href="/shop/coupons/{{ $coupon->id }}">{{$coupon->code}}</a>
									<a  href="/shop/coupons/delete/{{ $coupon->id }}" class="secondary-content">
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
		<div class="card hoverable">
			<form method="POST" id="couponform" name="couponform" action="/{{Request::path()}}">
		        <div class="card-content">
		          <span class="card-title">{{ (!$selectedCoupon->id) ? 'New' : 'Edit' }} Coupon</span>
					{{ csrf_field() }}
					<input type="hidden" name="id"  id="id" value="{{ (!$selectedCoupon->id) ? '' : $selectedCoupon->id }}"/>
					<div class="input-field">
						<input type="text" name="code"  id="code" value="{{ (!$selectedCoupon->code) ? '' : $selectedCoupon->code }}"/>
						<label>Code</label>
					</div>
		          	<div class="input-field">
						<input type="text" name="date_start"  id="date_start"  class="datepicker" value="{{ (!$selectedCoupon->date_start) ? '' : $selectedCoupon->date_start }}"/>
						<label>Start Date</label>
					</div>
					<div class="input-field">
						<input type="text" name="date_end" id="date_end" class="datepicker" value="{{ (!$selectedCoupon->date_end) ? '' : $selectedCoupon->date_end }}"/>
						<label>End Date</label>
					</div>
					<div class="input-field">
						<select name="type" id="type">
							<option value="percent">Percent</option>
							<option value="amount">Amount</option>
						</select>
						<label>Type</label>
					</div>
					<div class="input-field">
						<input type="text" name="value" id="value" value="{{ (!$selectedCoupon->value) ? '' : $selectedCoupon->value }}"/>
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

	    <div class="card hoverable">
            <div class="card-content">
              <span class="card-title">Coupon uses</span>
              <br>

         </div>

	@endslot
	@slot('right')



	@endslot

@endcomponent
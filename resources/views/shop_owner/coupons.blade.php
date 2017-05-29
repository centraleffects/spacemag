@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="ClientController" @endslot
	@slot('left')
		<div class="card hoverable" ng-controller="articlesController">
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
			    <div><a href="javascript:;;">Filter Result <a href="/shop/coupon/new"><span class="badge">New Coupon</span></a></div>
    			<div>
					<ul class="collection">
								
							@forelse ($coupons as $coupon)
								<li 	
									class="collection-item" 
									id="{{ $client->id }}"  
									>
									<a  href="/shop/coupon/{{ $coupon->id }}">{{$coupon->name}}</a>
									<a  href="/shop/coupon/delete/{{ $coupon->id }}" class="secondary-content">
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
		<div>
			
		</div>
	@endslot
	@slot('right')

	

	@endslot

@endcomponent
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
		<div class="card hoverable">
			<form method="POST" action="/{{Request::path()}}">
	        <div class="card-content">
	          <span class="card-title">New Coupon</span>
				{{ csrf_field() }}
				<div class="input-field">
					<input type="text" name="name"  value=""/>
					<label>Code</label>
				</div>
	          	<div class="input-field">
					<input type="text" name="name"   class="datepicker" value=""/>
					<label>Start Date</label>
				</div>
				<div class="input-field">
					<input type="text" name="name" class="datepicker" value=""/>
					<label>End Date</label>
				</div>
				<div class="input-field">
					<input type="text" name="name" class="datepicker" value=""/>
					<label>Type</label>
				</div>
				<div class="input-field">
					<input type="text" name="name" class="datepicker" value=""/>
					<label>Value</label>
				</div>
				<div class="input-field">
					<input type="checkbox" name="name" class="datepicker" value=""/>
					<label>Active</label>
				</div>
	        </div>
	        <div class="card-action">
	           <button  type="submit" class="waves-effect waves-light btn">Add</button>
	        </div>
	        </form>
	    </div>
	@endslot
	@slot('right')



	@endslot

@endcomponent
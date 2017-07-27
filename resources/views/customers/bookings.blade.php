@component('customers.layouts.app')
	@slot('left')
		<!-- Shop Information -->
		<div class="card hoverable">
			<div class="row card-content">
				<span class="card-title">
					{{ __('messages.select_shop') }}
				</span>
				<ul class="collection">
					@forelse($shops as $key => $shop)
					<li class="collection-item select-shop {{$key == 0 ? 'active' : ''}}" data-id="{{$shop->id}}">
						{{ $shop->name }}
					</li>
					@empty
					<li class="empty-result">
						{{ __("messages.client_no_shop_yet") }}
					</li>
					@endforelse
				</ul>
				
			</div>
			<div class="card-action">
				
			</div>
		</div>
	@endslot

	@slot('center_right_collide')
		<div class="card hoverable">
			<div class="card-content">
				<ul class="tabs">
					<li class="tab active">
						<a class="card-title" href="#active_bookings">{{ __("Active Bookings") }}</a>
					</li>
					<li class="tab">
						<a class="card-title" href="#services">{{__("Services")}}</a>
					</li>
					<li class="tab">
						<a class="card-title" href="#salespots">{{__("Sale Spots")}}</a>
					</li>
				</ul>

				<div id="active_bookings">
					
				</div>

				<div id="services"></div>

				<div id="salespots">

				</div>
			</div>
			<div class="card-action">
				
			</div>
		</div>
	@endslot

	@slot('scripts')
		<script src="{{ mix('js/bookings.js') }}"></script>
	@endslot

@endcomponent
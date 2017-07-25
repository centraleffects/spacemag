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
						<a class="card-title" href="#shop_general_info">{{ __("Active Bookings") }}</a>
					</li>
					<li class="tab">
						<a class="card-title" href="#shop_settings">{{__("Services")}}</a>
					</li>
					<li class="tab">
						<a class="card-title" href="#shop_settings">{{__("Sale Spots")}}</a>
					</li>
				</ul>

				<div id="active_bookings" class="tab-content">
					
				</div>

				<div id="services" class="tab-content"></div>

				<div id="salespots" class="tab-content">
					<div class="map-area-container" id="mapsection">
						<div class="scrollspy panzoom-parent map-area white" id="floorplan-container">
							<div class="panzoom" id="spot-panzoom" 
									style="background: url(/floorplan/spots/test_12345.jpg);width: 2426px; height: 1121px;" 
									width="2426" height="1121" data-width="2426" data-height="1121"/>
								<div ng-repeat="(key, spot) in spots.data" 
											class="shopspot tooltipped draggable" 
											id="@{{'spt'+ spot.id}}" 
											data-position="bottom" data-delay="50" 
											ng-show="spots.data"
											ng-click="events.viewSpot(key,spot);"
											data-tooltip="@{{spot.name}}"
											style="@{{ 'margin-left:' + spot.x_coordinate + 'px; margin-top:' + spot.y_coordinate + 'px'}}">
								</div>
							</div>
						</div>
					</div>
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
@component('customers.layouts.app')
	
	@slot('left')
		<div class="card hoverable">
			<div class="row card-content">
				
				<span class="card-title">Shops List <span ng-bind="first_name"></span></span>

				<div class="nav-wrapper">
			      <form>
			        <div class="input-field">
			          <input id="search" class="sidebar-search-field" type="search" data-source="{{url('api/shops/search?api_token='.auth()->user()->api_token)}}" data-target-result="#search_results" required>
			          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
			          <i class="material-icons clear-search-field">close</i>
			        </div>
			      </form>
			    </div>
    			<div>
					<ul class="collection" id="search_results">
								
						@forelse ($all_shops as $shop)
							<li class="collection-item orig-data" data-id="{{ $shop->id }}">
								<a  href="/shops/view/{{ $shop->id }}" target="_blank" data-field="name">{{$shop->name}}</a>
								<a  href="javascript:void(0);" class="add-remove-shop secondary-content" data-id="{{$shop->id}}" data-action="add" data-field="do_action">
									<i class="material-icons">add</i>
								</a>
							</li>
						@empty
							<li class="collection-item empty-result">{!! __("No result to display") !!}</li>
						@endforelse

						{!! $all_shops->render() !!}
					</ul>
				</div>
			</div>
		</div>
	@endslot

	@slot('center')
		<div class="card hoverable">

			<div class="card-content">
				<span class="card-title">{{ __("My Shops List") }}</span>
				<ul id="myshops_list" class="collection">
					@forelse($shops as $shop)
						<li class="collection-item avatar" data-id="{{$shop->id}}">
							<i class="material-icons circle">location_city</i>
							<span class="title">
								<a href="/shops/view/{{ $shop->id }}" target="_blank">{{$shop->name}}</a>
							</span>
							<a href="javascript:void(0);" class="secondary-content add-remove-shop" data-id="{{$shop->id}}" data-action="remove">
								<i class="material-icons">close</i>
							</a>
						</li>
					@empty
						<p>{{ __("messages.client_no_shop_yet") }}</p>
					@endforelse
				</ul>
				{!! $shops->render() !!}
			</div>

			<div class="card-action">
				
			</div>
		</div>
	@endslot

	@slot('right')
		<div class="card hoverable">
			<div class="card-content">
				<span class="card-title">Some action</span>
			</div>
		</div>
	@endslot

	@slot('scripts')
		<script src="{{ mix('js/shops.js') }}"></script>
	@endslot
@endcomponent
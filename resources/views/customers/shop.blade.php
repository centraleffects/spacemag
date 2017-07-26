@component('customers.layouts.app')
	@slot('left')
		<!-- Shop Information -->
		<div class="card hoverable">
			<div class="row card-content">
				<div class="card-title">
					<i class="material-icons add-remove-favs" data-id="{{$shop->id}}" title="Add to favorites">favorite_boder</i> {{ $shop->name }}
				</div>
				<p class="thin">
					
				</p>
			</div>
			<div class="card-action">
				
			</div>
		</div>
	@endslot

	@slot('center')
		<div class="card hoverable">
			<div class="card-content">
				<div class="card-title">Sale Spots</div>
				<ul class="collapsible popout" data-collapsible="accordion">
					@forelse($shop->salespots()->get() as $salespot)
					<li>
						<?php $is_available = count($salespot->bookings()->get()) > 0 ? false : true; ?>
						<div class="collapsible-header">
							<span><i class="material-icons {{\App\Helpers\Helper::getSalesSpotTypeColor($salespot->type)}}-text">filter_drama</i> {{$salespot->name}}</span>
							<span class="badge new {{$is_available ? 'green' : 'red'}} pull-right" data-badge-caption="">
							{{ $is_available ? __('messages.available') : __('messages.occupied') }}
							</span>
						</div>
						<div class="collapsible-body">
							@if($is_available)

							@else

							@endif
						</div>
					</li>
					@empty
					<p>
						{{__('messages.no_salespot_yet')}}
					</p>
					@endforelse
				</ul>
			</div>
			<div class="card-action">
				
			</div>
		</div>
	@endslot

	@slot('right')

	@endslot

	@slot('scripts')
		<script>
			
		</script>
	@endslot

@endcomponent
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
				<ul class="collection" data-collapsible="accordion">
					@forelse($shop->salespots() as $salespot)
					<li>
						<div class="collapsible-header">{{$salespot->name}}</div>
						<div class="collapsible-body">
							// map of salespot here
						</div>
					</li>
					@empty

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
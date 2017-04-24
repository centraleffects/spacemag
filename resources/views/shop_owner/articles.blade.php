@component('shop_owner.layouts.app')
	@slot('controller') ng-controller="ArticleController" @endslot

	@slot('left')
		<div class="card hoverable" id="dashleft-sidebar">
			<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Articles</h5>
			<ul class="collection">
				<li class="collection-item green lighten-2 white-text-important" ng-repeat="x in articles" ng-click="viewArticle($index)">
					@component('layouts._partials.dragicon')
						@slot('style') fill-white @endslot
					@endcomponent
					<span>@{{ x.name }}</span>
					<a href="#!" class="right @{{ x.color }}-text" title="Delete"><i class="fa fa-trash"></i></a>
			    </li>

			    <li class="collection-item purple lighten-2 white-text-important">
					@component('layouts._partials.dragicon')
						@slot('style') fill-white @endslot
					@endcomponent
					<span>Ice Skating outfits</span>
					<a href="#!" class="right white-text" title="Delete"><i class="fa fa-trash"></i></a>
			    </li>

			    <li class="collection-item red lighten-2 white-text-important">
					@component('layouts._partials.dragicon')
						@slot('style') fill-white @endslot
					@endcomponent
					<span>Warm Jackets</span>
					<a href="#!" class="right white-text" title="Delete"><i class="fa fa-trash"></i></a>
			    </li>
			</ul>
			<div class="card-action">
				<button class="btn blue waves-effect waves-light" ng-click="addNewArticle()">
					<i class="fa fa-plus"></i> Add New Article
				</button>
			</div>
		</div>
	@endslot
	@slot('center')
		<div id="" class="row">
			<div class="card hoverable"><!-- Client's Details -->
				<div class="card-content">
					<div class="card-title">Article Details</div>
					<div class="input-field">
						<input type="text" name="name" />
						<label>Name</label>
					</div>
					<div class="input-field">
						<select name="category" class="icons">
							<option value="" data-icon="{{ url('images/bg.jpg') }}" class="circle" selected>Sports</option>
						    <option value="" data-icon="{{ url('images/office.jpg') }}" class="circle">Books</option>
						</select>
						<label>Category</label>
					</div>
					<div class="input-field">
						<div class="chips chips-tags"></div>
						<label>Tags</label>
					</div>
					<div class="input-field">
						<input type="number" name="original_price" />
						<label>Original Cost (Kr)</label>
					</div>
					<div class="input-field">
						<input type="number" name="price" />
						<label>Sold Cost (Kr)</label>
					</div>
					<div class="input-field row">
						<p>Print status of Label</p>
						<p class="col">
							<input type="checkbox" id="ps_1" name="print_status" value="printed" checked />
							<label for="ps_1">Printed</label>
						</p>
						<p class="col">
							<input type="checkbox" id="ps_2" name="print_status" value="locked" />
							<label for="ps_2">Locked</label>
						</p>
						<p class="col">
							<input type="checkbox" id="ps_3" name="print_status" value="edit" />
							<label for="ps_3">Edit</label>
						</p>
					</div>
					<div class="input-field row">
						<p>Label Print medium</p>
						<p class="col">
							<input type="checkbox" id="pm_1" name="print_medium" value="printed" checked />
							<label for="pm_1">Paper</label>
						</p>
						<p class="col">
							<input type="checkbox" id="pm_2" name="print_medium" value="carton">
							<label for="pm_2">Carton</label>
						</p>
						<p class="col">
							<input type="checkbox" id="pm_3" name="print_medium" value="Paper with sticking glue at the back" />
							<label for="pm_3">Paper with sticking glue at the back</label>
						</p>
					</div>
					<div class="input-field row">
						<p>Label Print medium</p>
						<p class="col">
							<input type="checkbox" id="s1" name="status" value="sold" checked />
							<label for="s1">Unsold</label>
						</p>
						<p class="col">
							<input type="checkbox" id="s2" name="status" value="unsold" />
							<label for="s2">Sold</label>
						</p>
					</div>
				</div>
				<div class="card-action">

				</div>
			</div><!-- end Client's Details -->
		</div>
	@endslot
	@slot('right')
		<div class="row">
			@include('shop_owner.partials._shopinfo')
		</div>
	@endslot
@endcomponent
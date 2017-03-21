@component('shop_owner.layouts.app')
	<div class="col s12 m12 l3">
		<div class="card hoverable" id="dashleft-sidebar">
			<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Articles</h5>
			<ul class="collection">
				<li class="collection-item green lighten-2 white-text-important">
					@component('layouts._partials.dragicon')
						@slot('style') fill-white @endslot
					@endcomponent
					<input type="text" value="Nike Shoes" />
					<a href="#!" title="Delete" class="white-text"><i class="fa fa-trash"></i></a>
			    </li>

			    <li class="collection-item red lighten-2 white-text-important">
					@component('layouts._partials.dragicon')
						@slot('style') fill-white @endslot
					@endcomponent
					<input type="text" value="Ice skating outfits"/>
					<a href="#!" title="Delete" class="white-text"><i class="fa fa-trash"></i></a>
			    </li>

			    <li class="collection-item purple lighten-2 white-text-important">
					@component('layouts._partials.dragicon')
						@slot('style') fill-white @endslot
					@endcomponent
					<input type="text" value="Warm jackets"/>
					<a href="#!" title="Delete" class="white-text"><i class="fa fa-trash"></i></a>
			    </li>
			</ul>
			<div class="card-action">
				<button class="btn blue waves-effect waves-light">
					<i class="fa fa-plus"></i> Add New Article
				</button>
			</div>
		</div>
	</div>
	<div class="col s12 m12 l6">
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
						<label>Original Cost</label>
					</div>
					<div class="input-field">
						<input type="number" name="price" />
						<label>Sold Cost</label>
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
	</div>
	<div class="col  s12 m12 l3">
		<div class="row">
			@include('shop_owner.partials._shopinfo')
		</div>
	</div>
@endcomponent
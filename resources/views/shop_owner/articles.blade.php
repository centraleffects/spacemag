@component('shop_owner.layouts.app')
<div ng-controller="ArticleController">
	@slot('left')
		<div class="card hoverable">
			<div class="row card-content">
				
				<span class="card-title" ng-bind="testx">Article List @{{ test }}</span>

				<div class="nav-wrapper">
			      <form>
			        <div class="input-field">
			          <input id="search" type="search" required>
			          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
			          <i class="material-icons">close</i>
			        </div>
			      </form>
			    </div>
			    <div><a href="javascript:;;">Filter Result</div>
    			<div>
					<ul class="collection">
								
							@forelse ($articles as $article)
								<li 	
									class="collection-item" 
									id="{{ $article->id }}"  
									>
									<a  href="/shop/articles/{{ $article->id }}">{{$article->name}}</a>
									<a  href="/shop/articles/delete/{{ $article->id }}" class="secondary-content">
										<i class="fa fa-trash-o right" aria-hidden="true"></i>
									</a>
								</li>
							@empty
								<li class="collection-item">No result to display</li>
							@endforelse

					</ul>
				</div>
			</div>
		</div>
	@endslot
	@slot('center')
		<div  class="row">
			<div class="card hoverable"><!-- Client's Details -->
				<div class="card-content">
					<div class="card-title">Details</div>
					<div class="input-field">
						<input type="text" name="name"  value="{{ $selectedArticle->name }}"/>
						<label>Name</label>
					</div>
					<div class="input-field">
						<select name="category" multiple="multiple">
							@if($categories)
							 <option value=""> All </option>
							@endif
						    @forelse ($categories as $category)
							   <option value="{{ $category->id }}"> {{ $category->name }} </option>
							@empty
							    <option value=""> None </option>
							@endforelse

						</select>
						<label>Category</label>
					</div>

					<div class="input-field tags">
						<select name="article-tags" id="article-tags"  multiple="multiple" data-tags="true"  data-allow-clear="true"></select>
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
			<div class="card hoverable"><!-- Shop Information -->
				<div class="card-content">
					<div class="card-title">Shop Information</div>
					<div class="input-field">
						<input type="text" name="name" value="{{$shop->name}}" />
						<label>Name</label>
					</div>
					<div class="input-field">
						<input type="text" name="url" value="{{$shop->url}}" />
						<label>Home page</label>
					</div>
					<div class="input-field">
						<input type="text" name="{{$shop->postel}}" />
						<label>Postel</label>
					</div>
					<div class="input-field">
						<select class="icons" multiple>
							<option value="all">Select all</option>
							<option value="1">January</option>
							<option value="2" selected>February</option>
							<option value="3">March</option>
							<option value="4" selected>April</option>
							<option value="5" selected>May</option>
							<option value="6">June</option>
							<option value="7" selected>July</option>
							<option value="8">August</option>
							<option value="9">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
					    </select>
						<label>Shop Owner</label>
					</div>
					<div class="input-field">
						<input type="number" name="article_commission" class="validate" />
						<label>Commission on Article Sale (Kr)</label>
					</div>
					<div class="input-field">
						<input type="number" name="salesspot_commission" class="validate">
						<label>Sales spot Rebuy Commission (Kr)</label>
					</div>
					<div class="input-field">
						Spots:
						<ul class="collapsible" data-collapsible="accordion">
							<li>
								<div class="collapsible-header">
									<span><i class="fa fa-caret-down"></i> A1 (Feb 15th - Mar 15th)</span>
								</div>
								<div class="collapsible-body">
									<button class="btn green waves-effect waves-light">End booking</button>
								</div>
							</li>
							<li>
								<div class="collapsible-header">
									<span><i class="fa fa-caret-down"></i> C4 (Jan 20th - Mar 10th)</span>
								</div>
								<div class="collapsible-body">
									<button class="btn green waves-effect waves-light">End booking</button>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="card-action">
					<p>
						<input type="checkbox" id="cb_newsletter_subscription" name="newsletter_subscription" />
						<label for="cb_newsletter_subscription">Enable Newsletter</label>
					</p>
				</div>
			</div><!-- End Shop Information -->
		</div>
	@endslot
</div>
@endcomponent
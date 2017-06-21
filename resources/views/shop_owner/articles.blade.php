@component('shop_owner.layouts.app')
<div >
	@slot('left')
		<div class="card hoverable" ng-controller="articlesController">
			<div class="row card-content">
				
				<span class="card-title">Article List</span>

				<div class="nav-wrapper">
			      <form>
			        <div class="input-field">
			          <input id="search" type="search" required>
			          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
			          <i class="material-icons">close</i>
			        </div>
			      </form>
			    </div>
			    <div><a href="javascript:;;">Filter Result <a href="/shop/articles/new"><span class="badge">New Article</span></a></div>
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
							<li class="collection-item">{!! __("No result to display") !!}</li>
						@endforelse

					</ul>
				</div>
			</div>
		</div>
	@endslot
	@slot('center')
		<div  class="row">
			<form method="POST" action="/{{Request::path()}}">
			{{ csrf_field() }}
				<div class="card hoverable"><!-- Client's Details -->
					<div class="card-content">
						<div class="card-title">Details</div>
						<div class="input-field">
							<input type="hidden" name="id" id="id"  value="{{ $selectedArticle->id }}"/>
							<input type="text" name="name"  value="{{ $selectedArticle->name }}"/>
							<label>Name</label>
						</div>
						<div class="input-field">
							<select name="categories" id="categories" multiple="multiple">
								@if($categories)
								 <option value=""> All </option>
								@endif

							    @forelse ($categories as $category)
							    	@if( in_array($category->id, $selected_article_categories) )
							    		<option value="{{ $category->id }}" selected="selected"> {{ $category->name }} </option>
							    	@else
							    		<option value="{{ $category->id }}"> {{ $category->name }} </option>
							    	@endif
								   
								@empty
								    <option value=""> None </option>
								@endforelse

							</select>
							<label>Category</label>
						</div>

						<div class="input-field tags">
							<select name="article-tags" id="article-tags"  multiple="multiple" data-tags="true" data-placeholder="Select an option" data-allow-clear="true">
								@if(isset($selected_article_tags) && !empty($selected_article_tags))
									@foreach( $selected_article_tags as $tag)
										<option value="{{ $tag['id'] }}" selected="selected"> {{ $tag['name'] }} </option>
									@endforeach
								@endif
							</select>
							<label>Tags</label>			
						</div>
						<div class="input-field">
							<input type="number" name="original_price" value="{{ (!$prices) ? '00.00' : $prices->original_price }}" />
							<label>Original Cost (Kr)</label>
						</div>
						<div class="input-field">
							<input type="number" name="price"  value="{{ (!$prices) ?  '00.00' : $prices->price }}" />
							<label>Sold Cost (Kr)</label>
						</div>
						<div class="input-field">
							<input type="number" name="quantity" />
							<label>Quantity</label>
						</div>

						<div class="input-field row">
							<p>Status</p>
							<p class="col">
								<input type="radio" id="s1" name="status" value="sold" checked />
								<label for="s1">Unsold</label>
							</p>
							<p class="col">
								<input type="radio" id="s2" name="status" value="unsold" />
								<label for="s2">Sold</label>
							</p>
						</div>
						
						<br><br>

						<div class="card-title">Labels</div>
						<div class="input-field row">
							<select name="label_status" id="label_status">
								<option value="Draft">Draft</option>
								<option value="Ready to Print">Ready to Print</option>
								<option value="Printed">Printed</option>
								<option value="Deleted">Deleted</option>
							</select>
							<label>Print status of Label</label>
						</div>
						<div class="input-field row">
							<select name="label_medium" id="label_medium">
								<option value="Simple Paper">Simple Paper</option>
								<option value="Cartonnage">Cartonnage</option>
								<option value="Textile">Textile</option>
								<option value="Gold Paper">Gold Paper</option>
							</select>
							<label>Label Print medium</label>
						</div>
						<div class="file-field input-field">
					      <div class="btn waves-effect waves-teal btn-flat">
					        <span>BROWSE Sample Picture</span>
					        <input type="file" name="sample_picture" id="sample_picture" value="{{ (!$selectedArticle->labels[0]->sample_picture) ?  '' : $selectedArticle->labels[0]->sample_picture }}">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text">
					        @if($selectedArticle->labels[0]->sample_picture)
					        	<div id="img-wrap">{<img style="width: 100px;height: 100px;" src="/labels/{{ $selectedArticle->labels[0]->sample_picture }}"></div>
					        @else
					        	<div id="img-wrap"></div>
					        @endif
					      </div>
					    </div>
					    <div class="file-field input-field">
					      <div class="btn waves-effect waves-teal btn-flat left">
					        <span>BROWSE Label Design</span>
					        <input type="file" name="label_design" id="label_design">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text">
					        @if($selectedArticle->labels[0]->filename)
					        	<div id="img-wrap">{<img style="width: 100px;height: 100px;" src="/labels/{{ $selectedArticle->labels[0]->filename }}"></div>
					        @else
					        	<div id="img-wrap"></div>
					        @endif
					      </div>
					      <div class="file-field  input-field">
								<input type="number" name="label_quantity" value="" />
								<label>Label Quantity</label>
						   </div>
					    </div>

					</div>
					<div class="row card-action">
			          <button  type="submit" class="addUpdate right waves-effect waves-light btn">{{ ($selectedArticle->id) ? "Update" : "Add Article" }}</button>
			        </div>
				</div><!-- end Client's Details -->
				</form>
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
				</div>
				<div class="card-action">
					<p>
						<input type="checkbox" id="cb_newsletter_subscription" name="newsletter_subscription" />
						<label for="cb_newsletter_subscription">Enable Newsletter</label>
					</p>
				</div>
			</div><!-- End Shop Information -->

			<div class="card hoverable">
	            <div class="card-content">
	              <span class="card-title">Assign Client</span>
	              <br>
	              <div></div>
	            </div>
	            <div class="card-action">
	              <a href="javascript:;;">Change</a>
	            </div>
	         </div>

			<div class="card hoverable">
	            <div class="card-content">
	              <span class="card-title">Spots</span>
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

			<div class="card hoverable">
	            <div class="card-content">
	              <span class="card-title">BarCode</span>
	              <br>
	              <div><img src="{{ Helper::getBarCode( $selectedArticle->id.' '.$selectedArticle->name ) }}"/></div>
	              <div>{{$selectedArticle->name}}</div>
	            </div>
	            <div class="card-action">
	              <a href="javascript:;;" onclick="window.reBuy.alert('Error: Cannot Find Printer Device')">Print</a>
	            </div>
	         </div>

		</div>
	@endslot
</div>
@endcomponent
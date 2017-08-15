@component('shop_owner.layouts.app')
<div  class="row" ng-controller="articlesController as vm">
	<div class="col s3">
		<div class="card hoverable">
			<div class="row card-content">
				
				<span class="card-title">Select a shop to view articles</span>
				@if($shops)
					<select name="shop" ng-model="vm.selectedShop" ng-change="vm.updateSelectedShop(this)" ng-init="vm.selectedShop = '{{$shop->id}}'">
						@foreach ($shops as $myshop)
							<option value="{{$myshop->id}}" {{ ($shop->id == $myshop->id) ? 'selected="selected"' : ''}}>{{$myshop->name}}</option>
						@endforeach
					</select>
				@endif 

			</div>
		</div>
		<div class="card hoverable">
			<div class="row card-content">
				
				<span class="card-title">Article List</span>

				<!-- <div class="nav-wrapper">
			      <form>
			        <div class="input-field">
			          <input id="search" type="search" required>
			          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
			          <i class="material-icons">close</i>
			        </div>
			      </form>
			    </div> -->
			    <div><a href="javascript:;;">Filter Result <a href="/articles/new"><span class="badge">New Article</span></a></div>
    			<div>
					<ul class="collection">
								
						@forelse ($articles as $article)
							<li 	
								class="collection-item" 
								id="{{ $article->id }}"  
								>
								<a  href="/articles/{{ $article->id }}">{{$article->name ? $article->name : 'Unknown Article'}}</a>
								<a  href="javascript:;" onclick="window.reBuy.confirm('Are you sure to delete this article?',function(){ location.href='/articles/delete/{{ $article->id }}';})" class="secondary-content">
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
	</div>
	@if(!isset($_GET['preview']))
	<div class="col s6">
		@if($new_article || $selectedArticle->id )
			<div  class="row">
				<form method="POST" action="/{{Request::path()}}">
				{{ csrf_field() }}
					<div class="card hoverable"><!-- Client's Details -->
						<div class="card-content">
							<div class="card-title">Details</div>
							<div class="input-field">
								<input type="hidden" name="id" id="id"  value="{{ $selectedArticle->id }}"/>
								<input type="text" name="name"  value="{{ $selectedArticle->name ? $selectedArticle->name : 'Unknown Article' }}"/>
								<label>Name</label>
							</div>
							<div class="input-field">
								<select name="categories"  id="categories" multiple="multiple">
									@if(empty($selected_article_categories))
										<option disabled value="">Please select a category</option>
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
								<select  name="article-tags" class="browser-default" id="article-tags"   multiple="multiple"  data-tags="true" data-placeholder="Enter a tag" data-allow-clear="true">
									@if(!empty($selected_article_tags))
										@foreach( $selected_article_tags as $tag)
											<option value="{{ $tag['id'] }}" selected> {{ $tag['name'] }} </option>
										@endforeach
									@endif
								</select>
								<label>Tags</label>			
							</div>
							<p>&nbsp;</p>
							<div class="input-field">
								<input type="number" name="original_price" value="{{ (!$prices) ? '00.00' : $prices->original_price }}" />
								<label>Original Cost (Kr)</label>
							</div>
							<div class="input-field">
								<input type="number" name="price"  value="{{ (!$prices) ?  '00.00' : $prices->price }}" />
								<label>Sold Cost (Kr)</label>
							</div>
							<div class="input-field">
								<input type="number" name="quantity" value="{{$selectedArticle->quantity}}" />
								<label>Quantity</label>
							</div>

							<div class="input-field row">
								<p>Sold in bulk</p>
								<p class="col">
									{{Form::radio('sold_in_bulk', '1', ($selectedArticle->sold_in_bulk == 1) ? true : false,  [ 'id' => 's1' ] )}}
									<label for="s1">Yes</label>
								</p>
								<p class="col">
									{{Form::radio('sold_in_bulk', '0',  ($selectedArticle->sold_in_bulk == 0) ? true : false,  [ 'id' => 's2' ] ) }}
									<label for="s2">No</label>
								</p>
							</div>

							<div class="input-field row">
								<p>Sold in pieces</p>
								<p class="col">
									{{
										Form::radio('sold_in_pieces', '1',   
										($selectedArticle->sold_in_pieces == 1 	) ? true : false,  [ 'id' => 's11' ])
									}}
									<label for="s11">Yes</label>
								</p>
								<p class="col">
									{{
										Form::radio('sold_in_pieces', '0', ($selectedArticle->sold_in_pieces == 0) ? true : false,  [ 'id' => 's22' ])
									}}
									<label for="s22">No</label>
								</p>
							</div>
							
							<br><br>

							<div class="card-title">Labels</div>
							<div class="input-field row">							
								{{
									Form::select('label_status', [
										'draft' => 'Draft',
										'ready to print' => 'Ready to Print',
										'printed' => 'Printed',
										'deleted' => 'Deleted'
									], !empty($selectedArticle->labels) ? $selectedArticle->labels->status : '')
								}}
								<label>Print status of Label</label>
							</div>
							<div class="input-field row">
								{{
									Form::select('label_medium', [
										'Simple Paper' => 'Simple Paper',
										'Cartonnage' => 'Cartonnage',
										'Textile' => 'Textile',
										'Gold Paper' => 'Gold Paper'
									], !empty($selectedArticle->labels) ? $selectedArticle->labels->print_medium  : '')
								}}
								<label>Label Print medium</label>
							</div>
							<div class="input-field row">
								<input type="number" name="label_quantity" value="{{ !empty($selectedArticle->labels) ? $selectedArticle->labels->label_quantity : ''}}" />
								<label>Label Quantity</label>
							</div>

						</div>
						<div class="row card-action">
				          <button  type="submit" class="addUpdate right waves-effect waves-light btn">{{ ($selectedArticle->id) ? "Update" : "Add Article" }}</button>
				        </div>
					</div><!-- end Client's Details -->
					</form>
			</div>
			@endif
	</div>
	@else
	<div class="col s6">
		<div class="card hoverable"><!-- Client's Details -->
			<div class="card-content">
				<div class="preview">
					<iframe class="frame" src="/articles/print/{{ $article->id }}?preview" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
	@endif
	<div class="col s3">
		@if( isset($shop) )
		<div class="row">
			<?php /*
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
				 */ ?>

			<!-- <div class="card hoverable">
	            <div class="card-content">
	              <span class="card-title">Assign Client</span>
	              <br>
	              <div></div>
	            </div>
	            <div class="card-action">
	              <a href="javascript:;;">Change</a>
	            </div>
	         </div> -->

			<!-- <div class="card hoverable">
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

	         </div> -->

	        @if($selectedArticle->id )
				<div class="card hoverable">
		            <div class="card-content">
		               <span class="card-title">BarCode</span>
		               <br>
		               @if(!empty($selectedArticle->barcode_id))
			               <div class="barcodebox_preview barcodebox">
								<div><img src="{{ Helper::getBarCode( $selectedArticle->barcode_id ) }}"/></div>
								<div class="barcode">{{$selectedArticle->barcode_id}}</div>
								<div class="article-name">{{$selectedArticle->name}}</div>
								<div>Cost: {{$prices->price}} {{$shop->currency}}</div>
							</div>
						@endif
						<div class="clearfix"></div>
		            </div>
		            <div class="card-action">
		            	@if(!isset($_GET['preview']))
		              		<a href="/articles/{{$selectedArticle->id}}?preview">Print Preview</a>
		              	@else
		              		<a href="/articles/{{$selectedArticle->id}}">Back</a>
		              	@endif
		            </div>
		         </div>
	        @endif

		</div>
		@else
		<div class="card">
			<div class="card-content">
				<a class="lead" href="{{url('my-shops')}}">{{ __("messages.client_no_shop_yet") }}</a>
			</div>
		</div>
		@endif
	</div>
</div>
@endcomponent
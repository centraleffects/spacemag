@component('shop_owner.layouts.app')
	<div id="shop-tab" ng-controller="dashboardController">
		<div class="col s9">

			<form  id="form_shopinfo">
				{{csrf_field()}}
				<div class="card hoverable shopinfo">
					<button class="btn btn-floating halfway-fab waves-effect waves-light green tooltipped" data-tooltip="Update Shop" type="submit" id="update_shop_info">
						<i class="material-icons">check</i>
					</button>
					<div class="row card-content">
						<ul class="tabs">
							<li class="tab active">
								<a class="card-title" href="#shop_general_info">{{ __("messages.shop_info") }}</a>
							</li>
							<li class="tab">
								<a class="card-title" href="#shop_settings">{{__("messages.shop_settings")}}</a>
							</li>
						</ul>

						<div id="shop_general_info">
							<br/>
							<input type="hidden" name="id" value="{{$shop->id}}">
							<div class="input-field">
								<input type="text" name="name" value="{{$shop->name}}">
								<label>{{__("messages.name")}}</label>
							</div>

							<div class="input-field">
								<textarea name="description" class="materialize-textarea">{{$shop->description}}</textarea>
								<label>{{__("messages.description")}}</label>
							</div>

							<div class="input-field">
								<input type="text" name="url" value="{{$shop->url}}">
								<label>{{__("messages.homepage")}}</label>
							</div>

						<!-- 	<div class="input-field">
								<input type="text" name="postel" value="{{$shop->shop_postel}}">
								<label>{{__("messages.postel")}}</label>
							</div> -->

							<div class="input-field">
								<select name="currency">
									@foreach($currencies as $key => $value)
									<option value="{{$key}}" {!! $key == $shop->currency ? "selected" : "" !!}>{{$value." ($key)"}}</option>
									@endforeach
								</select>
								<label>{{__("messages.currency")}}</label>
							</div>
						</div>

						<div id="shop_settings" style="display: none;">
							<br/>
							<div class="input-field">
								
								<select name="cleanup_schedule[]" id="cleanup_schedule" multiple>
									<option value="" disabled>Set which days cleaning will occur.</option>
									@foreach($days as $day)
									<option value="{{$day}}" {!! in_array($day, $shop->cleanup_schedule) ? "selected" : "" !!}>{{__('messages.day.'.$day)}}</option>
									@endforeach
								</select>
								<label>{{__('messages.cleanup')}}</label>
							</div>

							<div class="input-field">
								<select name="commission_article_sale">
									@for($x=1; $x < 101; $x++)
									<option value="{{$x}}" {{$shop->commission_article_sale == $x ? 'selected' : ''}}>{{$x}}</option>
									@endfor
								</select>
								<label>{{__("messages.commission_article")}} (%)</label>
							</div>

							<div class="input-field">
								<select name="commission_salespot">
									@for($x=1; $x < 101; $x++)
									<option value="{{$x}}" {{$shop->commission_salespot == $x ? 'selected' : ''}}>{{$x}}</option>
									@endfor
								</select>
								<label>{{__("messages.rebuy_commission")}} (%)</label>
							</div>

							<div class="input-field">
								<select name="spot_free_max_prebook">
									@for($x=2; $x < 8; $x++)
									<option value="{{$x}}" {{$shop->spot_free_max_prebook == $x ? 'selected' : ''}}>{{$x}}</option>
									@endfor
								</select>
								<label>{{__("messages.free_max_prebooked")}}</label>
							</div>

							<div class="input-field">
								<select name="spot_max_end_prebook">
									@for($x=1; $x < 6; $x++)
									<option value="{{$x}}" {{$shop->spot_max_end_prebook == $x ? 'selected' : ''}}>{{$x}}</option>
									@endfor
								</select>
								<label>{{__("messages.spot_max_end_prebook")}}</label>
							</div>
						</div>

					</div>
				</div>
			</form>
		</div>
		<div class="col s3">
			<div class="card hoverable">
				<div class="row card-content">
					<span class="card-title">Upload Store Floor Plan</span>
					<a href="javascript:;;" onclick="document.getElementById('uploadFloorplan').click()"> Browse Floor Plan</a>
					{{ Form::open(array('url' => '/shop/updatefloorplan','files'=>'true', 'id' => 'uploadFloorplanForm')) }}
						{{csrf_field()}}
						<input type="file" id="uploadFloorplan" onchange="document.getElementById('uploadFloorplanForm').submit()" name="uploadFloorplan" style="display:none">
					{{ Form::close() }}
					<br>
					<div>
						@if(file_exists(FLOOR_MAP.'img_'.$shop->id.'.jpg'))
							<img src="/floorplan/img_{{$shop->id}}.jpg"  class="materialboxed responsive-img"/>
						@endif
					</div>
				</div>
			</div>	

			<div class="card hoverable">
				<div class="row card-content">
					<span class="card-title">Email Invitation</span>
					<button class="btn waves-effect waves-light blue" ng-click="events.sendEmailInvitation">
						Send
					</button>
				</div>
			</div>	
		</div>
	</div>
@endcomponent
@component('shop_owner.layouts.app')
	<div id="shop-tab" ng-controller="dashboardController">
		<div class="col s9">

			<form  id="form_shopinfo">
				{{csrf_field()}}
				<div class="card hoverable shopinfo">
					<button class="btn btn-floating halfway-fab waves-effect waves-light green tooltipped" data-tooltip="Update Shop" type="submit" id="update_shop_info">
						<i class="fa fa-refresh"></i>
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

							<div class="input-field">
								<input type="text" name="postel" value="{{$shop->shop_postel}}">
								<label>{{__("messages.postel")}}</label>
							</div>

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
								<input type="text" name="commission_article_sale">
								<label>{{__("messages.commission_article")}}</label>
							</div>

							<div class="input-field">
								<input type="text" name="commission_salespot">
								<label>{{__("messages.rebuy_commission")}}</label>
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
					<button class="btn waves-effect waves-light blue" ng-click="events.viewTab('salespot')">
						View Salespot
					</button>
					<a href="javascript:;;" onclick="document.getElementById(\"browsefile\").click()"> Browse Floor Plan</a>
					<input type="file" id="uploadFloorplan" name="uploadFloorplan" style="display:none">
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
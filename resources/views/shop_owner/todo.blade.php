@component('shop_owner.layouts.app')

	@slot('left')
		<div class="card hoverable" id="dashleft-sidebar">
			<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Shops</h5>
			<ul class="collection">
				<li class="collection-item" ng-repeat="shop in shops">
					@include('layouts._partials.dragicon')
					<span>@{{ shop.name }}</span>
					<a href="#!" title="Delete"><i class="fa fa-trash"></i></a>
			    </li>

			    <li class="collection-item">
					@include('layouts._partials.dragicon')
					<input type="text" value="Nike">
					<a href="#!" title="Delete"><i class="fa fa-trash"></i></a>
			    </li>
			</ul>
		</div>
	@endslot
	@slot('center')
		<div id="" class="row">
			<div class="card hoverable"><!-- Client's Details -->
				<div class="card-content">
					<span class="card-title">Tasks</span>
					<div>
						<button class="btn waves-effect waves-light green">
							<i class="fa fa-plus"></i> Add Task
						</button>
					</div>
					<ul class="collection tasks-list">
						<li class="collection-item row task-item" ng-repeat="task in tasks">
							@component('layouts._partials.dragicon')
								@slot('style') fill-grey @endslot
							@endcomponent
							<span class="mark-as-complete circular-button-view">
								@include('layouts._partials.checkbox')
							</span>
							<span class="description">
								Please open shop at 9:00 am.
							</span>
							<span class="assignee pull-right">
								<span class="item">
								    <img class="circle" src="http://localhost:8000/images/office.jpg">
								</span>
								<span class="item">
								    <img class="circle" src="http://localhost:8000/images/office.jpg">
								</span>
							</span>
						</li>
						<!-- <li class="collection-item row task-item">
							<span class="col s2 m2 l2">
								@component('layouts._partials.dragicon')
									@slot('style') fill-grey @endslot
								@endcomponent
								<span class="mark-as-complete circular-button-view">
									@include('layouts._partials.checkbox')
								</span>
							</span>
							<span class="col s10 m10 l10">
								<input type="text" name="description" value="Please open shop at 9:00 am." />
							</span>
						</li> -->
				    </ul>
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
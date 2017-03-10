@component('admin.layouts.app')
<div class="toolbar row">
	<div class="col s12">
		<nav>
		    <div class="nav-wrapper">
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li>
						<a href="#" class="btn btn-flat waves-effect  waves-light">
							Customers
						</a>
					</li>
					<li>
						<a href="#" class="btn btn-flat waves-effect  waves-light">
							Clients
						</a>
					</li>
					<li>
						<a href="#" class="btn btn-flat waves-effect  waves-light">
							Shop Status
						</a>
					</li>
					<li>
						<a href="#!" class="btn btn-flat waves-effect waves-light">
							Add Shop Workers
						</a>
					</li>
					<li>
						<a href="#!" class="btn btn-flat waves-effect waves-light">
							Todo List
						</a>
					</li>
					<li>
						<a href="#!" class="btn btn-flat waves-effect waves-light">
							Todo for workers
						</a>
					</li>
				</ul>
		    </div>
		</nav>
	</div>
</div>
<div class="row content-wrap">

	<div class="col s3">
		<div  class="white" id="dashleft-sidebar">
			<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Shops</h5>
			<ul class="collection">
				<li class="collection-item">
					<svg class="svgIcon itemRow-dragIcon" viewBox="0 0 32 32" title="drag handle">
						<path d="M 14 5.5 a 3 3 0 1 1 -3 -3 A 3 3 0 0 1 14 5.5 Z m 7 3 a 3 3 0 1 0 -3 -3 A 3 3 0 0 0 21 8.5 Z m -10 4 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 12.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 12.5 Z m -10 10 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 22.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 22.5 Z"></path>
					</svg>
					<input type="text" value="Rebuy store">
					<a href="#!" title="Delete"><i class="fa fa-trash"></i></a>
			    </li>

			    <li class="collection-item">
					<svg class="svgIcon itemRow-dragIcon" viewBox="0 0 32 32" title="drag handle">
						<path d="M 14 5.5 a 3 3 0 1 1 -3 -3 A 3 3 0 0 1 14 5.5 Z m 7 3 a 3 3 0 1 0 -3 -3 A 3 3 0 0 0 21 8.5 Z m -10 4 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 12.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 12.5 Z m -10 10 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 22.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 22.5 Z"></path>
					</svg>
					<input type="text" value="Nike">
					<a href="#!" title="Delete"><i class="fa fa-trash"></i></a>
			    </li>
			</ul>
		</div>
	</div>
	<div class="col s6">
		<div id="list-info" class="white">
			<div class="row" id="info-nav">
				title here
			</div>
			<div class="row" id="info-content">
				content here
			</div>
		</div>
	</div>
	<div class="col s3">
	</div>

</div>
@endcomponent
<div class="col s12 m12 l3">
	<div class="card hoverable" id="dashleft-sidebar">
		<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of {!! str_plural($fnName) !!}</h5>
		<div class="input-field search-div">
			<input type="text" name="search" ng-model="search" placeholder="Search for {{ $fnName or '' }}" />
		</div>
		<ul class="collection">
			<li class="collection-item" ng-repeat="x in {{$list}} | filter:search">
				@include('layouts._partials.dragicon')
				<span ng-click="view{{$fnName}}($index)">@{{ x.first_name+' '+x.last_name }}</span>
				<a href="#!" title="Delete" class="right"><i class="fa fa-trash"></i></a>
		    </li>
		    <li ng-show="listIsEmpty">
			    <span>
			    	<i class="fa fa-user-times"></i>
			    	This shop doesn't have any {!! str_singular($fnName) !!} at the moment.
			    </span>
		    </li>
		</ul>
		
		@if( isset($btnText) )
		<div class="card-action">
			<button class="btn waves-effect waves-light green">
				<i class="fa fa-plus"></i>
				{{ $btnText }}
			</button>
		</div>
		@endif
	</div>
</div>
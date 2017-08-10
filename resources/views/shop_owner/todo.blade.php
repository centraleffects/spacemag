@component('shop_owner.layouts.app')
	@slot('left')
		<div class="card hoverable" id="dashleft-sidebar">
			<div class="card-content">
				<h5 class="flow-text"><i class="fa fa-caret-down" aria-hidden="true"></i> {{$shop->name}} Salespots</h5>
				
				<div class="collection">
					@forelse($salespots as $salespot)
					<?php $count = $salespot->todoTasks()->where('done', false)->count(); ?>

					<a class="collection-item salespot {{$loop->first ? 'active' : ''}}" href="javascript:void(0);" data-id="{{$salespot->id}}" data-id="{{ $salespot->id }}">
						<span class="name">{{ $salespot->name }}</span>
						<span class="badge {{$count > 0 ? 'new orange' : ''}}">{{ $count > 0 ? $count : '' }}</span>
					</a>
					@empty
					<p class="muted">{{__('messages.no_salespot_yet')}}</p>
					@endforelse
				</div>
			</div>
		</div>
	@endslot

	@slot('center')
		<div id="todoapp" class="row">
			<div class="card hoverable"><!-- Client's Details -->
				<div class="card-content">
					<span class="card-title">{{__("Todo List")}}
						<span class="active-salespot">
							{{$salespots->first() ? ' - '.$salespots->first()->name : ''}}
						</span>
					</span>
					
					<div id="main" style="display: block;">
						<ul class="collection todo-list">
						@forelse($salespots->first()->todoTasks()->get() as $todo)
							<li class="collection-item row todo-item" data-id="{{ $todo->id }}">
								<span class="col">
									@component('layouts._partials.dragicon')
										@slot('style') fill-grey @endslot
									@endcomponent
									<label for="_done_{{$todo->id}}" data-id="{{$todo->id}}" class="mark-as-complete circular-button-view {{$todo->done ? 'done' : ''}}">
										@include('layouts._partials.checkbox')
									</label>
								</span>
								<span class="col col s8 m8 l8">
									<span class="description {{$todo->done ? 'done' : ''}}" title="Double click to edit">{{ $todo->description }}</span>
								</span>
								<span class="col right">
									@if($todo->completor != null)
									<div class="chip" title="Completed by {!! App\Helpers\Helper::getUserFullName($todo->completor) !!}">
									    <img src="{!! asset($todo->completor->avatar) !!}" alt="Assigned">
									    {!! App\Helpers\Helper::getUserFullName($todo->completor) !!}
									</div>
									@endif
								</span>
							</li>
						@empty
						<div class="alert alert-info" style="margin-left: 15px;">No task on this salespot yet.</div>
						@endforelse
						</ul>
					</div>
				</div>
				<div class="card-action">
					<div class="row">
						<div class="col">
							<div class="todo-count"></div>
						</div>
						<div class="col m9 l9">
							<a id="clear-completed" class="btn waves-effect waves-light red small right" ng-click="clear()" ng-show="hasDone()">
								Clear <span >@{{ (todos.length - remaining()) }} @{{itemText()}}</span>.
							</a>
						</div>
					</div>
				</div>
			</div><!-- end Todo -->
		</div>
	@endslot

	@slot('right')
		<div class="card hoverable">
			<div class="card-content">
				
			</div>
		</div>
	@endslot

	@slot('scripts')
		<script src="{{mix('js/todo.js')}}"></script>
	@endslot
@endcomponent
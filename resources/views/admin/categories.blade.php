@component('admin.layouts.app')
<div class="col s4">
	<div class="card hoverable" ng-model="shops">
		<form method="post" action="/admin/categories/new">
			{{ csrf_field() }}
			<div class="row card-content">
				<span class="card-title">Categories</span>
				<div class="row">
					<div>
						<div class="input-field">
							<input type="text" name="name"  required="required">
							<label>Add New Category</label>
						</div>
						<div class="input-field">
							<textarea name="description" class="materialize-textarea" required="required"></textarea>
							<label>Description</label>
						</div>
						<div class="input-field">
							
						</div>
					</div>	
					
				</div>
			</div>
			<div class="row card-action">
	          <button  type="submit" class="right waves-effect waves-light btn">Add New Category</button>
	        </div>
        </form>
	</div>	
</div>

<div class="col s4">
	<div class="card hoverable">
		<div class="row card-content">
			
			<span class="card-title">List</span>
			<div class="collection">
						
					@forelse ($categories as $category)
						<div 	
							class="collection-item" 
							id="{{ $category->id }}"  
							>
							{{$category->name}}
							<a  href="/admin/categories/delete/{{ $category->id }}" class="secondary-content">
								<i class="fa fa-trash-o right" aria-hidden="true"></i>
							</a>
						</div>
					@empty
						<div class="collection-item">No result to display</div>
					@endforelse

			</div>

		</div>
	</div>	
</div>
<div class="col s3">
</div>
@endcomponent
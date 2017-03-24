@component('admin.layouts.app')
<div class="col s3">
	<div  class="card hoverable" id="dashleft-sidebar">
		<h5><i class="material-icons">face</i> List of Users</h5>
		<ul class="collection">

				<li class="collection-item">
					<svg class="svgIcon itemRow-dragIcon" viewBox="0 0 32 32" title="drag handle"><path d="M 14 5.5 a 3 3 0 1 1 -3 -3 A 3 3 0 0 1 14 5.5 Z m 7 3 a 3 3 0 1 0 -3 -3 A 3 3 0 0 0 21 8.5 Z m -10 4 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 12.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 12.5 Z m -10 10 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 22.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 22.5 Z"></path></svg>
					<span><a href=""></a></span> 
					<a href="#">
						<i class="fa fa-pencil-square-o edit-icon right" aria-hidden="true"></i>
					</a>
					<i class="fa fa-trash delete-icon right" aria-hidden="true"></i>
				</li>

			
		</ul>
	</div>
</div>
<div class="col s12 m6 l6">
		<div id="" class="row">
		
			
		</div>
	</div>
<div class="col s3">
		<div class="card hoverable hide"><!-- Shop -->
			<div class="card-content">
				<div class="card-title">Shop Name</div>
				<div class="row">
					<div class="col">
						<p>1. Rebuy Shop</p>
					</div>
					<div class="col">
						<p>	
							<input type="checkbox" id="newsletter_subscription" name="newsletter_subscription" value="true" />
							<label for="newsletter_subscription">Enable Newsletter</label>
						</p>
					</div>
					<div class="col">
						<a class="chip waves-effect waves-light green white-text">
							<i class="fa fa-sign-in"></i> Login Customer A/C
						</a>
					</div>
				</div>
			</div>
			<div class="card-action">

			</div>
		</div><!-- End Shop -->

		<div class="card hoverable hide"><!-- Send Invitation -->
			<div class="card-content">
				<div class="card-title"> Invite</div>

				<div class="input-field">
					<input type="text" name="name" />
					<label>Name of Customer</label>
				</div>
				<div class="input-field ">
					<input type="email" name="email" class="validate" />
					<label>Email Address</label>
				</div>
			</div>
			<div class="card-action">
				<button class="btn waves-effect waves-light green">
					<i class="fa fa-send"></i> Send invitation link/password
				</button>
			</div>
		</div>

		<div ng-controller="UserController">
		 		<span>@{{ hello }}</span>
		 </div>
			

</div>
@endcomponent
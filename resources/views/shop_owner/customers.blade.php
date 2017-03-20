@component('shop_owner.layouts.app')
	<div class="col s12 m12 l3">
		<div class="card hoverable" id="dashleft-sidebar">
			<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Customers</h5>
			<ul class="collection">
				<li class="collection-item">
					@include('layouts._partials.dragicon')
					<input type="text" value="John Doe">
					<a href="#!" title="Delete"><i class="fa fa-trash"></i></a>
			    </li>

			    <li class="collection-item">
					@include('layouts._partials.dragicon')
					<input type="text" value="Johny Doer">
					<a href="#!" title="Delete"><i class="fa fa-trash"></i></a>
			    </li>
			</ul>
			<div class="card-action">
				<a class="btn waves-effect waves-light blue" href="{{ url('shop/customers/create') }}">
					<i class="fa fa-plus"></i> Add New Customer
				</a>
			</div>
		</div>
	</div>
	<div class="col s12 m12 l6">
		<div id="" class="row">
			<div class="card hoverable"><!-- Customer's Details -->
				<div class="card-content">
					<span class="card-title">Customer's Details</span>
					<p></p>
					<div class="client-details">
						<div class="input-field">
							<input type="text" name="name" value="John Doe" />
							<label>Name</label>
						</div>

						<div class="input-field">
							<input type="email" name="email" class="validate" value="johndoe@example.com">
							<label>Email</label>
						</div>

					</div>
				</div>
				<div class="card-action row">
					<div class="col">
						<button class="btn waves-effect waves-light green" title="Generate Password">
							<i class="fa fa-random"></i> Generate Password
						</button>
					</div>
				</div>
			</div><!-- end Customer's Details -->

			<div class="card hoverable"><!-- Shop -->
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

			<div class="card hoverable"><!-- Send Invitation -->
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
		</div>
	</div>
	<div class="col s12 m12 l3">
		<div class="row">
			@include('shop_owner.partials._shopinfo')
		</div>
	</div>

@endcomponent
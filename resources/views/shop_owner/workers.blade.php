@component('shop_owner.layouts.app')
	<div class="col s12 m12 l3">
		<div class="card hoverable" id="dashleft-sidebar">
			<h5><i class="fa fa-caret-down" aria-hidden="true"></i> List of Clients</h5>
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
				<button class="btn waves-effect waves-light green">
					<i class="fa fa-plus"></i>
					Add Shop Worker
				</button>
			</div>
		</div>
	</div>
	<div class="col s12 m12 l6">
		<div id="" class="row">
			<div class="card hoverable"><!-- Client's Details -->
				<div class="card-content">
					<span class="card-title">Shop Worker's Details</span>
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
					<div class="col s12 m6 l6">
						<button class="btn waves-effect waves-light orange darken-3" title="Generate Password">
							<i class="fa fa-random"></i>
							<span class="hide-on-small-only"> Generate Password</span>
						</button>
					</div>
				</div>
			</div><!-- end Client's Details -->

			<div class="card hoverable"><!-- Shop -->
				<div class="card-content">
					<div class="card-title">Shop Name</div>
					<div class="row">
						<div class="col">
							<p>1. Rebuy Shop</p>
						</div>
						<div class="col">
							<p>
								<input type="checkbox" id="status" name="status" value="true" />
								<label for="status">Enable</label>
							</p>
						</div>
					</div>
				</div>
			</div><!-- End Shop -->

			<div class="card hoverable">
				<div class="card-content">
					<div class="card-title">Invite</div>
					<div class="input-field">
						<input type="text" name="name" />
						<label for="name">Name of Shop Worker</label>
					</div>
					<div class="input-field">
						<input type="email" name="email" />
						<label>Email Address</label>
					</div>
				</div>
				<div class="card-action">
					<button class="btn waves-effect waves-light green">
						<i class="fa fa-send"></i>
						Send invitation link/Password
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
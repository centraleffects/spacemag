@component('shop_owner.layouts.app')


	<div class="col s3">
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
		</div>
	</div>
	<div class="col s6">
		<div id="" class="row">
			<div class="card hoverable"><!-- Client's Details -->
				<div class="card-content">
					<span class="card-title">Client's Details</span>
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
					<div class="col s12 m4 l4">
						<button class="btn waves-effect waves-light orange darken-3" title="Generate Password">
							<i class="fa fa-random"></i>
							<span class="hide-on-small-only"> Generate Password</span>
						</button>
					</div>
					<div class="col s12 m12 l4">
						<button class="btn waves-effect waves-light green" title="Login Client Account">
							<i class="fa fa-sign-in"></i>
							<span class="hide-on-small-only"> Login Client A/c</span>
						</button>
					</div>
					<div class="col s12 m4 l4">
						<button class="btn waves-effect waves-light blue" title="Booking">
							<i class="fa fa-calendar"></i>
							<span class="hide-on-small-only"> Booking</span>
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
								<input type="checkbox" id="newsletter_subscription" name="newsletter_subscription" value="true" />
								<label for="newsletter_subscription">Enable Newsletter</label>
							</p>
						</div>
						<div class="col">
							<p>
								Salespots:
								<div class="chips chips-salesspots"></div>
							</p>
						</div>
					</div>
				</div>
				<div class="card-action">
					<a href="/shop/clients/articles" class="btn waves-effect waves-light btn waves-effect waves-light-small green"> Go to Articles</a>
				</div>
			</div><!-- End Shop -->
		</div>
	</div>
	<div class="col s3">
		<div class="row">
			@include('shop_owner.partials._shopinfo')
		</div>
	</div>

@endcomponent
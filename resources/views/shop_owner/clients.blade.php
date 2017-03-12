@component('shop_owner.layouts.app')


	<div class="col s3">
		<div class="card" id="dashleft-sidebar">
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
			<div class="card"><!-- Client's Details -->
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
				<div class="card-action">
					<button class="btn waves-effect waves-light orange darken-3">Generate Password</button>
					<button class="btn waves-effect waves-light green">Login Client A/c</button>
					<button class="btn waves-effect waves-light blue">Booking</button>
				</div>
			</div><!-- end Client's Details -->

			<div class="card"><!-- Shop -->
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
					<a href="#articles" class="btn waves-effect waves-light btn waves-effect waves-light-small green"> Go to Articles</a>
				</div>
			</div><!-- End Shop -->
		</div>
	</div>
	<div class="col s3">
		<div class="row">
			<div class="card"><!-- Shop Information -->
				<div class="card-content">
					<div class="card-title">Shop Information</div>
					<div class="input-field">
						<input type="text" name="name" value="Rebuy Shop" />
						<label>Name</label>
					</div>
					<div class="input-field">
						<input type="text" name="url" value="rebuy.com" />
						<label>Home page</label>
					</div>
					<div class="input-field">
						<input type="text" name="postel">
						<label>Postel</label>
					</div>
					<div class="input-field">
						<select class="icons" multiple>
							<option value="all">Select all</option>
							<option value="1">January</option>
							<option value="2" selected>February</option>
							<option value="3">March</option>
							<option value="4" selected>April</option>
							<option value="5" selected>May</option>
							<option value="6">June</option>
							<option value="7" selected>July</option>
							<option value="8">August</option>
							<option value="9">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
					    </select>
						<label>Shop Owner</label>
					</div>
					<div class="input-field">
						<input type="number" name="article_commission" class="validate" />
						<label>Commission on Article Sale (Kr)</label>
					</div>
					<div class="input-field">
						<input type="number" name="salesspot_commission" class="validate">
						<label>Sales spot Rebuy Commission (Kr)</label>
					</div>
					<div class="input-field">
						Spots:
						<ul class="collapsible" data-collapsible="accordion">
							<li>
								<div class="collapsible-header">
									<span>A1 (Feb 15th - Mar 15th)</span>
								</div>
								<div class="collapsible-body">
									<button class="btn green waves-effect waves-light">End booking</button>
								</div>
							</li>
							<li>
								<div class="collapsible-header">
									<span>C4 (Jan 20th - Mar 10th)</span>
								</div>
								<div class="collapsible-body">
									<button class="btn green waves-effect waves-light">End booking</button>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="card-action">
					
				</div>
			</div><!-- End Shop Information -->
		</div>
	</div>

@endcomponent
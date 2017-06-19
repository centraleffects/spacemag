<?php
	$is_readonly = "readonly";
	if( action('ShopOwnerController@index') == Request::url() ) $is_readonly = "";
?>

<div class="card hoverable"><!-- Shop Information -->
	<div class="card-content">
		<div class="card-title">Shop Information</div>
		<div class="input-field">
			<input {{ $is_readonly }} type="text" name="name" value="@{{selectedShop.name}}" />
			<label>Name</label>
		</div>
		<div class="input-field">
			<input {{ $is_readonly }} type="text" name="url" value="@{{selectedShop.url}}" />
			<label>Home page</label>
		</div>
		<div class="input-field">
			<input {{ $is_readonly }} type="text" name="@{{selectedShop.postel}}" />
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
			<input {{ $is_readonly }} type="number" name="article_commission" class="validate" />
			<label>Commission on Article Sale (Kr)</label>
		</div>
		<div class="input-field">
			<input {{ $is_readonly }} type="number" name="salesspot_commission" class="validate">
			<label>Sales spot Rebuy Commission (Kr)</label>
		</div>
		<div class="input-field">
			Spots:
			<ul class="collapsible" data-collapsible="accordion">
				<li>
					<div class="collapsible-header">
						<span><i class="fa fa-caret-down"></i> A1 (Feb 15th - Mar 15th)</span>
					</div>
					<div class="collapsible-body">
						<button class="btn green waves-effect waves-light">End booking</button>
					</div>
				</li>
				<li>
					<div class="collapsible-header">
						<span><i class="fa fa-caret-down"></i> C4 (Jan 20th - Mar 10th)</span>
					</div>
					<div class="collapsible-body">
						<button class="btn green waves-effect waves-light">End booking</button>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div><!-- End Shop Information -->
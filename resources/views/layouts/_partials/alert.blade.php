<div class="alert {{ $alert_type or 'alert-info' }} alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	{{ $slot }}
 </div>
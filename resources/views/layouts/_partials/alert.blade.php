<div class="alert alert-{{ $alert_type or 'info' }} alert-dismissible {{ $is_important or '' }}" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	{{ $slot }}
 </div>
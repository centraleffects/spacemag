<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script> -->
<script src="{{ mix('js/app.js') }}"></script>
@if( auth()->check() && auth()->user()->isAdmin() )
<script src="{{ mix('js/admin_shop_controller.js') }}"></script>
@elseif( auth()->check() && !auth()->user()->isAdmin() )
	<script src="{{ mix('js/main.js') }}"></script>
@endif
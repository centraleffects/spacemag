<script src="{{ mix('js/app.js') }}"></script>
@if( auth()->check() && !auth()->user()->isAdmin() )
<script src="{{ mix('js/main.js') }}"></script>
@endif
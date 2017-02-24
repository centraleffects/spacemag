@include('layouts._partials.header')
    <div class="center bg-clouds">
        <div class="row">   
            <div class="{{ $width ?? 'col-md-6 col-md-offset-3' }}">
                @include('layouts._partials.logo')
                {{ $slot }}
            </div>
        </div>
    </div>
@include('layouts._partials.footer')

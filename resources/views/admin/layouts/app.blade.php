@include('layouts._partials.header')

<div class="row">

    @includeWhen(auth()->check(), 'layouts._partials.sidebar')

    <section class="maincontent col s12">

      @include('layouts._partials.topnav')
        
        <div class="inner-content">
            <div class="main-content">
                @if(session()->has('alert'))
                    @component('layouts._partials.alert')
                        @slot('alert_type') 
                            alert-danger
                        @endslot
                        {{ session()->get('alert') }}
                    @endcomponent
                @endif
                {{ $slot }}
            </div>
        </div>

    </section>

</div>

@include('layouts._partials.footer')
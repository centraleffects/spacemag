@include('layouts._partials.header')

<article class="row">

    @includeWhen(auth()->check(), 'layouts._partials.sidebar')

    <section class="maincontent col s12">

        @includeWhen(auth()->check(), 'layouts._partials.topnav')
        
        <div class="inner-content">
            <div class="main-content">
                @if(session()->has('flash_message'))
                    @component('layouts._partials.alert')
                        @slot('alert_type') 
                            {{ session()->get('flash_message')['type'] }}
                        @endslot
                        {{ session()->get('flash_message')['msg'] }}
                    @endcomponent
                @endif

                {{ $slot }}
            </div>
        </div>

    </section>


    @if(Session::has("flash_message"))
        <script type="text/javascript">
            $("div.alert").not(".alert-important").delay(5000).slideUp(function(){
                $(this).remove();
            });
        </script>
    @endif
</article>
<div class="clearfix"></div>
@include('layouts._partials.footer')
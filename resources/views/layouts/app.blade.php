@include('layouts._partials.header')
    <main>
        @includeWhen(auth()->check(), 'layouts._partials.sidebar')
        <div class="main-container">

            @include('layouts._partials.topnav')
            <div class="main-content" autoscroll="true">
                @if(session()->has('flash_message'))
                    @component('layouts._partials.alert')
                        @slot('alert_type') 
                            {{ session()->get('flash_message')['type'] }}
                        @endslot

                        @if( is_array(session()->get('flash_message')) && (session()->get('flash_message')['is_important']) )
                            @slot('is_important') alert-important @endslot
                        @endif

                        @if( is_array(session()->get('flash_message')) && (session()->get('flash_message')['custom_class']) )
                            @slot('custom_class') session->get('flash_message')['custom_class'] @endslot
                        @endif
                        
                        {{ session()->get('flash_message')['msg'] }}
                    @endcomponent
                @endif
                <div class="progress">
                  <div class="indeterminate"></div>
               </div>
                {{ $slot }}
            </div>
        </div>
    </main>

  <div class="alert-container-top-right"></div>
 
@include('layouts._partials.footer')
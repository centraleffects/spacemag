@include('layouts._partials.header')
    <main>
        @includeWhen(auth()->check(), 'layouts._partials.sidebar')
        <div class="main-container">

            @include('layouts._partials.topnav')
            <div class="main-content" autoscroll="true">
                <div class="progress">
                  <div class="indeterminate"></div>
               </div>
                {{ $slot }}
            </div>
        </div>
    </main>

  <div class="alert-container-top-right"></div>
 
@include('layouts._partials.footer')
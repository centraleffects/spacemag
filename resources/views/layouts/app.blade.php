@include('layouts._partials.header')
    <main>
        @include('layouts._partials.sidebar')
        <div class="main-container">
            @include('layouts._partials.topnav')
            <div class="main-content" autoscroll="true" ng-cloak ng-view bs-affix-target init-ripples>
                {{ $slot }}
            </div>
        </div>
    </main>

  <div class="alert-container-top-right"></div>
 
@include('layouts._partials.footer')
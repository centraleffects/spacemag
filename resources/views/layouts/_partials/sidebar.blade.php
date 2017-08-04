<section class="nav-sidebar side-nav" id="slide-out">
    <div class="row brand blue lighten-2">
        <img src="/images/rebuy_logo.png" class="img-responsive logo">
    </div>
    <div class="row">
        <ul ng-cloak>
            <li>
                <div class="userView">
                    <div class="background">
                        <img src="{{ url('images/office.jpg') }}">
                    </div>
                    <a href="{{url('account')}}">
                        <img class="circle" src="{{ isset(auth()->user()->avatar) ? \App\Helpers\Helper::imageAsset(auth()->user()->avatar) : asset('images/default.svg')}}">
                    </a>
                    <a href="#!name">
                        <span class="white-text name">
                            {{ auth()->user()->first_name.' '.auth()->user()->last_name }}
                        </span>
                    </a>
                    <a href="#!email">
                        <span class="white-text email">
                            {{ auth()->user()->email }}
                        </span>
                    </a>
                </div>
            </li>

            @include('layouts._partials.navs')
            <li>
                <a href="#!" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul> 
    </div>
</section>
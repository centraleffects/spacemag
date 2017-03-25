<section class="nav-sidebar side-nav" id="slide-out">
    <div class="row brand blue lighten-3">
        <img src="/images/rebuy_logo.png" class="img-responsive logo">
    </div>
    <div class="row">
        <ul ng-cloak>
            <li>
                <div class="userView">
                    <div class="background">
                        <img src="{{ url('images/office.jpg') }}">
                    </div>
                    <a href="#!user">
                        <img class="circle" src="{{ auth()->user()->avatar ? auth()->user()->avatar : '' }}">
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

            @if( auth()->user()->isAdmin() )
                <li>
                    <a menu-link href="#/dashboard" icon="md md-blur-on">Dashboard</a>
                    <ul>
                        <li menu-toggle path="/categories" name="Categories" icon="fa fa-cubes">
                            <a menu-link href="#/categories/all">All Categories</a>
                            <a menu-link href="#/categories/new">New</a>
                        </li>
                    </ul>
                </li>
                <a menu-link href="#/shop" icon="fa fa-building">Shop</a>
            @elseif( auth()->user()->isOwner() )
                @include('shop_owner.partials._nav')
            @elseif( auth()->user()->isClient() )

            @else
                <a menu-link href="#/dashboard" icon="md md-blur-on">Dashboard</a>
            @endif
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
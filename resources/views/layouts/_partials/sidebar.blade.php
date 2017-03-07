<aside class="sidebar fixed">
  
  @include('layouts._partials.logo')
  
  <div class="user-logged-in">
    <div class="content">
      <div class="user-name">{{ auth()->user()->first_name.' '.auth()->user()->last_name }}<span class="text-muted f9">admin</span></div>
      <div class="user-email">{{ auth()->user()->email }}</div>
      <div class="user-actions">
        <a class="m-r-5" href="/">settings</a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
  <ul class="menu-links" ng-cloak>
    @if( auth()->user()->isAdmin() )
        <a menu-link href="#/dashboard" icon="md md-blur-on">Dashboard</a>
            <li menu-toggle path="/Categories" name="Categories" icon="fa fa-cubes">
                <a menu-link href="#/categories/all-categories">All Categories</a>
                <a menu-link href="#/categories/New">New</a>
            </li>
        <a menu-link href="#/shop" icon="fa fa-building">Shop</a>
    @elseif( auth()->user()->isOwner() ): ?>

    @elseif( auth()->user()->isClient() )

    @else
      <a menu-link href="#/dashboard" icon="md md-blur-on">Dashboard</a>
    @endif
  </ul>
</aside>

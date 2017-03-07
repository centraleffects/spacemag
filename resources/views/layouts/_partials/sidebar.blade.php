<aside class="sidebar fixed">
  
  @include('layouts._partials.logo')
  
<!--   <div class="user-logged-in">
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
  </ul> -->

  <ul id="slide-out" class="side-nav">
    <li><div class="userView">
      <div class="background">
        <img src="images/office.jpg">
      </div>
      <a href="#!user"><img class="circle" src="/images/avatar/280.jpg"></a>
      <a href="#!name"><span class="white-text name">John Doe</span></a>
      <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
    </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
  </ul>
  <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
</aside>

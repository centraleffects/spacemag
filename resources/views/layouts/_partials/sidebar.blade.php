<aside class="sidebar fixed">
  <div class="brand-logo">
    <div id="logo">
      <div class="foot1"></div>
      <div class="foot2"></div>
      <div class="foot3"></div>
      <div class="foot4"></div>
    </div>
    Materialism
  </div>
  <div class="user-logged-in">
    <div class="content">
      <div class="user-name">Katsumoto <span class="text-muted f9">admin</span></div>
      <div class="user-email">last@samurai.jp</div>
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
    <a menu-link href="#/dashboard" icon="md md-blur-on">Dashboard</a>
    <li menu-toggle path="/apps" name="APPS" icon="md md-camera">
      <a menu-link href="#/apps/todo" name="Todo">
        <span id="todosCount" class="pull-right badge z-depth-0" ng-bind="todosCount"></span>
        Todo
      </a>
      <a menu-link href="#/apps/crud" name="Crud">
        <span class="pull-right badge theme-primary-bg z-depth-0">9</span>
        Crud
      </a>
    </li>
    <li menu-toggle path="/ui-elements" name="UI elements" icon="md md-photo">
      <a menu-link href="#/ui-elements/cards">Cards</a>
      <a menu-link href="#/ui-elements/colors">Color</a>
      <a menu-link href="#/ui-elements/grid">Grid</a>
      <a menu-link href="#/ui-elements/icons">Icons material design</a>
      <a menu-link href="#/ui-elements/weather-icons">Icons weather</a>
      <a menu-link href="#/ui-elements/lists">Lists</a>
      <a menu-link href="#/ui-elements/typography">Typography</a>
      <a menu-link href="#/ui-elements/messages">Messages &amp; Notifications</a>
      <a menu-link href="#/ui-elements/buttons">Buttons</a>
    </li>
    <li menu-toggle path="/forms" name="Forms" icon="md md-input">
      <a menu-link href="#/forms/basic">Basic forms</a>
      <a menu-link href="#/forms/advanced">Advanced elements</a>
      <a menu-link href="#/forms/validation">Validation</a>
    </li>
    <li menu-toggle path="/tables" name="Tables" icon="md md-list">
      <a menu-link href="#/tables/basic">Basic tables</a>
      <a menu-link href="#/tables/data">Data tables</a>
    </li>
    <li menu-toggle path="/maps" name="Maps" icon="md md-place">
      <a menu-link href="#/maps/full-map">Full map</a>
      <a menu-link href="#/maps/map-widgets">Map widgets</a>
      <a menu-link href="#/maps/vector-map">Vector map</a>
    </li>
    <a menu-link href="#/charts" icon="md md-insert-chart">Charts</a>
    <li menu-toggle path="/pages" name="Extra pages" icon="md md-favorite-outline">
      <a target="_blank" href="pages/login.html">Login</a>
      <a target="_blank" href="pages/404.html">404</a>
      <a target="_blank" href="pages/500.html">500</a>
      <a target="_blank" href="pages/material-bird.html">Easter Egg</a>
    </li>
  </ul>
</aside>
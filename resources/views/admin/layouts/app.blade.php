<header>
    @include('layouts._partials.header')
</header>
<main class="col s12">

    @include('layouts._partials.sidebar')

    <section class="col s12">

        @include( 'layouts._partials.topnav')
        
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
                <div class="toolbar row">
                    <div class="col s12">
                            <nav>
                                <div class="nav-wrapper">
                                  <ul id="nav-mobile" class="right hide-on-med-and-down">
                                     <li>
                                        <a href="#/dashboard" class="btn btn-flat waves-effect green  waves-light">
                                            Dashboard
                                        </a>
                                    </li>
                                     <li>
                                        <a href="#/users" class="btn btn-flat waves-effect  green waves-light">
                                            Users
                                        </a>
                                     </li>
                                     <li>
                                        <a href="#/shops" class="btn btn-flat waves-effect  green waves-light">
                                            Shops
                                        </a>
                                     </li>
                                     <li>
                                        <a href="#/categories" class="btn btn-flat waves-effect  green waves-light">
                                            Categories
                                        </a>
                                    </li>
                                     <li>
                                        <a href="#/transactions" class="btn btn-flat waves-effect  green waves-light">
                                            Transactions
                                        </a>
                                    </li>
                                  </ul>
                                </div>  
                            </nav>
                    </div>
                </div>
                <div class="row content-wrap">
                    {{ $slot }}
                </div>
            </div>
        </div>

    </section>

    @include( 'admin.partials._fixedbuttons')

    @if(Session::has("flash_message"))
        <script type="text/javascript">
            $("div.alert").not(".alert-important").delay(5000).slideUp(function(){
                $(this).remove();
            });
        </script>
    @endif
</main>

@include('admin.partials._footer')
<header>
@include('layouts._partials.header')
</header>
@if(session()->get('alert'))
    <script type="text/javascript">
        setTimeout(function(){ 
             window.reBuy.toast("{{session()->get('alert')}}");
        },2000);
    </script>
    {{session()->put('alert','')}}
@endif
<main class="col s12" {{ $controller or '' }}>

    @include('layouts._partials.sidebar')

    <section class="maincontent col s12">

        @include( 'layouts._partials.topnav')
        
        <div class="inner-content">
            <div class="main-content">
                @include('layouts._partials.flash_message')
                
                @if( session()->has('loggedin_as_someone') )
                <div class="alert alert-success alert-important alert-imphasis" role="alert">

                    {!! __("messages.loggedin_as_someone", ['role' => auth()->user()->role]) !!} {{ Helper::getUserFullName(auth()->user()) }} ({{ auth()->user()->email }}).
                    <a class="btn orange btn-small" href="{{ url('shop/login-back') }}">End</a>    
                </div>
                @endif
                <div class="toolbar row">
                    <div class="col s12">
                        <nav>
                            <div class="nav-wrapper nav-content">
                                <ul id="nav-mobile tabs tabs-transparent" class="right">

                                    @if( auth()->user()->isOwner() || auth()->user()->isWorker() )
                                        <?php 
                                            $nav_menus = [
                                                'shop' => __("Shop Info"),
                                                'shop/customers' => __("Customers"),
                                                'shop/clients' => __("Clients"),
                                                'shop/spots' => __("Salespot"),
                                                'shop/articles' => __("Articles"),
                                                'shop/todo' => __("Todo List"),
                                                'shop/workers/todo' => __("My Todo"),
                                                'shop/coupons' => __("Coupons")

                                            ];

                                            if( auth()->user()->isOwner() ){
                                                $nav_menus['shop/workers'] = __("Shop Workers");
                                                $nav_menus['shop/workers/todo'] = __("Workers Todo");
                                            }

                                        ?>
                                    @elseif( auth()->user()->isCustomer() or auth()->user()->isClient() )
                                        <?php 
                                            $nav_menus = ['overview' => __("Overview"),
                                                'my-shops' => __("My Shops"),
                                                'bookings' => __("My Bookings"),
                                                'shop/articles' => __("Articles"),
                                                'shop/coupons' => __("Coupons")
                                            ];
                                        ?>
                                    @else
                                        <?php $nav_menus = ['shop' => __("Shops")]; ?>                                  
                                    @endif

                                    @foreach($nav_menus as $key => $value)
                                    <li class="tab {!! \Request::path() == $key ? 'active' : '' !!}">
                                        <a href="{{ url($key) }}">
                                            {{ $value }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row content-wrap">
                    @if (session('success'))
                        <div class="alert alert-success" style="margin:10px;">
                            {{ session('success') }}
                        </div>
                    @endif
                    {{ $slot }}
                    <div class="col s12 m12 l3">
                        {{ $left or '' }}
                    </div>
                    <div class="col s12 m12 l6">
                        {{ $center or '' }}
                    </div>
                    <div class="col s12 m12 l3">
                        {{ $right or '' }}
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>

@include('layouts._partials.footer')
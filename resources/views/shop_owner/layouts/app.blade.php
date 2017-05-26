<header>
@include('layouts._partials.header')
</header>
<main class="col s12" {{ $controller or '' }}>

    @include('layouts._partials.sidebar')

    <section class="maincontent col s12">

        @include( 'layouts._partials.topnav')
        
        <div class="inner-content">
            <div class="main-content">
                @if(session()->has('flash_message'))
                    @component('layouts._partials.alert')
                        @slot('alert_type') 
                            {{ session()->get('flash_message')['type'] }}
                        @endslot

                        @if( isset(session()->get('flash_message')['is_important']) )
                            @slot('is_important') alert-important @endslot
                        @endif

                        @if( isset(session()->get('flash_message')['custom_class']) )
                            @slot('custom_class') session->get('flash_message')['custom_class'] @endslot
                        @endif
                        
                        {{ session()->get('flash_message')['msg'] }}
                    @endcomponent
                @endif
                
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


                                    @if( auth()->user()->isOwner() )
                                        <?php 
                                            $nav_menus = [
                                                'shop' => __("Shops Status"),
                                                'shop/customers' => __("Customers"),
                                                'shop/clients' => __("Clients"),
                                                'shop/spots' => __("Salespot"),
                                                'shop/articles' => __("Articles"),
                                                'shop/workers' => __("Shop Workers"),
                                                'shop/todo' => __("Todo List"),
                                                'shop/workers/todo' => __("Workers Todo"),
                                                'shop' => __("Shops"),
                                                'shop' => __("Shops"),

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
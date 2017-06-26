<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>ReBuy - Coming Soon</title>
        <!-- CSS  -->
        @include('layouts._partials._styles')
    </head>
    <body>
        <header>
                <nav class="light-blue" role="navigation">
                    <div class="nav-wrapper container">
                        <!-- <a id="logo-container" href="#" class="brand-logo">Logo</a> -->
                        <ul class="right hide-on-med-and-down">
                            @if (Auth::check())
                                <li><a href="{{ url('/home') }}">Home</a></li>
                                @if( Auth::user()->isAdmin() )
                                <li>
                                    <a href="{{ url('admin/dashboard') }}">{{__('Dashboard')}}</a>
                                </li>
                                @elseif( auth()->user()->isOwner() or auth()->user()->isWorker() )
                                <li>
                                    <a href="{{ url('shop') }}">{{__('Shop')}}</a>
                                </li>
                                @elseif( auth()->user()->isCustomer() or auth()->user()->isClient() )
                                <li>
                                    <a href="{{ url('my-shops') }}">{{__('My Shops')}}</a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                            @else
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('/register') }}">Register</a></li>
                            @endif
                        </ul>
                        <ul id="nav-mobile" class="side-nav">
                            @if (Auth::check())
                                <li>
                                    <a href="{{ url('/home') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @else
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('/register') }}">Register</a></li>
                            @endif
                        </ul>
                        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
                    </div>
                </nav>
        </header>
        <main>
            <div id="index-banner" class="parallax-container">
                <div class="section no-pad-bot">
                    <div class="container">
                        <br><br>
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
                    </div>
                     <div class="row center"><br><br><img src="images/rebuy_logo.png" alt="Coming Soon"><br><H5>COMMING SOON.</H5></div>
                </div>

               <!--  <div class="parallax"><img src="images/background1.jpg" alt="Unsplashed background img 1"></div> -->
            </div>
            <div class="container">
                <div class="section">
                </div>
            </div>
            <div class="container">
            </div>
        </main>
        <footer class="page-footer blue lighten-2">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Handla på Rebuy</h5>
                        <p class="grey-text text-lighten-4">With us you can find bargains among hundreds of vendors selling seats on 1000m² of retail space. We have an organic cafe and outlet department - to pay all the same fund. Many sellers under one roof provides many findings chances!.</p>
                    </div>
                    <div class="col l3 s12">
                    </div>
                    <div class="col l3 s12">
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    Made by <a class="green-text text-lighten-3" href="http://rebuy.se">Rebuy.se</a>
                </div>
            </div>
        </footer>
        <!--  Scripts-->
        @include('layouts._partials._scripts')
    </body>
</html>
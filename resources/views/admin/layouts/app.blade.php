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
                        {{ session()->get('flash_message')['msg'] }}spots
                    @endcomponent
                @endif
                <div class="toolbar row">
                    <div class="col s12">
                            <!-- <nav>
                                <div class="nav-wrapper">
                                  <ul id="nav-mobile" class="right hide-on-med-and-down">
                                     <li><a href="{{ url('admin/dashboard') }}" class="btn btn-flat waves-effect green  waves-light">Dashboard</a></li>
                                     <li><a href="{{ url('admin/users') }}" class="btn btn-flat waves-effect  green waves-light">Users</a></li>
                                     <li><a href="{{url('admin/categories')}}" class="btn btn-flat waves-effect  green waves-light">Categories</a></li>
                                     <li><a href="{{ url('admin/shops') }}" class="btn btn-flat waves-effect  green waves-light">Shops</a></li>
                                     <li><a href="{{ url('admin/transactions') }}" class="btn btn-flat waves-effect  green waves-light">Transactions</a></li>
                                  </ul>
                                </div>
                            </nav> -->
                             <nav>
                                <div class="nav-wrapper nav-content">
                                    <ul id="nav-mobile tabs tabs-transparent" class="right">
                                        <?php 
                                            $nav_menus = [
                                                'admin/dashboard' => __("Dashboard"),
                                                'admin/users' => __("List of All Users"),
                                                'admin/categories' => __("List of Categories"),
                                                'admin/shops' => __("List of Shops"),
                                                'admin/transactions' => __("List of Transactions")
        

                                            ];
                                        ?>

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
                </div>
            </div>
        </div>

    </section>
</main>

@include('admin.partials._footer')
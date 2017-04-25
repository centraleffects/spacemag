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

                        @if( isset( session()->get('flash_message')['is_important'] ) )
                            @slot('is_important') alert-important @endslot
                        @endif

                        @if( isset( session()->get('flash_message')['custom_class'] ) )
                            @slot('custom_class') session->get('flash_message')['custom_class'] @endslot
                        @endif
                        
                        {{ session()->get('flash_message')['msg'] }}
                    @endcomponent
                @endif

                @if( session()->has('loggedin_as_someone') )
                <div class="alert alert-success alert-important alert-imphasis" role="alert">
                    You are loggedin as customer: {{ auth()->user()->first_name.' '.auth()->user()->last_name }} ({{ auth()->user()->email }}).
                    <a class="btn orange btn-small" href="{{ url('shop/login-back') }}">End</a>    
                </div>
                @endif
                <div class="toolbar row">
                    <div class="col s12">
                        <nav>
                            <div class="nav-wrapper">
                                <ul id="nav-mobile" class="right hide-on-med-and-down">

                                    @if( auth()->user()->isOwner() )
                                        <li>
                                            <a href="{{ url('shop') }}" class="btn green waves-effect  waves-light">
                                                Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('shop/customers') }}" class="btn green waves-effect  waves-light">
                                                Customers
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('shop/clients') }}" class="btn green waves-effect  waves-light">
                                                Clients
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="btn green waves-effect  waves-light">
                                                Shop Status
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('shop/workers') }}" class="btn green waves-effect waves-light">
                                                Add Shop Workers
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('shop/todo') }}" class="btn green waves-effect waves-light">
                                                Todo List
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('shop/workers/todo') }}" class="btn green waves-effect waves-light">
                                                Todo for workers
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ url('shop') }}" class="btn green waves-effect waves-light">
                                                Shops
                                            </a>
                                        </li>                                        
                                    @endif
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
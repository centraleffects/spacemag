@include('layouts._partials.header')

<div class="row">

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
                        {{ session()->get('flash_message')['msg'] }}
                    @endcomponent
                @endif
                <div class="toolbar row">
                    <div class="col s12">
                        <nav>
                            <div class="nav-wrapper">
                                <ul id="nav-mobile" class="right hide-on-med-and-down">
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


    @if(Session::has("flash_message"))
        <script type="text/javascript">
            $("div.alert").not(".alert-important").delay(5000).slideUp(function(){
                $(this).remove();
            });
        </script>
    @endif
</div>

@include('layouts._partials.footer')
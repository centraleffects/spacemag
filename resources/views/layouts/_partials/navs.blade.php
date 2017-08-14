 @if( auth()->user()->isAdmin() )
     <?php 
        $nav_menus = [
            'admin/dashboard' => __("Dashboard"),
            'admin/users' => __("List of All Users"),
            'admin/categories' => __("List of Categories"),
            'admin/shops' => __("List of Shops"),
            'admin/transactions' => __("List of Transactions")
        ];
    ?>

@elseif( auth()->user()->isOwner() || auth()->user()->isWorker() )
    <?php 
        $nav_menus = [
            'shop' => __("Shop Info"),
            'shop/customers' => __("Customers"),
            'shop/clients' => __("Clients"),
            'shop/spots' => __("Salespot"),
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
        $nav_menus = [
            'overview' => __("Overview"),
            'my-shops' => __("My Shops"),
            'articles' => __("My Articles"),
            'bookings' => __("My Bookings"),
            'shop/coupons' => __("Coupons")
        ];

        if( auth()->user()->isClient() ){
            $nav_menus['shop/articles'] = __("Articles");
        }
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
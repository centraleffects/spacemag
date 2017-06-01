<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopCouponUser extends Model
{
    protected $guarded = [ "id" ];

    protected $dates = [ 'created_at', 'updated_at' ];
    protected $table = "shop_coupon_users";


}

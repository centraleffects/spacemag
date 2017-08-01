<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Shop;
use App\Helpers\Helper;

class ShopController extends Controller {

	public function workers(Shop $shop){
        return Helper::getShopWorkers($shop);
    }
}
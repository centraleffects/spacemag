<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopOwnerController extends Controller
{
    public function index(){
    	return view('shop_owner.dashboard');
    }
}

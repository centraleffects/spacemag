<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopOwnerController extends Controller
{
    public function index(){
    	return view('shop_owner.dashboard');
    }

    public function clients(){
    	return view('shop_owner.clients');
    }

    public function articles(){
    	return view('shop_owner.articles');
    }
}

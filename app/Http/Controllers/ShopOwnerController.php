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

    public function customers(){
    	return view('shop_owner.customers');
    }

    public function todo(){
        return view('shop_owner.todo');
    }

    public function workers(){
        return view('shop_owner.workers');
    }

    public function workersTodo(){
        return view('shop_owner.workers_todo');
    }
}

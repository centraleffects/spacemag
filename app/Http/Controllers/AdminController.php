<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Form;
use App\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       return view('admin.dashboard');
    }


    public function users(){
        return view('admin.users');
    }

     public function loggedProfile(){
        return \Auth::user();
    }

    public function shops(Request $request){
        return view('admin.shops');
    }

    public function spots(Request $request){
        return view('admin.spots');
    }

    public function categories(Request $request){
        return view('admin.categories');
    }

    public function transactions(Request $request){
        return view('admin.transactions');
    }

}

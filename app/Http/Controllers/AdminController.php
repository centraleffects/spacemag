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


    public function users($id){
       
        $users = User::limit(30)->offset(0)->get();
        $user_details_default = (object)[
                    'id'         => 0,
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                    'gender' => '',
                    'role' => 'customer',
                    'address_1' => '',
                    'address_2' => '',
                    'city' => '',
                    'zip_code' => '',
                    'country' => 'swe',
                    'telephone' => '',
                    'mobile' => '',
                    'lang' => 'en'
                ];
        if($id){
            $user_details  = User::findOrFail($id);
        }
        $user_details =  !empty($user_details) ? $user_details : $user_details_default;

        return view('admin.users', ['users' => $users, 'user_details' => $user_details ]);
    }

    public function shops(Request $request){
        return view('admin.shops');
    }

    public function categories(Request $request){
        return view('admin.categories');
    }

    public function transactions(Request $request){
        return view('admin.transactions');
    }

}

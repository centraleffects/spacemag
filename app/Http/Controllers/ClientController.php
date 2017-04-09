<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Http\Mail\ResetsPassword;


use Mail;

class ClientController extends Controller
{
    public function generatePassword(User $user){
    	Mail::to($user->email)->send(new ResetsPassword);
    }

}

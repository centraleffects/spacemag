<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    function __construct($foo = null)
    {
        $this->foo = $foo;
    }

    public function all(){
    	return User::all();
    }

    public function show(User $user){
        return $user;
    }
}

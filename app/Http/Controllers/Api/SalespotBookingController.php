<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\SalespotBooking;
use Illuminate\Http\Request;

class SalespotBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getActiveBookings(){
        $user = auth()->guard("api")->user();

        return $user->salespotBookings()->get();
    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Shop;

class UserController extends Controller
{
    function __construct($foo = null)
    {
        $this->foo = $foo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


    public function test(){
        $user = User::find(1);
        $shop = new Shop([
            'id' => 2,
            'user_id' => $user->id,
            'name' => 'PureFoods Hotdog2',
            'description' => 'Something that describes this shop',
            'url' => null,
            'currency' => 'USD'
        ]);
        $user->shops()->save($shop);

        $shop = new Shop([
            'id' => 2,
            'user_id' => $user->id,
            'name' => 'PureFoods Hotdog',
            'description' => 'Something that describes this shop',
            'url' => null,
            'currency' => 'USD'
        ]);
        $user->shops()->save($shop);


        return $user->shops()->get();
    }
    

}

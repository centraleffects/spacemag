<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;

use App\TodoTask;
use App\Shop;
use App\User;

class TodoTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getByShop(Shop $shop)
    {
        return $shop->todoTasks()->paginate(50);
    }

    public function getByUser(User $user){
        return $user->todoTasks()->paginate(50);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $input = Input::all();
        // dd($input);
        $task = new TodoTask;
        $task->description = $input['description'];
        $task->user_id = Auth::guard('api')->user()->id;

        if( isset($input['shop_id']) ){
            $task->shop_id = $input['shop_id'];
        }

        $task->save();


        if( $task->id )
            return ['success' => 1, 'msg' => 'New task has been saved.'];

        return ['success' => 0, 'msg' => "Sorry, we can't process your request right now."];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TodoTask  $todoTask
     * @return \Illuminate\Http\Response
     */
    public function show(TodoTask $todoTask)
    {
        return $todoTask;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TodoTask  $todoTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoTask $todoTask)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TodoTask  $todoTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoTask $todoTask)
    {
        if( $todoTask->delete() )
            return ['success' => 1, 'msg' => "Successfully deleted."];

        return ['success' => 0, 'msg' => "Sorry, we can't process your request right now."];
    }
}

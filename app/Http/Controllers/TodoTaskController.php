<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Mail;

use App\TodoTask;
use App\Shop;
use App\User;
use App\Mail\TodoTaskAssignment; 

class TodoTaskController extends Controller
{
    public function getByShop(Shop $shop)
    {
        return $shop->todoTasks()->paginate(50);
    }

    public function getByUser(User $user){
        return $user->todoTasks()->paginate(50);
    }

    public function store(Request $request)
    {   
        $input = Input::all();
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

    public function assignTask(TodoTask $task, User $user){
        if( $user->todoTasks()->save($task) ){

            $username = ucfirst($user->first_name).' '.ucfirst($user->last_name);

            $mail = new TodoTaskAssignment($username, $task, Auth::guard('api')->user());
            
            try {
                Mail::to($user->email)->send($mail);

                return ['success' => 1, 'msg' => 'Task successfully assigned.'];
            } catch (\Exception $e) {
                return ['success' => 0, 'msg' => 'Something went wrong while sending a notification email.'];
            }

        }

            
        return ['success' => 0, 'msg' => 'Unable to assign a task right now. Please try again later.'];
    }

    public function show(TodoTask $task)
    {
        return $task;
    }


    public function update(TodoTask $task)
    {
        $input = Input::all();
        foreach ($input as $key => $value) {
            if( $key != "api_token" ){
                $task->{$key} = $value;
            }
        }

        if( $task->update() )
            return ['success' => 1, 'msg' => 'Your changes have been saved.'];

        return ['success' => 0, 'msg' => 'Something went wrong while trying to update this task.'];
    }

    public function toggleDone(TodoTask $task){
        if( $task->done ){
            $task->done = false;
            $msg = "Task successfully re-opened..";
            $action = 're-open';
        }else{
            $task->done = true;
            $msg = "Task successfully marked as completed.";
            $action = 'mark as completed';
        }

        if( $task->update() )
            return ['success' => 1, 'msg' => $msg];

        return ['success' => 0, 'msg' => 'Something went wrong while trying to '.$action.' this task.'];
    }


    public function destroy(TodoTask $task)
    {
        if( $task->delete() )
            return ['success' => 1, 'msg' => "Successfully deleted."];

        return ['success' => 0, 'msg' => "Sorry, we can't process your request right now."];
    }

    public function unAssign(TodoTask $task){
        $task->worker_user_id = null;
        if( $task->save() )
            return ['success' => 1];

        return ['success' => 0];
    }
}

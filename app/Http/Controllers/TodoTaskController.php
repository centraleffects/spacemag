<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Mail;

use App\TodoTask;
use App\Shop;
use App\User;
use App\Mail\TaskAssignment; 

use App\Http\Traits\GeneratesTodo;

class TodoTaskController extends Controller
{
    use GeneratesTodo;

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
            return ['success' => 1, 'msg' => __("messages.new_task_created")];

        return ['success' => 0, 'msg' =>  __("errors.error_while_processing") ];

    }

    public function assignTask(TodoTask $task, User $user){
        /*if( $user->todoTasks()->save($task) ){

            $username = ucfirst($user->first_name).' '.ucfirst($user->last_name);
            $current_user = Auth::guard('api')->user();
            $current_user_name = $current_user->first_name.' '.$current_user->last_name;

            $mail = new TaskAssignment($username, $task, $current_user_name);
            
            try {
                Mail::to($user->email)->send($mail);

                return ['success' => 1, 'msg' => __('messages.task_assigned')];
            } catch (\Exception $e) {
                dd($e);
                return ['success' => 0, 'msg' => __('errors.mail_noti_failed')];
            }

        }*/

        if( $user->todoTasks()->save($task) )
            return ['success' => 1, 'msg' => __('messages.task_assigned')];
            
        return ['success' => 0, 'msg' => __('errors.assign_task_failed')];
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
            return ['success' => 1, 'msg' => __('messages.changes_saved')];

        return ['success' => 0, 'msg' => __('errors.task_update_failed')];
    }

    public function toggleDone(TodoTask $task){
        if( $task->done ){
            $task->done = false;
            $task->status = 'in-progress';
            $task->date_finished = null;
            $msg = __('messages.reopen_task');
            $action = 're-open';
        }else{
            $task->done = true;
            $task->status = 'finished';
            $task->date_finished = date('Y-m-d H:i:s');
            $msg = __('messages.complete_task');
            $action = 'mark as completed';
        }

        if( $task->update() )
            $is_done = $action == 're-open' ? false : true;
            return ['success' => 1, 'msg' => $msg, 'done' => $is_done];

        return ['success' => 0, 'msg' => 'Something went wrong while trying to '.$action.' this task.'];
    }


    public function destroy(TodoTask $task)
    {
        if( $task->delete() )
            return ['success' => 1, 'msg' => __('messages.deleted')];

        return ['success' => 0, 'msg' => __("errors.process_failed")];
    }

    public function unAssign(TodoTask $task){
        $task->worker_user_id = null;
        if( $task->save() )
            return ['success' => 1];

        return ['success' => 0];
    }

    public function clearTasksByShop(){
        $shop_id = Input::get('shop_id');

        $res = TodoTask::where([
                ['done', '=', 1],
                ['shop_id', '=', $shop_id]
            ])->delete();

        if( $res > 0 ){
            $response = $res > 1 ? "tasks." : "task";
            return ['success' => 1, 'msg' => "Successfully cleared {$res} {$response}"];
        }

        return ['success' => 0, 'msg' => __('errors.no_task_affected')];
    }
}

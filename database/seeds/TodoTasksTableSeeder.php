<?php

use Illuminate\Database\Seeder;
use App\TodoTask;
class TodoTasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task = new TodoTask;
        $task->id = 1;
        $task->service_type_id = null;
		$task->salespot_id = null;
		$task->worker_user_id = 4;
		$task->user_id = 2;
		$task->service_booking_id = null;
		$task->description = "This is a sample task.";
		$task->status = 'pristine';
        $task->done = false;
		$task->save();

        $task = new TodoTask;
        $task->id = 2;
        $task->service_type_id = null;
        $task->salespot_id = 1;
        $task->worker_user_id = 4;
        $task->user_id = 2;
        $task->service_booking_id = null;
        $task->description = "This a second sample task.";
        $task->status = 'pristine'; // not finished
        $task->done = false;
        $task->save();
    }
}

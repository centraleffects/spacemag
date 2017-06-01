<?php
namespace App\Http\Traits;

use App\TodoTask;

trait GeneratesTodo {
	
	public function getScenarios(){
		return [
			"todo_booked",
			"todo_start_discount",
			"todo_end_discount",
			"todo_end_booking",
			"todo_cleaning"
		];
	}

	/**
	* Generates a Todo task
	* @param array $options [scenario, salespot_id, shop_id, service_booking_id, ]
	* @return boolean
	*/
	public function generateTodo($options){
		if( !is_array($option) ) return false;

		if( isset($option['scenario']) ){
			$scenario = $option['scenario'];
		}

		
		if( !in_array($scenario, $this->getScenarios() ) )
			return false;

		$todo = new TodoTask;
		$todo->name = __("messages.$scenario");
			
		if ( isset($option['salespot_id']) ){
			$todo->salespot_id = $option['salespot_id'];
		}

		if( isset($option['shop_id']) ){
			$todo->shop_id = $option['shop_id'];
		}

		if( isset($option['service_booking_id']) && ($scenario == "todo_booked" or $scenario == "todo_end_booking" )){
			$todo->service_booking_id = $option['service_booking_id'];
		}

		if( $todo->save() )
			return true;

		return false;

	}
}
<?php 
namespace App\Helpers;

class Helper {
	
	/**
	* @param object App\User
	* @param boolean 
	* @return string
	*/
	public static function getUserFullName($user, $reversed = false){
		if( $reversed )
			return ucfirst($user->last_name).', '.ucfirst($user->first_name);
		return ucfirst($user->first_name).' '.ucfirst($user->last_name);
	}
}
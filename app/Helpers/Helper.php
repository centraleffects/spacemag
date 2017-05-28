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

	/*
	 *  Generate Barcode
	 */

	public static function getBarCode( $article_code = 'ReBuy Article'){
		$article_code = substr($article_code, 0, 10);
		$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
		return 'data:image/png;base64,' . base64_encode($generator->getBarcode($article_code, $generator::TYPE_CODE_128));	
	}
}
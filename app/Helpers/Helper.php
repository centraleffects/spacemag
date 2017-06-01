<?php 
namespace App\Helpers;

use App\Shop;

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

	/**
	* Generate Barcode
	*/

	public static function getBarCode( $article_code = 'ReBuy Article'){
		$article_code = substr($article_code, 0, 10);
		$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
		return 'data:image/png;base64,' . base64_encode($generator->getBarcode($article_code, $generator::TYPE_CODE_128));	
	}

	public static function collapse_tasks($shop, $user){
		$t1 = collect($shop->tasks)->toArray();
        $t2 = collect( $shop->todoTasks )->toArray();

        foreach ($t1 as $key => $task) {
           	$t1[$key]["done"] = $task["done"] == 1 ? true : false;

           	if( $task['owner']['id'] != $user->id && $user->isWorker() ){
           		unset($t1[$key]);
           	}
        }

        foreach ($t2 as $key => $task) {
            $t2[$key]["done"] = $task["done"] == 1 ? true : false;

            if( $task['owner']['id'] != $user->id && $user->isWorker() ){
           		unset($t1[$key]);
           	}
        }

        $all_tasks = array_collapse([$t1, $t2]);

        return $all_tasks;
	}

	public static function getShopWithTasks($user, $only_first = false, $pages = 10){

		if( $only_first ){
			if( $user->isOwner() or $user->isAdmin() ){
				$shop = $user->ownedShops()->with('todoTasks', 'todoTasks.owner', 'tasks', 'tasks.owner')->first();
			}else{
				$shop = $user->shops()->with('todoTasks', 'todoTasks.owner', 'tasks', 'tasks.owner')->first();
			}
			
	        $all_tasks = self::collapse_tasks($shop, $user);

            // dd($all_tasks);
            
            $shop->all_tasks = $all_tasks;
            unset($shop->tasks);
            unset($shop->todoTasks);

            $shop->workers = self::getShopWorkers($shop);

            return $shop;
		}


		if( $user->isOwner() or $user->isAdmin() ){
			$shops = $user->ownedShops()->with('todoTasks', 'todoTasks.owner', 'tasks', 'tasks.owner')->get();
		}else{
			$shops = $user->shops()->with('todoTasks', 'todoTasks.owner', 'tasks', 'tasks.owner')->get();
		}

		$shops = $shops->filter(function($shop) use ($user) {
		    
            $all_tasks = self::collapse_tasks($shop, $user);
            
            $shop->all_tasks = $all_tasks;
            unset($shop->tasks);
            unset($shop->todoTasks);

            $shop->workers = self::getShopWorkers($shop);
            return $shop;
		});

        return $shops;
	}

	public static function getShopWorkers(Shop $shop){
		return $shop->users()->where('role', '=', 'worker')->get();
	}
}
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

	/**
	* Generate Barcode
	*/

	public static function getBarCode( $article_code = 'ReBuy Article'){
		$article_code = substr($article_code, 0, 6);
		$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
		return 'data:image/png;base64,' . base64_encode($generator->getBarcode($article_code, $generator::TYPE_CODE_128));	
	}

	public static function collapse_tasks($shop, $user){
		if( $shop == null ) return false; 
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
			
			if( $shop == null or $shop == false ) return false;

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

	public static function getShopWorkers(\App\Shop $shop){
		return $shop->users()->where('role', '=', 'worker')->get();
	}

	public static function getDays(){
		return ["mon","tue","wed","thu","fri","sat"];
	}

	public static function getCurrencies(){
		return ['USD' => "US Dollar", "SEK" => "Swedish Krona"];
	}

	public static function getLanguages(){
		return ["en" => "English", "sv" => "Swedish"];
	}

	public static function getGenders(){
		return ['male' => "Male", 'female' => 'Female'];
	}

	public static function getCountries(){
		$countries =  '{"AF":"Afghanistan","AX":"Aland Islands","AL":"Albania","DZ":"Algeria","AS":"American Samoa","AD":"Andorra","AO":"Angola","AI":"Anguilla","AQ":"Antarctica","AG":"Antigua and Barbuda","AR":"Argentina","AM":"Armenia","AW":"Aruba","AU":"Australia","AT":"Austria","AZ":"Azerbaijan","BS":"Bahamas","BH":"Bahrain","BD":"Bangladesh","BB":"Barbados","BY":"Belarus","BE":"Belgium","BZ":"Belize","BJ":"Benin","BM":"Bermuda","BT":"Bhutan","BO":"Bolivia","BQ":"Bonaire, Saint Eustatius and Saba ","BA":"Bosnia and Herzegovina","BW":"Botswana","BV":"Bouvet Island","BR":"Brazil","IO":"British Indian Ocean Territory","VG":"British Virgin Islands","BN":"Brunei","BG":"Bulgaria","BF":"Burkina Faso","BI":"Burundi","KH":"Cambodia","CM":"Cameroon","CA":"Canada","CV":"Cape Verde","KY":"Cayman Islands","CF":"Central African Republic","TD":"Chad","CL":"Chile","CN":"China","CX":"Christmas Island","CC":"Cocos Islands","CO":"Colombia","KM":"Comoros","CK":"Cook Islands","CR":"Costa Rica","HR":"Croatia","CU":"Cuba","CW":"Curacao","CY":"Cyprus","CZ":"Czech Republic","CD":"Democratic Republic of the Congo","DK":"Denmark","DJ":"Djibouti","DM":"Dominica","DO":"Dominican Republic","TL":"East Timor","EC":"Ecuador","EG":"Egypt","SV":"El Salvador","GQ":"Equatorial Guinea","ER":"Eritrea","EE":"Estonia","ET":"Ethiopia","FK":"Falkland Islands","FO":"Faroe Islands","FJ":"Fiji","FI":"Finland","FR":"France","GF":"French Guiana","PF":"French Polynesia","TF":"French Southern Territories","GA":"Gabon","GM":"Gambia","GE":"Georgia","DE":"Germany","GH":"Ghana","GI":"Gibraltar","GR":"Greece","GL":"Greenland","GD":"Grenada","GP":"Guadeloupe","GU":"Guam","GT":"Guatemala","GG":"Guernsey","GN":"Guinea","GW":"Guinea-Bissau","GY":"Guyana","HT":"Haiti","HM":"Heard Island and McDonald Islands","HN":"Honduras","HK":"Hong Kong","HU":"Hungary","IS":"Iceland","IN":"India","ID":"Indonesia","IR":"Iran","IQ":"Iraq","IE":"Ireland","IM":"Isle of Man","IL":"Israel","IT":"Italy","CI":"Ivory Coast","JM":"Jamaica","JP":"Japan","JE":"Jersey","JO":"Jordan","KZ":"Kazakhstan","KE":"Kenya","KI":"Kiribati","XK":"Kosovo","KW":"Kuwait","KG":"Kyrgyzstan","LA":"Laos","LV":"Latvia","LB":"Lebanon","LS":"Lesotho","LR":"Liberia","LY":"Libya","LI":"Liechtenstein","LT":"Lithuania","LU":"Luxembourg","MO":"Macao","MK":"Macedonia","MG":"Madagascar","MW":"Malawi","MY":"Malaysia","MV":"Maldives","ML":"Mali","MT":"Malta","MH":"Marshall Islands","MQ":"Martinique","MR":"Mauritania","MU":"Mauritius","YT":"Mayotte","MX":"Mexico","FM":"Micronesia","MD":"Moldova","MC":"Monaco","MN":"Mongolia","ME":"Montenegro","MS":"Montserrat","MA":"Morocco","MZ":"Mozambique","MM":"Myanmar","NA":"Namibia","NR":"Nauru","NP":"Nepal","NL":"Netherlands","NC":"New Caledonia","NZ":"New Zealand","NI":"Nicaragua","NE":"Niger","NG":"Nigeria","NU":"Niue","NF":"Norfolk Island","KP":"North Korea","MP":"Northern Mariana Islands","NO":"Norway","OM":"Oman","PK":"Pakistan","PW":"Palau","PS":"Palestinian Territory","PA":"Panama","PG":"Papua New Guinea","PY":"Paraguay","PE":"Peru","PH":"Philippines","PN":"Pitcairn","PL":"Poland","PT":"Portugal","PR":"Puerto Rico","QA":"Qatar","CG":"Republic of the Congo","RE":"Reunion","RO":"Romania","RU":"Russia","RW":"Rwanda","BL":"Saint Barthelemy","SH":"Saint Helena","KN":"Saint Kitts and Nevis","LC":"Saint Lucia","MF":"Saint Martin","PM":"Saint Pierre and Miquelon","VC":"Saint Vincent and the Grenadines","WS":"Samoa","SM":"San Marino","ST":"Sao Tome and Principe","SA":"Saudi Arabia","SN":"Senegal","RS":"Serbia","SC":"Seychelles","SL":"Sierra Leone","SG":"Singapore","SX":"Sint Maarten","SK":"Slovakia","SI":"Slovenia","SB":"Solomon Islands","SO":"Somalia","ZA":"South Africa","GS":"South Georgia and the South Sandwich Islands","KR":"South Korea","SS":"South Sudan","ES":"Spain","LK":"Sri Lanka","SD":"Sudan","SR":"Suriname","SJ":"Svalbard and Jan Mayen","SZ":"Swaziland","SE":"Sweden","CH":"Switzerland","SY":"Syria","TW":"Taiwan","TJ":"Tajikistan","TZ":"Tanzania","TH":"Thailand","TG":"Togo","TK":"Tokelau","TO":"Tonga","TT":"Trinidad and Tobago","TN":"Tunisia","TR":"Turkey","TM":"Turkmenistan","TC":"Turks and Caicos Islands","TV":"Tuvalu","VI":"U.S. Virgin Islands","UG":"Uganda","UA":"Ukraine","AE":"United Arab Emirates","GB":"United Kingdom","US":"United States","UM":"United States Minor Outlying Islands","UY":"Uruguay","UZ":"Uzbekistan","VU":"Vanuatu","VA":"Vatican","VE":"Venezuela","VN":"Vietnam","WF":"Wallis and Futuna","EH":"Western Sahara","YE":"Yemen","ZM":"Zambia","ZW":"Zimbabwe"}';
		
		return json_decode( $countries );
	}

	public static function getAvailableShops($user, $pagination = 15)
	{
	    $ids = \DB::table('shop_user')->where('user_id', '=', $user->id)->pluck('shop_id');
	    return \App\Shop::whereNotIn('id', $ids)->orderBy('name', 'asc')->paginate($pagination);
	}

	// returns available sale spots for a specific shop
	public static function getAvailableSaleSpots($shop){
		$ids = $shop->salespotBookings()->get()->pluck('salespot_id');

		return \App\Salespot::whereNotIn('id', $ids)->where(['shop_id' => $shop->id])->get();
	}

}
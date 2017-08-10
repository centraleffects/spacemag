<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;

use App\Helpers\Helper;

use App\Shop;
use App\Salespot;
use App\SalespotCategory;
use App\SalespotCategoryType;
use App\SalespotPrice;

class SalespotController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        $salespot = new Salespot();
        $salespot->shop_id = $input['shop']['id'];
        $salespot->spot_code = !empty($input['spot_code']) ? $input['spot_code'] : '';
        $salespot->spot_location = !empty($input['x_coordinate']) ? $input['x_coordinate'].','.$input['y_coordinate']  : '';
        $salespot->spot_x = !empty($input['y_coordinate']) ? $input['y_coordinate']  : '';
        $salespot->spot_y = !empty($input['x_coordinate']) ? $input['x_coordinate']  : '';
        $salespot->name = !empty($input['name']) ? $input['name']  : '';
        $salespot->description = !empty($input['description']) ? $input['description']  : '';
        $salespot->aisle = !empty($input['aisle']) ? $input['aisle']  : '';
        $salespot->size = !empty($input['size']) ? $input['size']  : '';
        $salespot->status = !empty($input['status']) ? $input['status']  : 'rebuilding';
        $salespot->type = !empty($input['type']) ? $input['type']  : null;

        if($salespot->save()){


            if(!empty($input['selectedCategories'])){

                $categories = SalespotCategory::where('salespot_id', $salespot->id);
                $categories->delete();
                foreach($input['selectedCategories'] as $cat){
                    $a = new SalespotCategory();
                    $a->salespot_id = $salespot->id;
                    $a->category_type_id = $cat;
                    $a->user_id = auth()->guard('api')->user()->id;
                    $a->save();
                }
            }

            if(!empty($input['prices'])){
                $price = SalespotPrice::where('salespot_id', $salespot->id);
                if($price){
                    $price->delete();
                }

                $p = new SalespotPrice();
                $p->salespot_id = $salespot->id;
                $p->daily = $input['prices']['daily'];
                $p->week1 = $input['prices']['week1'];
                $p->week2 = $input['prices']['week2'];
                $p->week3 = $input['prices']['week3'];
                $p->week4 = $input['prices']['week4'];
                $p->save();
            }

            return [ 'success'=> 1 ];
        }
         return [ 'success'=> 0 ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salespot  $salespot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salespot $salespot)
    {
        $input = Input::all();
        $salespot = Salespot::where('id', $input['id'])->first();
        $salespot->shop_id = $input['shop']['id'];
        $salespot->spot_code = !empty($input['spot_code']) ? $input['spot_code'] : '';
        $salespot->spot_location = !empty($input['spot_x']) ? $input['spot_x'].','.$input['spot_y']  : '';
        $salespot->spot_y = !empty($input['spot_y']) ? $input['spot_y']  : '';
        $salespot->spot_x = !empty($input['spot_x']) ? $input['spot_x']  : '';
        $salespot->name = !empty($input['name']) ? $input['name']  : '';
        $salespot->description = !empty($input['description']) ? $input['description']  : '';
        $salespot->aisle = !empty($input['aisle']) ? $input['aisle']  : '';
        $salespot->size = !empty($input['size']) ? $input['size']  : '';
        $salespot->type = !empty($input['type']) ? $input['type']  : null;
        $salespot->status = !empty($input['status']) ? $input['status']  : 'rebuilding';

        if($salespot->save()){

            if(!empty($input['selectedCategories'])){

                $categories = SalespotCategory::where('salespot_id', $salespot->id);
                if($categories){
                    $categories->delete();
                }
                
                foreach($input['selectedCategories'] as $cat){
                    $a = new SalespotCategory();
                    $a->salespot_id = $salespot->id;
                    $a->category_type_id = $cat;
                    $a->user_id = auth()->guard('api')->user()->id;
                    $a->save();
                }

            }

            if(!empty($input['prices'])){
                $price = SalespotPrice::where('salespot_id', $salespot->id);
                if($price){
                    $price->delete();
                }

                $p = new SalespotPrice();
                $p->salespot_id = $salespot->id;
                $p->daily = $input['prices']['daily'];
                $p->week1 = $input['prices']['week1'];
                $p->week2 = $input['prices']['week2'];
                $p->week3 = $input['prices']['week3'];
                $p->week4 = $input['prices']['week4'];
                $p->save();
            }

            return [ 'success'=> 1 ];
        }
         return [ 'success'=> 0 ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salespot  $salespot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salespot $salespot)
    {
        $input = Input::all();
        $salespot = Salespot::where('id', $input['id'])->first();
        if($salespot){
            if($salespot->delete()){
                return [ 'success' => 1];
            }
        }
        return [ 'success' => 0];
    }

    public function getlist(Shop $shop){

            return Salespot::where('shop_id', $shop->id)
                            ->with('categories','prices', 'bookings')
                            ->with('categories.type')
                            ->with('bookings.user')
                            ->get()->toArray();

    }

    public function getAvailableSaleSpot(Shop $shop){
        $spots = Helper::getAvailableSaleSpots($shop);
        return $spots;
    }

    public function getTasks(Salespot $salespot){
        $tasks = $salespot->todoTasks()->with('completor')->get();

        return $tasks;
    }
}

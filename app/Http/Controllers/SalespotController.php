<?php

namespace App\Http\Controllers;

use App\Salespot;
use App\Shop;
use App\Helpers\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;

use App\Salespot;
use App\SalespotCategory;
use App\SalespotCategoryType;

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
        $salespot->name = !empty($input['name']) ? $input['name']  : '';
        $salespot->description = !empty($input['description']) ? $input['description']  : '';
        $salespot->aisle = !empty($input['aisle']) ? $input['aisle']  : '';
        $salespot->size = !empty($input['size']) ? $input['size']  : '';
        $salespot->status = !empty($input['status']) ? $input['status']  : 'rebuilding';

        if($salespot->save()){

            if(!empty($input['categories'])){

                $categories = SalespotCategory::where('salespot_id', $salespot->id);
                $categories->delete();
                foreach($input['categories'] as $cat){
                    $a = new SalespotCategory();
                    $a->salespot_id = $salespot->id;
                    $a->category_type_id = $cat;
                    $a->user_id = auth()->guard('api')->user()->id;
                    $a->save();
                }
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
        $salespot->spot_location = !empty($input['x_coordinate']) ? $input['x_coordinate'].','.$input['y_coordinate']  : '';
        $salespot->name = !empty($input['name']) ? $input['name']  : '';
        $salespot->description = !empty($input['description']) ? $input['description']  : '';
        $salespot->aisle = !empty($input['aisle']) ? $input['aisle']  : '';
        $salespot->size = !empty($input['size']) ? $input['size']  : '';
        $salespot->status = !empty($input['status']) ? $input['status']  : 'rebuilding';

        if($salespot->save()){

            if(!empty($input['categories'])){

                $categories = SalespotCategory::where('salespot_id', $salespot->id);
                $categories->delete();

                foreach($input['categories'] as $cat){
                    $a = new SalespotCategory();
                    $a->salespot_id = $salespot->id;
                    $a->category_type_id = $cat;
                    $a->user_id = auth()->guard('api')->user()->id;
                    $a->save();
                }

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

    public function getlist(){
        $list = Salespot::with('categories')->with('categories.type')->get();
        return $list->toArray();
    }

    public function getAvailableSaleSpot(Shop $shop){
        $spots = Helper::getAvailableSaleSpots($shop);
        return $spots;
    }
}

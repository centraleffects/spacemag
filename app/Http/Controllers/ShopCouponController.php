<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use App\ShopCoupon;

use JavaScript;
use Helpers;


class ShopCouponController extends Controller
{
    

    public function includeUserOnJS()
    {
        $shops = auth()->user()->ownedShops()->get();
        $shop = session()->put('shops', $shops);

        if( !session()->has("selected_shop") && auth()->check() ){
            $shop = auth()->user()->ownedShops()->with('todoTasks')
                        ->with('todoTasks.owner')->first();
            session()->put("selected_shop", $shop);
        }

        $shop = session()->get('selected_shop');
        

        JavaScript::put([
            'user' => auth()->user(),
            'selectedShop' => $shop
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = Input::all();

        if(Input::has('ajax')){

            if(Input::has('data')){
 
               $data = null;



               foreach($input['data'] as $d){
                    if($d['name'] <> "article-tags" and $d['name'] <> "categories"){
                        $data[$d['name']] = $d['value'];
                    }else{
                        if($d['name'] == "article-tags"){
                            $data['tags'][] = $d['value'];
                        }
                        if($d['name'] == "categories"){
                            $data['categories'][] = $d['value'];
                        }
                    }
                    
               }
               $shop = session()->get('selected_shop');
               if(!$shop){
                    //prevent
                    return [
                        'success' => 0
                    ]; 
               }

               if(!empty($data['id'])){
                 $coupon = ShopCoupon::where('id',$data['id'])->first();
               }else{
                  $coupon =  new ShopCoupon();
               }
                 if($coupon){

                    $coupon->shop_id = $shop->id;
                    $coupon->type = !empty($data['type']) ? $data['type'] : '';
                    $coupon->value = !empty($data['value']) ? $data['value'] : '';
                    $coupon->date_start = !empty($data['date_start']) ? date('Y-m-d', strtotime($data['date_start'])) : '';
                    $coupon->date_end = !empty($data['date_end']) ? date('Y-m-d', strtotime($data['date_end'])) : '';
                    $coupon->is_active = !empty($data['is_active']) ? (int)$data['is_active'] : 0;
                    $coupon->code = !empty($data['code']) ? $data['code'] : '';
                
                    
                    $coupon->save();



                 }  

                return [
                    'success' => 1,
                    'coupon_id' => $coupon->id
                ]; 
            }

            return [
                    'success' => 0
                ]; 

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShopCoupon  $shopCoupon
     * @return \Illuminate\Http\Response
     */
    public function show(ShopCoupon $shopCoupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShopCoupon  $shopCoupon
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopCoupon $shopCoupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShopCoupon  $shopCoupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShopCoupon $shopCoupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShopCoupon  $shopCoupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $coupon = ShopCoupon::where('id', $id)->first();
        if($coupon){
            $coupon->delete();
            session()->put('alert', 'A coupon has been deleted.');
        }
       
       return \Redirect::to('/shop/coupons');
    }


    public function indexOwner($id = null){
        $this->includeUserOnJS();

        
        $shop = session()->get('selected_shop');

        $coupons  =  $shop->coupons();

        dd($coupons);
        if(empty($coupons)){
            $coupons = [];
        }
        
        $selectedCoupon = new ShopCoupon();
       if(!empty($id)){
         $selectedCoupon = ShopCoupon::where('id',$id)->with('users')->first();
       }


       return view('shop_owner.coupons', compact('coupons', 'selectedCoupon'));
    }
}

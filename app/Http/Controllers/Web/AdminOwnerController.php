<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Shop;
use App\Salespot;
use App\Helpers\Helper;
use JavaScript;

class AdminOwnerController extends Controller{

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            
            if( auth()->check() && (auth()->user()->isOwner() or auth()->user()->isWorker() 
                or $request->session()->has('loggedin_as_someone') or auth()->user()->isAdmin()) ){
                $user = auth()->user();

                if( !auth()->user()->isAdmin() ){
                    if( auth()->user()->isOwner() ){
                   
                        $shops = $user->ownedShops()->get();
                       
                    }else{
                        $shops = $user->shops()->get();
                    }

                    $shop = Helper::getShopWithTasks(auth()->user(), true);

                    session()->put('shops', $shops);

                    if( !session()->has("selected_shop") ){
                        
                        session()->put("selected_shop", $shop);
                    }else{
                        // make sure shop info inside the session is updated
                        $shop = Shop::find(session()->get('selected_shop')->id);
                        session()->put('selected_shop', $shop);
                    }
                    
                    
                    JavaScript::put([
                        'user' => $user,
                        'selectedShop' => $shop,
                        'shops' => $shops
                    ]);
                }

                return $next($request);
            }

            return redirect('/');
            
        });
    }

	public function loginAsSomeone(User $user, $shopId = false, Request $request){

        if( $shopId != false ){
            $shop = Shop::findOrFail($shopId);
            session()->put('selected_shop', $shop);
        }

        if( session()->has('selected_shop') ){
            $shop = session()->get('selected_shop');

            $auth_user_id = auth()->user()->id;
            // preserve the current localization
            $currentLocale = \App::getLocale();

            // validate if user actually own this shop
            // and make sure the loggedin user is not also the specified user
            // if( ($shop->owner()->first()->id == $auth_user_id && $auth_user_id != $user->id) || auth()->user()->isAdmin() ){
            if( ( $shop->owners()->find($auth_user_id) !== null && $auth_user_id != $user->id) || auth()->user()->isAdmin() ){

                $request->session()->flush();
                $request->session()->regenerate();

                auth()->loginUsingId($user->id);

                session()->put('applocale', $currentLocale); 

                // the shopowner who logged in as customer/client
                session()->put('loggedin_as_someone', ['id' => $auth_user_id, 'url' => url()->previous()]);

                return redirect('shop');
            }
        }

        return redirect()->back();
    }

    public function loginBack(Request $request){
        if( $request->session()->has('loggedin_as_someone') ){
            $real_auth = session()->get('loggedin_as_someone');

             // preserve the current localization
            $currentLocale = \App::getLocale();

            $request->session()->flush();
            $request->session()->regenerate();

            auth()->loginUsingId($real_auth['id']);
            
            session()->put('applocale', $currentLocale); 

            return redirect($real_auth['url'])->withFlash_message([
            // return redirect(session()->get('previous_url'))->withFlash_message([
                    'type' => 'info',
                    'msg' => __('messages.welcome_back', ['name' => ucfirst(auth()->user()->first_name)]),
                    'important' => false
                ]);
        }

        return redirect()->back();
    }

    public function setShopSession(Shop $shop){
      session()->put("selected_shop", $shop);
      $input = Input::all();
      return redirect(base64_decode($input['redirect']));
        
    }

    public function spots(Salespot $id){
        $shop = session()->get('selected_shop');
        $floorimg = file_exists(FLOOR_MAP.'img_'.$shop->id.'.jpg') ? 'img_'.$shop->id.'.jpg' : 'default.jpg';
        return view('shop_owner.spots')->withShop($shop)->withFloorimg($floorimg);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

use JavaScript;
use Mail;

use App\Mail\PasswordReset;
use App\Http\Requests\ShopInvitationRequest;
use App\Mail\ShopInvitation;
use App\Mail\ShopWorkerInvitation;
use App\Helpers\Helper;

use App\Shop;
use App\User;
use App\Salespot;
use App\ServiceType;

class ShopOwnerController extends Controller
{
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

    public function index(){    
        $days = Helper::getDays();
        $currencies = Helper::getCurrencies();

        if( !session()->has('selected_shop') ){
            $shop = auth()->user()->ownedShops()->first();

            session()->put('selected_shop', $shop);
        }

        $shop = session()->get('selected_shop');

        if( $shop == null or $shop == false ) die(__('errors.owner_doesnt_have_a_shop'));

        $sched = explode(",", $shop->cleanup_schedule);
        $shop->cleanup_schedule = $sched;

    	return view('shop_owner.dashboard')->withDays($days)
            ->withCurrencies($currencies)
            ->with("shop", $shop);
    }

    public function articles(){
        $articles = auth()->user()->articles()->get();
        // $tags = 
        dd($articles);
        JavaScript::put([
            'articles' => $articles
        ]);

        
    	return view('shop_owner.articles')->withArticles($articles);
    }

    public function customers(){
        
    	return view('shop_owner.customers');
    }

    public function todo(){
        
        return view('shop_owner.todo');
    }

    public function workers(){
        
        return view('shop_owner.workers');
    }

    public function workersTodo(){
        if( session()->has('selected_shop') ){
            $shop = session()->get('selected_shop');
            $workers = $shop->workers()->get();
            $tasks = $shop->tasks()->with('owner')->get();

            $shop->tasks = $tasks->toArray();
            $shop->workers = $workers->toArray();
            // dd($shop);

            session()->put('selected_shop', $shop);
            JavaScript::put([
                'selectedShop' => $shop
            ]);
        }
        return view('shop_owner.workers_todo');
    }
}

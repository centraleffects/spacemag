<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use App\Article;
use App\Sale;
use App\SalespotCategoryType;
use App\ArticleTag;
use App\ArticleCategories;
use App\Tag;
use App\ArticlePrice;
use App\User;
use App\Shop;

use JavaScript;
use App\Helpers\Helper;


class ClientController extends Controller
{
    use SoftDeletes; 

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

	public function indexOwner($id = null){

		 $input = Input::all();

        if(Input::has('ajax')){

            if(Input::has('data')){

              /*  $data = null;
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
               if(!empty($data['id'])){
                 $article = Article::where('id',$data['id'])->first();
               }else{
                  $article =  new Article();
               }
                 if($article){
                    $article->name = !empty($data['name']) ? $data['name'] : '';
                    $article->description = !empty($data['description']) ? $data['description'] : '';
                    $article->quantity = !empty($data['quantity']) ? (int)$data['quantity'] : 0;
                    $article->sold_in_bulk = !empty($data['sold_in_bulk']) ? $data['sold_in_bulk'] : 0;
                    $article->sold_in_pieces = !empty($data['sold_in_pieces']) ? $data['sold_in_pieces'] : 0;
                    $article->type = !empty($data['type']) ? $data['type'] : '';
                    $article->color = !empty($data['color']) ? $data['color'] : '';
                    
                    if(!empty($data['client'])){
                        $article->user_id = $data['client'];
                    }else{
                        //set to the current user
                        $article->user_id = $input['user_id'];
                    }
                    
                    $article->save();


                 }  */
               
                  return [
                    'success' => 1,
                    'article_id' => $article->id
                ];
            }
            return [
                'success' => 0
            ];
        }

        //---------------------------------------------------------------------
        //-------------------------------------------------------------------------
        //----------------------------------------------------------------

        $this->includeUserOnJS();
        
        $clients = User::where([ 'role' => 'client'])->get();
        if(empty($clients)){
        	$clients = [];
        }
        if(empty($id)){
            if($clients){
               // $id = $clients[0]->id;
            }else{
            	$selectedClient =  [];
            }
        }
      
        $new_client = ( request()->segment(3) == "new" ) ;
        
        if(!empty($id) && !$new_client){
            $selectedClient = User::where(['id' => $id])->first();

        }else{
        	$selectedClient = [];
        }


        $shop = session()->get('selected_shop');
       

        return view('shop_owner.clients', compact('shop', 'clients', 'selectedClient'));
	}

    // my-shop
    public function myShops(){
        $shops = auth()->user()->shops()->orderBy('name', 'asc')->paginate(15);
        $all_shops = Helper::getAvailableShops(auth()->user());

        JavaScript::put([
            'user' => auth()->user(),
            'shops' => $shops
        ]);

        return view('customers.shops')->withShops($shops)
            ->withAll_shops($all_shops);
    }

    public function viewShop(Shop $shop){
        return view('customers.shop')->withShop($shop);
    }

    public function bookings(){
        $shops = auth()->user()->shops()->orderBy('name', 'asc')->paginate(15);

        JavaScript::put([
            'user' => auth()->user(),
            'shops' => $shops
        ]);
        
        return view('customers.bookings')->withShops($shops);
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
}

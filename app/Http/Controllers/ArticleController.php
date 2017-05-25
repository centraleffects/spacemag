<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Input;

use App\Article;
use App\Sale;
use App\SalespotCategoryType;

use JavaScript;

class ArticleController extends Controller
{
    
    use SoftDeletes; 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(25);
        return $articles;
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function indexOwner($id = null){

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
               dd( $data );
            }
            return [
                'success' => 0
            ];
        }

        $this->includeUserOnJS();
        
        $articles = Article::all();
        if($id){
            $selectedArticle = Article::find($id);

        }else{
            if($articles){
                $selectedArticle = $articles[0];
            }
        }
        
        $shop = session()->get('selected_shop');
        $categories = SalespotCategoryType::all();

        return view('shop_owner.articles', compact('articles', 'selectedArticle', 'shop', 'categories'));

    }
}

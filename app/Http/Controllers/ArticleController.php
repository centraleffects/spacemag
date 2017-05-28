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

use JavaScript;
use Helpers;

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
               if(!empty($data['id'])){
                 $article = Article::find($data['id']);
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

                    //update tags
                    if(!empty($data['tags'])){
                        
                        ArticleTag::where("article_id", $article->id )->delete();

                        foreach( $data['tags'] as $tag){
                            if(is_numeric(trim($tag))){
                                $newArticleTag = new ArticleTag();
                                $newArticleTag->article_id = $article->id;
                                $newArticleTag->tag_id = $tag;
                                $newArticleTag->save();
                            }else{

                                $newTag = Tag::where(['user_id' => $input['user_id'], 'name' => $tag])->first();

                                if(!$newTag){
                                    $newTag = new Tag();
                                    $newTag->user_id = $input['user_id'];
                                    $newTag->name = $tag;
                                    $newTag->save();
                                }
                                $newArticleTag = new ArticleTag();
                                $newArticleTag->article_id = $article->id;
                                $newArticleTag->tag_id = $newTag->id;
                                $newArticleTag->save();
                            }
                        }

                    }

                    //update category
                    if(!empty($data['categories'])){
                       ArticleCategories::where("article_id", $article->id )->delete();
                       foreach( $data['categories'] as $category){
                                $newArticleCategory = new ArticleCategories();
                                $newArticleCategory->article_id = $article->id;
                                $newArticleCategory->category_id = $category;
                                $newArticleCategory->save();
                       }
                    }

                 }  
               }
                  return [
                    'success' => 1
                ];
            }
            return [
                'success' => 0
            ];
        }

        $this->includeUserOnJS();
        
        $articles = Article::all();

        if(!$id){
            if($articles){
                $id = $articles[0]->id;
            }
        }

        if($id){
            $selectedArticle = Article::find($id)->with('tags','categories')->first();

        }else{
            $selectedArticle = [];
        }

        $selected_article_tags = [];
        if($selectedArticle->tags){
            foreach($selectedArticle->tags as $key => $tag){
                    $Tag = Tag::where('id', $tag->tag_id)->first();
                    if($Tag){
                        $selectedArticle->tags[$key]['tag'][$key] = [ 'id'=> $Tag->id , 'name' => $Tag->name ];
                        $selected_article_tags[] = [ 'id'=> $Tag->id , 'name' => $Tag->name ];  
                    }
                    $Tag = [];
            }
        }

        $selected_article_categories = [];
        if($selectedArticle->categories){
            foreach($selectedArticle->categories as $key => $category){
                    $categoryType = SalespotCategoryType::where( 'id', $category->category_id)->first();
                    $selectedArticle->categories[$key]['category'][$key] = [ 'id'=> $categoryType->id , 'name' => $categoryType->name ];
                    array_push($selected_article_categories, $categoryType->id );
            }
        }

        $shop = session()->get('selected_shop');
        $categories = SalespotCategoryType::all();

        return view('shop_owner.articles', compact('articles', 'selectedArticle', 'shop', 'categories', 'selected_article_categories', 'selected_article_tags'));

    }
}

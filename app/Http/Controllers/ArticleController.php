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
use App\ArticleLabel;

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
               foreach($input['data']['data'] as $d){
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

                    //update price
                    if(!empty($data['price'])){
                        $price = ArticlePrice::where("article_id", $article->id )->first();
                        $add_price = false;
                        if($price){
                            if($price->price <> $data['price']){
                                $price->update( ['status' => 0 ]);
                                $add_price = true;  
                            }
                            
                        }else{
                            $add_price = true;  
                        }

                        if($add_price){
                            $price = new ArticlePrice();
                             $price->price = $data['price'];
                             $price->article_id = $article->id;
                             $price->status = 1;
                             $price->original_price = !empty($data['original_price']) ? $data['original_price'] : 0;
                             $price->save();
                        }
                    }

                    //add files
                    $sample_picture_filename = "";
                    if(!empty($input['data']['files']['sample_picture'])){
                      list($type, $sample_picturedata) = explode(';',$input['data']['files']['sample_picture']);
                      list(, $sample_picturedata)      = explode(',', $sample_picturedata);
                      list(,$type) = explode('/', $type);
                      if(!is_dir(LABEL_DIR)){
                        mkdir(LABEL_DIR, 0775);
                      }
                      if(in_array($type, ['png', 'jpg', 'jpeg'])){
                        //save image
                        $source = fopen($input['data']['files']['sample_picture'], 'r');
                        $destination = fopen(LABEL_DIR.'sample_picture_'.$article->id.'.'.$type, 'w');

                        stream_copy_to_stream($source, $destination);

                        fclose($source);
                        fclose($destination);

                        $sample_picture_filename = 'sample_picture_'.$article->id.'.'.$type;
                      }
                    }

                    $label_filename = '';

                    if(!empty($input['data']['files']['label_design'])){
                      list($type, $label_designdata) = explode(';',$input['data']['files']['label_design']);
                      list(, $label_designdata)      = explode(',', $label_designdata);
                      list(,$type) = explode('/', $type);
                      if(!is_dir(LABEL_DIR)){
                        mkdir(LABEL_DIR, 0775);
                      }
                      if(in_array($type, ['png', 'jpg', 'jpeg'])){
                        //save image
                        $source = fopen($input['data']['files']['label_design'], 'r');
                        $destination = fopen(LABEL_DIR.'label_design_'.$article->id.'.'.$type, 'w');

                        stream_copy_to_stream($source, $destination);

                        fclose($source);
                        fclose($destination);

                        $label_filename  = 'label_design_'.$article->id.'.'.$type;
                      }
                    }

                    //save to article_labels table
                    $label = ArticleLabel::where(['article_id' => $article->id])->first();
                    if(!$label){
                       $label = new ArticleLabel();
                    }
                    $label->article_id =  $article->id;
                    if($label_filename){
                      $label->filename = $label_filename;
                    }
                    $label->user_id =  $input['user_id'];
                    $label->print_medium = !empty($data['label_medium']) ? $data['label_medium'] : '';
                    $label->salespot_id = !empty($data['salespot_id']) ? $data['salespot_id'] : 1;
                    $label->status = !empty($data['label_status']) ? $data['label_status'] : '';
                    if($sample_picture_filename){
                      $label->sample_picture = $sample_picture_filename;
                    }
                    $label->save();

                  //------------------  
                 }  
               
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
        
        $articles = Article::all();

        if(!$id){
            if($articles){
                $id = $articles[0]->id;
            }
        }
      
        $new_article = ( request()->segment(3) == "new" ) ;

        if($id && !$new_article){
            $selectedArticle = Article::where('id',$id)->with('tags','categories', 'labels','salespots')->first();

        }else{
            $selectedArticle =  new Article();
        }
        dd($selectedArticle);
        $selected_article_tags = [];
        $selected_article_categories = [];
        $prices = [];

        if(!$new_article ){
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

            
            if($selectedArticle->categories){
                foreach($selectedArticle->categories as $key => $category){
                        $categoryType = SalespotCategoryType::where( 'id', $category->category_id)->first();
                        $selectedArticle->categories[$key]['category'][$key] = [ 'id'=> $categoryType->id , 'name' => $categoryType->name ];
                        array_push($selected_article_categories, $categoryType->id );
                }
            }
        }
        if($selectedArticle){
             $prices = ArticlePrice::where(["article_id" => $selectedArticle->id, 'status' => 1])->first();
        }

        $shop = session()->get('selected_shop');
        $categories = SalespotCategoryType::all();


        return view('shop_owner.articles', compact('articles', 'selectedArticle', 'shop', 'categories', 'selected_article_categories', 'selected_article_tags', 'prices'));

    }
}

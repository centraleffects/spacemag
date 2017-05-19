<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Helper\Form;

use App\User;
use App\SalespotCategoryType;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       return view('admin.dashboard');
    }


    public function users(){
        return view('admin.users');
    }

     public function loggedProfile(){
        return \Auth::user();
    }

    public function shops(Request $request){
        return view('admin.shops');
    }

    public function spots(Request $request){
        return view('admin.spots');
    }

    public function categories($category = null){
    
        $categories = SalespotCategoryType::all();

        if(!empty($category)){
            SalespotCategoryType::destroy($category);
            return redirect('admin/categories');
        }

        $input = Input::all();
        if(!empty($input['name']) && !empty($input['description'])){
            $category = new SalespotCategoryType();
            $category->name = $input['name'];
            $category->description = $input['description'];
            if($category->save()){
                return redirect('admin/categories');
            }
        }
        return view('admin.categories')->withCategories($categories);
    }

    public function transactions(Request $request){
        return view('admin.transactions');
    }
}

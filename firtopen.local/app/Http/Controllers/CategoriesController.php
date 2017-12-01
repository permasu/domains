<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Categories;
class CategoriesController extends Controller
{
    public function categoryAction($id){

        $category   = Categories::find($id);
        
  
        if ($category)
        {
     
          $goods =Goods::Find(['category_id'=>$category->id]);
       
            return view('goods', ['goods'=>$goods]);
        }
            
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
class GoodsController extends Controller
{
    //
    public function showAction($id)
    {
		$product	=	Goods::find($id);
		if ($product){
			
	
		return view('product',['good'=>$product]);
			}
	}
}

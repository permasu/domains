<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Goods;
class OrdersController extends Controller
{
    //
    public function	buyAction($id)
    {
		$product=Goods::find($id);
		if ($product)
		{
			return view('orders', ['goods_id' => $product->id]);
		}
	}
}

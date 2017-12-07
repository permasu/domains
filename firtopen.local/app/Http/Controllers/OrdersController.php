<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Goods;
Use App\Orders;
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
	public function finishAction(Request $request){
       $input = $request->all();
//        var_dump($input);die;
        $order  =   new Orders();
        $order->customer_name   =  $request->input('customer_name');
        $order->phone   =   $request->input('phone');
        $order->city_id = $request->input('city');
        $order->comment =   $request->input('comment');
        $order->save();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\item;

class buy_item_page extends Controller
{
	public function index($id){
		$item = item::find($id);
		return view('buy_item_page', ['items'=>$item]);
	}

 //    public function buy_item(Request $request){
	// 	$item = item::where('id', $request->item_id);
	// 	return view('buy_item_page', ['items'=>$item]);
	// }
}

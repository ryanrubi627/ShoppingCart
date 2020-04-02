<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\item;

class user_page extends Controller
{
    public function index(){
		$item = item::all();
		return view('user_page', ['items'=>$item]);
	}

	public function show_item(Request $request){
		$item_id = item::find($request->id);
		return response()->json($item_id);
	}

	public function quantity_update(Request $request){
		$id = $request->id;
		$result_quantity = $request->result_quantity;

		item::where('id', $id)
                  ->update(['quantity' => $result_quantity]);
	}

	public function cart_item(Request $request){
		$item_id = item::find($request->id);
		return response()->json($item_id);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cart;
use App\item;

class cart_page extends Controller
{
  public function index(){
      $cart_item = cart::all();
		  return view('cart_page', ['cart_items'=>$cart_item]);
	}

  public function insert_cart_item(Request $request){

      $cart = new cart();
      $cart->nameofitem = $request->name;
      $cart->item_id = $request->id;
      $cart->description = $request->description;
      $cart->quantity = $request->quantity;
      $cart->price = $request->price;
      $cart->save();

  }

  public function delete_cart_item($id){
    cart::where('id', $id)->delete();
    return redirect('/cart_page');
  }

  //DISPLAY ITEM TO MODAL OF CART_PAGE..
  public function display_item(Request $request){

    $id = $request->item_id;
    $item_id = item::where('id', $id)->first();
    return response()->json($item_id);
  }

  public function quantity_update(Request $request){
    $id = $request->id;
    $result_quantity = $request->result_quantity;

    item::where('id', $id)
                  ->update(['quantity' => $result_quantity]);

    cart::where('item_id', $id)->delete();
  }
}

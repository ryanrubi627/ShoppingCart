<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\item;

class admin_page extends Controller
{
	public function index(){
		$item = item::all();
		return view('admin_page', ['items'=>$item]);
	}

  public function insert_item(Request $request){

    if($file = $request->file('image')){

      $filename = $request->file('image')->getClientOriginalName();
      $fileToStore = rand().$filename;
      $request->file('image')->move(public_path('images'), $fileToStore);

      $item = new item();
      $item->nameofitem = $request->nameofitem;
      $item->description = $request->description;
      $item->quantity = $request->quantity;
      $item->price = $request->price;
      $item->image = $fileToStore;
      $item->save();

    }
  }

  public function update_item(Request $request){

    $id = $request->id;
    $nameofitem = $request->nameofitem;
    $description = $request->description;
    $quantity = $request->quantity;
    $price = $request->price;

    item::where('id', $id)
                  ->update(['nameofitem' => $nameofitem, 'description' => $description, 'quantity' => $quantity, 'price' => $price]);
  }

  public function delete_item($id){
  	$delete = item::where('id', $id)->delete();
    // unlink(public_path('images/'.$delete->image));
  	return redirect('/admin_page');
  }
}

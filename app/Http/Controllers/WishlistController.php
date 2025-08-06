<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\shipping;
use App\Models\shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class WishlistController extends Controller
{
    //

    #add wishlist 
    #auth Vivek
    public function addToWishlist($productId){
     // return $productId;
    Wishlist::firstOrCreate([
        'user_id' => auth()->id(),
        'product_id' => $productId
    ]);

    return back()->with('success', 'Product added to wishlist!');
   }

   #add wishlist 
   #auth Vivek
   public function delete($id){
    Wishlist::where('id', $id)->delete();
    return redirect()->back()->with('success', 'Item deleted successfully.');
   }

   #get shipping 
   #auth Vivek
   public function Getshipping(){
    $ShippingList = shipping::orderbydesc('id')->get();
     return view('Admin.shipping',compact('ShippingList'));
   }

   #Add Createshipping
    #authr: vivek
    public function Createshipping(Request $request){
      $request->validate([
        'name' => 'required',
        'price' => 'required',
    ]);
         $Createshipping = new shipping();
            $Createshipping->name = $request->input('name');
            $Createshipping->price = $request->input('price');
            $Createshipping->save();
        return redirect()->back()->with('success', 'added successfully!');
    }

  #soft delete shipping
  #authr: vivek
   public function Deleteshipping($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $shipping = shipping::findOrFail($decryptedId);
            $shipping->delete();
            return redirect()->back()->with('success', 'Item deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }

   #get shop 
   #auth Vivek
   public function Getshop(){
    $shoplist = shop::orderbydesc('id')->get();
    return view('Admin.shop_list',compact('shoplist'));
   }

   #Add Createshop
    #authr: vivek
    public function Createshop(Request $request){
      $request->validate([
        'name' => 'required',
        'address' => 'required',
    ]);
         $Createshipping = new shop();
            $Createshipping->name = $request->input('name');
            $Createshipping->address = $request->input('address');
            $Createshipping->save();
        return redirect()->back()->with('success', 'added successfully!');
    }

  #soft delete shop
  #authr: vivek
   public function Deleteshop($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $shop = shop::findOrFail($decryptedId);
            $shop->delete();
            return redirect()->back()->with('success', 'Item deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }

    
}

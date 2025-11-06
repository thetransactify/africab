<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\shipping;
use App\Models\productsPostion;
use App\Models\ProductPrice;
use App\Models\shop;
use App\Models\popularProducts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;


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
    return back()->with('success', 'Added to wishlist! View it in “My Wishlist”');
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

   #get Product Postion 
   #auth Vivek
   public function GetProductPostion(){
    $products = productsPostion::with(['Product'])->orderbydesc('id')->get();
    $productList = ProductPrice::orderbydesc('id')->where('product_online','1')->get();
    //return $products;
    return view('Admin.Product_positioning',compact('products','productList'));
   }

    #Add CreateProductPostion
    #authr: vivek
    public function CreateProductPostion(Request $request){
      $request->validate([
        'product_id' => 'required',
        'Postion' => [
            'required',
            Rule::unique('product_sections', 'position')
        ],
        ], [
            'Postion.unique' => 'This position is already assigned for the selected product.',
        ]);
         $Createproduct = new productsPostion();
         $Createproduct->product_id = $request->input('product_id');
         $Createproduct->position = $request->input('Postion');
         $Createproduct->save();
        return redirect()->back()->with('success', 'added successfully!');
    }    

  #soft delete ProductPostion
  #authr: vivek
   public function Deletepositioning($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $productsPostion = productsPostion::findOrFail($decryptedId);
            $productsPostion->delete();
            return redirect()->back()->with('success', 'Item deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }

   #get Product Tracker
   #auth Vivek
   public function GetPopularProduct(){
    $products = popularProducts::with(['Product'])->orderbydesc('id')->get();
    return view('Admin.trackproducts',compact('products'));
   }

    
}

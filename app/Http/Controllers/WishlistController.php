<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;



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

}

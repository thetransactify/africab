<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Review;
use App\Models\Orders;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;


class ClientController extends Controller
{
    //
    # admin reviewlist
    # auth: vivek
    public function ShowReview(){
    	$reviewlist = Review::with(['Product','users'])->where('status',1)->get();
    	return view(' Admin.reviewlist',compact('reviewlist'));
    }

   
    # admin getreviewList
    # auth: vivek
    public function getReview($id){
	    $ids = Crypt::decrypt($id);
	    $review = Review::with(['Product','users'])->findOrFail($ids);
	    return response()->json([
	    	'ids' => Crypt::encrypt($review->id),
	        'review_date' => $review->created_at->format('d-m-y'),
	        'customer_name' => $review->users->name,
	        'customer_email' => $review->users->email,
	        'product_name' => $review->product->name,
	        'rating' => $review->rating,
	        'comment' => $review->comment,
	    ]);
	}

	#soft delete reviews list
    #authr: vivek
    public function Deletereviews($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $ProductList = Review::findOrFail($decryptedId);
            $ProductList->delete();

            return redirect()->back()->with('success', 'Review deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }

    #soft update reviews 
    #authr: vivek

    public function updateStatus(Request $request){
    $ids = Crypt::decrypt($request->review_id);
    $review = Review::findOrFail($ids);
    $review->status = $request->status;
    $review->save();

    return response()->json(['success' => true, 'message' => 'Review status updated successfully.']);
   }

   # admin reviewlist
   # auth: vivek
    public function ModeratedReview(){
    	$moderatedlist = Review::with(['Product','users'])->where('status','!=', '1')->get();
    	return view(' Admin.moderated_list',compact('moderatedlist'));
    }

   # client reviewlist
   # auth: vivek
    public function ClientReviews(){
        $reviewlist = Review::with(['productprice','users'])->orderbydesc('id')->where('status',2)->get();
        //return  $reviewlist;
          $reviewlists = [];
          foreach($reviewlist as $review){
            $reviewlists[] = [
              'clientname' => $review->users->name,
              'comment' => $review->comment,
              'rating' => $review->rating,
              'productname' => $review->productprice->listing_name,
            ];
          }
          //return  $reviewlists;
        return view('reviews',compact('reviewlists'));
    }

   # client MyAccount
   # auth: vivek
    public function MyAccount(){
        $id = Auth::user()->id;
        $orderlist = Orders::with('users')
            ->where('user_id',$id)
            ->orderbydesc('id')
            ->first();

        $latestorder = [];
        $Orderhistory= [];
        if($orderlist) {
          $statusText =  match ((int)$orderlist->order_status) {
              1 => 'Processing',
              2 => 'Shipping',
              3 => 'Delivered',
              default => 'Unknown'
          };
            $latestorder[]=[
              'order_number' => $orderlist->order_number,
              'order_status' => $statusText,
              'order_date' => $orderlist->created_at->format('d-m-y'),
              'payment_method' => $orderlist->method
            ];
            $secondLatestOrder = Orders::with('users')
                  ->where('user_id', $id)
                  ->where('id', '<', $orderlist->id)
                  ->orderByDesc('id')
                  ->get();

          foreach($secondLatestOrder as $orderdeatils) {
             $statusTexts =  match ((int)$orderdeatils->order_status) {
              1 => 'Processing',
              2 => 'Shipping',
              3 => 'Delivered',
              default => 'Unknown'
            };
            $Orderhistory[]=[
              'order_number' => $orderdeatils->order_number,
              'order_status' => $statusTexts,
              'order_date' => $orderdeatils->created_at->format('d-m-y'),
              'payment_method' => $orderdeatils->method
            ];
          } 


          }   
         //return  $Orderhistory;
        return view('my-account',compact('latestorder','Orderhistory'));
    }

   # client MyAccount
   # auth: vivek
    public function Orderhistory(){
        $id = Auth::user()->id;
        $Orderhistory= [];
              $secondLatestOrder = Orders::with('users')
                  ->where('user_id', $id)
                  ->orderByDesc('id')
                  ->get();

          foreach($secondLatestOrder as $orderdeatils) {
             $statusTexts =  match ((int)$orderdeatils->order_status) {
              1 => 'Processing',
              2 => 'Shipping',
              3 => 'Delivered',
              default => 'Unknown'
            };
            $Orderhistory[]=[
              'order_number' => $orderdeatils->order_number,
              'order_status' => $statusTexts,
              'order_date' => $orderdeatils->created_at->format('d-m-y'),
              'payment_method' => $orderdeatils->method
            ]; 
          } 
        return view('order-history',compact('Orderhistory'));
    }

   # client MyAccount
   # auth: vivek
    public function MyWishlist(){
        $id = Auth::user()->id;
        $MyWishlist = Wishlist::leftJoin('product_details as pd', 'Wishlists.product_id', '=', 'pd.id')
                ->leftJoin('category as cat', 'pd.category_id', '=', 'cat.id')
                ->leftJoin(DB::raw('(SELECT * FROM product_gallery pg1 WHERE pg1.id = (SELECT MIN(id) FROM product_gallery WHERE product_id = pg1.product_id)) as pg'), 'Wishlists.product_id', '=', 'pg.product_id')
                ->where('user_id', $id)
                ->select(
                    'pd.id',
                    'Wishlists.id as ids',
                    'cat.name',
                    'pd.listing_name',
                    'pd.product_cost',
                    'pd.offer_price',
                    'pg.file'
                )
                ->get();

            $wishlistDeatils = [];
            foreach ($MyWishlist as $val) {
                $wishlistDeatils[] = [
                    'ids' => $val->ids,
                    'id' => $val->id,
                    'cat_name' => $val->name,
                    'product_name' => $val->listing_name,
                    'cost' => $val->product_cost,
                    'offer' => $val->offer_price,
                    'file' => $val->file,
                ];
            }
        //return $wishlistDeatils;
        return view('my-wishlist',compact('wishlistDeatils'));
    }

    # client ManageAddress
    # auth: vivek
    public function ManageAddress(){
        return view('manage-address');
    }

    # client ManageAddress
    # auth: vivek
    public function SupportCentre(){
        return view('support-centre');
    }

    #edit client
    #auth vivek
    public function EditProfile(){
      $id = Auth::user()->id;
      //return $id;
      $profileDeatils = User::where('id', $id)->first();
        return view('edit-profile',compact('profileDeatils'));
    
    }

    #update client
    #auth vivek
    public function update(Request $request){

    $user = Auth::user();

    $request->validate([
        'name' => 'required',
        //'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'required',
        // Add more fields if needed
    ]);
    $user->update([
        'name' => $request->name,
        'mobile' => $request->phone,
        // More fields...
    ]);

    return back()->with('success', 'Profile updated successfully.');
  }



  



}

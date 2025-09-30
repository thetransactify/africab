<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\cart_reminder;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\CartReminderMail;
use App\Mail\WhishlistReminderMail;
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;
use App\Models\SaveToLater;

class ReminderController extends Controller
{
    //
    #customercartreminder
    #auth vivek
    public function Getcartreminder(){
    	$Getcart = Cart::with(['product','User','cartsreminder'])->get();
        return view(' Admin.cart_reminder',compact('Getcart'));
    }

    #customer Orders list 
    #auth vivek
  public function fetchcartreminder(Request $request){
    $cartsreminder = Cart::with(['product:listing_name,id', 'User:name', 'cartsreminder:id,cart_id,sms_count,email_count'])
    ->where('product_id', $request->product_id)
    ->get()
    ->map(function($cart, $index) {
        return [
            'sno'            => $index + 1,
            'id'             => $cart->id ?? '',
            'ids'            => $cart->cartsreminder->id ?? '',
            'name'           => $cart->user->name?? 'Null',
            'product_name'   => $cart->product->listing_name,
            'sms_count'      => $cart->cartsreminder->sms_count ?? 0,
            'email_count'    => $cart->cartsreminder->email_count ?? 0,
            'created_at'     => $cart->created_at 
                                ? $cart->created_at->format('d-m-Y') 
                                : null,
        ];
    });

    if (!$cartsreminder) {
        return response()->json(['cartsreminder' => []]);
    }

    return response()->json(['cartsreminder' => $cartsreminder]);
}
    #customer Emailsend
    #auth vivek
    public function sendEmail(Request $request)
    {
        $cart = Cart::with('user', 'product')->find($request->product_id);
              if (!$cart || !$cart->user) {
            return response()->json(['message' => 'User or cart not found'], 404);
        }
        $reminder = cart_reminder::firstOrNew(
                [
                    'cart_id' => $cart->id,
                    'product_id' => $cart->product_id,
                    'user_id' => $cart->user_id,
                ]
            );
            if (!$reminder->exists) {
                $reminder->email_count = 0;
                $reminder->sms_count = 0;
            }
            $reminder->email_count += 1;
            $reminder->save();
		Mail::to($cart->user->email)->send(new CartReminderMail($cart->product));
        return response()->json(['message' => 'Email sent successfully']);
    }

    #customer Emailsend
    #auth vivek
    public function sendSms(Request $request){
        $cart = Cart::with('user', 'product')->find($request->product_id);

        if (!$cart || !$cart->user) {
            return response()->json(['message' => 'User or cart not found'], 404);
        }
        $reminder = CartReminder::updateOrCreate(
            [
                'cart_id' => $cart->id,
                'product_id' => $cart->product_id,
                'user_id' => $cart->user_id,
            ],
            [
                'email_count' => 0,
                'sms_count' => 1
            ]
        );
        if (!$reminder->wasRecentlyCreated) {
            $reminder->increment('sms_count');
        }
        $phone = $cart->user->phone ?? '91XXXXXXXXXX';
        $message = "Reminder: Your cart has product {$cart->product->listing_name}";
        return response()->json(['message' => 'SMS sent successfully']);
    }

    #customerwishlist
    #auth vivek
    public function sendEmails(Request $request){
    	$wishlists = Wishlist::with('users', 'product')->get();

    	if ($wishlists->isEmpty()) {
    		return response()->json([
    			'message' => 'No wishlist records found',
    			'count'   => 0
    		], 404);
    	}
    	$emails = $wishlists->pluck('users.email')->filter()->unique();

    	$sentCount = 0;

    	foreach ($emails as $email) {
    		Mail::to($email)->send(new WhishlistReminderMail(null, null));
    		$sentCount++;
    	}

    	return response()->json([
    		'message' => "Emails sent successfully",
    		'count'   => $sentCount
    	]);

    }

    #customerGetSaveToCart
    #auth vivek
    public function GetSaveToCart(){
         $GetSaveToCart = SaveToLater::with(['users','product'])->get();
        return view(' Admin.save_to_cart',compact('GetSaveToCart'));
    }

    #customerwishlist
    #auth vivek
    public function sendEmailSavecart(Request $request){
    	$wishlists = SaveToLater::with('users', 'product')->get();

    	if ($wishlists->isEmpty()) {
    		return response()->json([
    			'message' => 'No wishlist records found',
    			'count'   => 0
    		], 404);
    	}
    	$emails = $wishlists->pluck('users.email')->filter()->unique();

    	$sentCount = 0;

    	foreach ($emails as $email) {
    		Mail::to($email)->send(new WhishlistReminderMail(null, null));
    		$sentCount++;
    	}

    	return response()->json([
    		'message' => "Emails sent successfully",
    		'count'   => $sentCount
    	]);

    }


}

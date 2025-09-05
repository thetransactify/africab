<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\address;
use App\Models\Orders;
use App\Models\shop;
use App\Models\ProductPrice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;




class CartController extends Controller
{
    //
    # cart list view
    # auth: vivek
    public function GetCart() {
    	$id = Auth::user()->id;
    	$cartList = Cart::with([
		    'product',
		    'product.category',
		    'product.galleries'
		])->where('user_id', $id)
		->orderByDesc('id')
		->get();

		//return $cartList;
		$cartDetails = [];

		foreach ($cartList as $item) {
			$product = $item->product;
			if ($product) {
				$category = $product->category;
				$galleries = $product->galleries;
				$latestGallery = $galleries->sortByDesc('created_at')->first();
				$price = (float) $product->product_cost;
		        $quantity = (int) $item->quantity;
		        $total = $price * $quantity;

				$cartDetails[] = [
					'cart_id'       => crypt::encrypt($item->id),
					'product_id'    => $product->id,
					'product_name'  => $product->listing_name,
					'category_id'   => $category?->id,
					'category_name' => $category?->name,
					'category_file' => $category?->file,
					'price'         => $product->product_cost,
					'offer_price'   => $product->offer_price,
					'total'         => $total,
					'quantity'      => $item->quantity,
					'gallery_file'  => $latestGallery?->file,
				];
			}
			$subtotal = collect($cartDetails)->sum('total');
		}	
                    $subtotal = collect($cartDetails)->sum('total') ?? '';
		//return $subtotal;
        return view('add-to-cart',compact('cartDetails','subtotal'));
    }

    #delete cart
    #auth vivek
    public function destroy($id){
    $ids = crypt::decrypt($id);
    $cartItem = Cart::find($ids);
    if ($cartItem) {
        $cartItem->delete();
        return redirect()->back()->with('success', 'Cart item deleted successfully!');

    }
    return redirect()->back()->with('success', 'something wrong');
   }

   #add cart
   #auth vivek 
   public function CreateCart(Request $request) {
	$productId = $request->input('product_id'); 
	$priceIds = $request->input('priceId');
	$quantity = $request->input('quantity', 1);

	$userId = Auth::check() ? Auth::id() : null;
	$cartItem = Cart::where('product_id', $productId)
	                ->where('user_id', $userId)
	                ->first();

	if ($cartItem) {
    $cartItem->quantity += $quantity;
    $cartItem->save();
	} else {
	    Cart::create([
	        'user_id'    => $userId,
	        'product_id' => $productId,
	        'price'      => $priceIds,
	        'quantity'   => $quantity,
	    ]);
	}
    return response()->json(['success' => true, 'message' => 'Added to cart']);
   }

   # checkout 
   # auth  vivek 
   # cart list view
    # auth: vivek
    public function GetCheckout() {
    	$id = Auth::user()->id;
    	$cartList = Cart::with([
		    'product',
		    'product.category',
		    'product.galleries'
		])->where('user_id', $id)
		->orderByDesc('id')
		->get();
		$cartDetails = [];
		$subtotal = [];
		foreach ($cartList as $item) {
			$product = $item->product;
			if ($product) {
				$category = $product->category;
				$galleries = $product->galleries;
				$latestGallery = $galleries->sortByDesc('created_at')->first();
				$price = (float) $product->product_cost;
		        $quantity = (int) $item->quantity;
		        $total = $price * $quantity;

				$cartDetails[] = [
					'cart_id'       => crypt::encrypt($item->id),
					'product_id'    => $product->id,
					'product_name'  => $product->listing_name,
					'category_id'   => $category?->id,
					'category_name' => $category?->name,
					'category_file' => $category?->file,
					'price'         => $product->product_cost,
					'offer_price'   => $product->offer_price,
                    'color'         => explode(',', $product->color_name),
					'total'         => $total,
					'quantity'      => $item->quantity,
					'gallery_file'  => $latestGallery?->file,
				];
			}
			$subtotal = collect($cartDetails)->sum('total') ?? 'null';
		}
        //return $id;
        $addresslist = address::with('shippinglist')->orderByDesc('id')->where('user_id',$id)->get();
        //return  $addresslist;
        $addressDetails = [];
        if($addresslist){
           foreach ($addresslist as $value) {
           	$originalShippingPrice = $value->shippinglist->price ?? 0;
           	$finalShippingPrice = $subtotal > 100000 ? 0 : $originalShippingPrice;
            $addressDetails [] = [
            'id' => $value['id'] ?? '',
            'name' => $value['name'] ?? '',
            'label' => $value->label ?? '',
            'home_address' => $value->home_address ?? '',
            'office_address' => $value->office_address ?? '',
            'other_address' => $value->other_address ?? '',
            'mobile_no' => $value->mobile_no ?? '',
            'pincode' => $value->pincode ?? '',
            'price' => $finalShippingPrice ?? '0',
            'region_name' => $value->shippinglist->name ?? '',
            ];
           }
        }
        //return  $addressDetails;
        $shoplist = shop::orderByDesc('id')->get();
        $shopdeatils=[];
        foreach ($shoplist as $list) {
        	$shopdeatils[] = [
              'id' => $list->id,
              'name' => $list->name,
              'address' => $list->address,
        	];
        }
		//return $subtotal;
		//return $cartDetails;
        return view('checkout',compact('cartDetails','subtotal','addressDetails','shopdeatils','id'));
    }

    #add adsress
    #auth : vivek
   public function store(Request $request){
    $validated = $request->validate([
        'label' => 'required',
        'full_name' => 'required',
        'mobile' => 'nullable',
        'address' => 'required',
        'region' => 'required',
        'pincode' => 'required',
	    ]);
	    $data = [
	    'user_id' => auth()->id(),
	    'pincode' => $validated['pincode'],
	    'name' => $validated['full_name'],
	    'region_id' => $validated['region'],
	    'mobile_no' => $validated['mobile'],
	    'label' => $validated['label'],
		];

		switch ($validated['label']) {
		    case '1':
		        $data['home_address'] = $validated['address'];
		        break;
		    case '2':
		        $data['office_address'] = $validated['address'];
		        break;
		    case '3':
		        $data['other_address'] = $validated['address'];
		        break;
		}
		address::create($data);
	    return back()->with('success', 'Address added successfully.');
	}

  # delete adress
  # auth : vivek	
	public function DeleteAddress($encryptedId){
	    try {
	        $id = Crypt::decrypt($encryptedId);

	        $address = address::where('id', $id)->where('user_id', auth()->id())->first();

	        if (!$address) {
	            return redirect()->back()->with('error', 'Address not found or unauthorized.');
	        }

	        $address->delete();

	        return redirect()->back()->with('success', 'Address deleted successfully!');
	    } catch (\Exception $e) {
	        return redirect()->back()->with('error', 'Invalid or tampered ID.');
	    }
	}

  #cash on delivery
  #auth vivek
  public function codCheckout(Request $request)
    {
        //return $request->all();
    	 $request->validate([
        'billing_address' => 'required',
        'payment-method' => 'required',
    ]);
        $user = Auth::user();
       
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
        //return   $cartItems;
         $shippingCharge = $request->shipping_charge;

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }
        $orderGroupId = 'ORD' . strtoupper(uniqid());

        DB::beginTransaction();
        try {
            foreach ($cartItems as $index => $item) {
                Orders::create([
                    'user_id' => $user->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'order_group_id' => $orderGroupId,
                    'method' => '2',
                    'shipping_charge' => ($index === 0) ? $shippingCharge : 0,
                    'order_status' => '1',
                    'shipping_address' => $request->shiping_address,
                    'color' => $request->color,
                    'payment_status' => '1',
                    'order_number' => Str::random(14),
                    'billing_address' => $request->billing_address,
                    'shop_id' => $request->selected_shop,
                    'total_amount' => $item->product->product_cost * $item->quantity,
                ]);
            }
            Cart::where('user_id', $user->id)->delete();

            DB::commit();
            return redirect()->route('order.success')->with('success', 'Order placed successfully using Cash on Delivery!');
        } catch (ValidationException $e) {
            logger()->error('Validation failed', $e->errors());
          return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

   # order status
   # auth: vivek
    public function orderStatus(){
    	$user = Auth::user();
    	$OrderItems = Orders::where('user_id', $user->id)->orderByDesc('id')->first();
    	return view('thankyou',compact('OrderItems'));
    }	

}	

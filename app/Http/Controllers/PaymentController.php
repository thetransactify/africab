<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Review;
use App\Models\Orders;
use App\Models\Cart;
use App\Models\address;

class PaymentController extends Controller
{
    # checkout
    # vivek yadav

    private $vendor;
    private $apiKeyRaw;
    private $secretKey;
    private $url;

    public function __construct()
    {
        $this->vendor     = config('services.selcom.vendor_id');
        $this->apiKeyRaw     = config('services.selcom.api_key');
        $this->apiSecret  = config('services.selcom.secret_key');
        $this->url         = "https://apigw.selcommobile.com/v1/checkout/create-order";
    }


    // private $vendor      = "config('services.selcom.vendor_id')";
    // private $apiKeyRaw   = "config('services.selcom.api_key')";
    // private $apiSecret   = "config('services.selcom.api_secret')";
    // private $url         = "config('services.selcom.url')";
    // private $baseUrl     = "https://apigw.selcommobile.com/v1/checkout/create-order";
    private $caCertPath  = "C:\\Users\\vivek kumar yadav\\Downloads\\cacert.pem"; // local path to cacert.pem

public function createOrderSelcomking(Request $request)
    {
        $apiKey = base64_encode($this->apiKeyRaw);
        $timestamp = now()->format('Y-m-d\TH:i:sP');
        $fields = [
            'vendor'             => $this->vendor,
            'order_id'           => 'ORD' . time(),
            'buyer_email'        => 'john@example.com',
            'buyer_name'         => 'John Doe',
            'buyer_phone'        => '255774786247',
            'amount'             => '1000',
            'currency'           => 'TZS',
            'payment_methods'    => 'ALL',
             'billing' => [
                'firstname' => 'John',
                'lastname'  => 'Doe',
                'phone'     => '+255700000000',
                'address_1'   => '123 Street Name',
                'city'      => 'Dar es Salaam',
                'country'   => 'TZ'
            ],
            'gateway_buyer_uuid' => '',
            'cancel_url'         => 'aHR0cHM6Ly9zaG9wLmFmcmljYWIuY28udHovcGcvDDDSDc2VsY29tLWFwaWd3LDHSHDSWNsaWVudC9jYW5jZWwtcGF5LnBocD9vaWQ9b2lkLTE2ODg0MDQzMzg=',
            'webhook'            => 'aHR0cHM6Ly9zaG9wLmFmcmljYWIuY28udHovcGcvcSSDSD2VsY29tLWFwaWd3LWDGSGNsaWVudC90aGFuay15b3UucGhwP29pZD1vaWQtMTY4ODQwNDMzOA==',
            'redirect_url'      => 'aHR0cHM6Ly9zaG9wLmFmcmljYWIuY2DDSD8udHovcGcvc2VsY29tLWFwaWd3LHSHHSWNsaWVudC90aGFuay15b3UucGhwP29pZD1vaWQtMTY4ODQwNDMzOA==',
            'buyer_remarks'      => 'None',
            'merchant_remarks'   => 'None',
            'no_of_items'        => '1'
        ];

        // Signed-Fields must match order exactly as per API docs
        $signedFields = [
            'vendor',
            'order_id',
            'buyer_email',
            'buyer_name',
            'buyer_phone',
            'amount',
            'currency',
            'payment_methods',
            'gateway_buyer_uuid',
            'redirect_url',
            'cancel_url',
            'webhook',
            'buyer_remarks',
            'merchant_remarks',
            'no_of_items'
        ];

        // Build string for digest – starts with timestamp
        $digestParts = ["timestamp={$timestamp}"];
        foreach ($signedFields as $key) {
            $digestParts[] = "{$key}={$fields[$key]}";
        }
        $digestString = implode('&', $digestParts);

        // Log for debugging
        Log::info('DigestString: ' . $digestString);

        // Generate digest (HMAC-SHA256 + Base64)
        $digest = base64_encode(hash_hmac('sha256', $digestString, $this->apiSecret, true));
        Log::info('Digest: ' . $digest);

        // Headers
        $headers = [
            'Authorization'  => "SELCOM {$apiKey}",
            'Digest-Method'  => 'HS256',
            'Digest'         => $digest,
            'Signed-Fields'  => implode(',', $signedFields),
            'Timestamp'      => $timestamp,
            'Content-Type'   => 'application/json',
            'Accept'         => 'application/json',
        ];

        // Guzzle with SSL verify
        $client = new Client(['verify' => $this->caCertPath]);

        try {
            $res = $client->post($this->url, [
                'headers' => $headers,
                'json'    => $fields
            ]);

            $body = json_decode($res->getBody(), true);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'status'     => 'success',
            'digestString' => $digestString,
            'digestValue'  => $digest,
            'selcom_response' => $body
        ]);
    }

    public function createOrderselcom(Request $request)
{
    $id          = Crypt::decrypt($request->user_id);
    $billing_id  = $request->billing_address;
    $shippingCharge = $request->shipping_charge;

    // Fetch cart items
    $cartItems = Cart::with('product')->where('user_id', $id)->get();
    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    // Fetch user details
    $userDetails = User::find($id);
    if (!$userDetails) {
        return redirect()->back()->with('error', 'User not found.');
    }

    // Fetch billing address
    $UserBilling = Address::with('shippinglist')
        ->where('user_id', $id)
        ->where('id', $billing_id)
        ->first();

    if (!$UserBilling) {
        return redirect()->back()->with('error', 'Billing address not found.');
    }

    $billingAddress = $UserBilling->office_address ?? $UserBilling->other_address ?? $UserBilling->home_address;
    $cityName = $UserBilling->shippinglist->name ?? '';

    // Prepare API fields
    $apiKey    = base64_encode($this->apiKeyRaw);
    $timestamp = now()->format('Y-m-d\TH:i:sP');

    $fields = [
        'vendor'          => $this->vendor,
        'order_id'        => 'ORD' . time(),
        'buyer_email'     => $userDetails->email,
        'buyer_name'      => $userDetails->name,
        'buyer_phone'     => $userDetails->mobile,
        'amount'          => $request->total_ammount,
        'currency'        => 'TZS',
        'payment_methods' => 'ALL',
        'billing' => [
            'firstname' => $userDetails->name,
            'lastname'  => $userDetails->name,
            'phone'     => $userDetails->mobile,
            'address_1' => $billingAddress,
            'city'      => $cityName,
            'country'   => 'TZ',
        ],
        'gateway_buyer_uuid' => '',
        'cancel_url'         => 'aHR0cHM6Ly9leGFtcGxlLmNvbS9jYW5jZWw=',
        'webhook'            => 'aHR0cHM6Ly9leGFtcGxlLmNvbS93ZWJob29r',
        'redirect_url'       => 'aHR0cHM6Ly9leGFtcGxlLmNvbS93ZWJob29r',
        'buyer_remarks'      => 'None',
        'merchant_remarks'   => 'None',
        'no_of_items'        => '1',
    ];

    $signedFields = [
        'vendor',
        'order_id',
        'buyer_email',
        'buyer_name',
        'buyer_phone',
        'amount',
        'currency',
        'payment_methods',
        'gateway_buyer_uuid',
        'redirect_url',
        'cancel_url',
        'webhook',
        'buyer_remarks',
        'merchant_remarks',
        'no_of_items',
    ];

    // Generate digest
    $digestParts = ["timestamp={$timestamp}"];
        foreach ($signedFields as $key) {
            $digestParts[] = "{$key}={$fields[$key]}";
        }
        $digestString = implode('&', $digestParts);

        // Log for debugging
        Log::info('DigestString: ' . $digestString);

        // Generate digest (HMAC-SHA256 + Base64)
        $digest = base64_encode(hash_hmac('sha256', $digestString, $this->apiSecret, true));
        Log::info('Digest: ' . $digest);

    // Debug logs
    Log::info('Selcom Digest String:', [$digestString]);
    Log::info('Selcom Digest:', [$digest]);
    Log::info('Signed Fields:', $signedFields);
    Log::info('Fields Sent to Selcom:', $fields);

    $headers = [
        'Authorization'  => "SELCOM {$apiKey}",
        'Digest-Method'  => 'HS256',
        'Digest'         => $digest,
        'Signed-Fields'  => implode(',', $signedFields),
        'Timestamp'      => $timestamp,
        'Content-Type'   => 'application/json',
        'Accept'         => 'application/json',
    ];

    // $client = new \GuzzleHttp\Client();
     $client = new Client(['verify' => $this->caCertPath]);


    try {
        $response = $client->post('https://apigw.selcommobile.com/v1/checkout/create-order', [
            'headers' => $headers,
            'json'    => $fields,
            'allow_redirects' => false // helpful for debugging
        ]);

        $body = json_decode($response->getBody(), true);
        Log::info('Selcom Response:', $body);

        $encodedUrl   = $body['data'][0]['payment_gateway_url'] ?? null;
        $paymentToken = $body['data'][0]['payment_token'] ?? null;
        $orderRef     = $body['reference'] ?? null;

        if (empty($encodedUrl)) {
            return redirect()->back()->with('error', 'Failed to generate payment URL.');
        }

        $paymentUrl   = base64_decode($encodedUrl);
        $orderGroupId = 'ORD' . strtoupper(uniqid());

        // Insert orders in DB
        DB::beginTransaction();
        try {
            foreach ($cartItems as $index => $item) {
                Orders::create([
                    'user_id'         => $id,
                    'product_id'      => $item->product_id,
                    'quantity'        => $item->quantity,
                    'order_group_id'  => $orderGroupId,
                    'method'          => '1',
                    'shipping_charge' => ($index === 0) ? $shippingCharge : 0,
                    'order_status'    => '1',
                    'shipping_address'=> $request->shiping_address,
                    'color'           => $request->color,
                    'payment_status'  => '1',
                    'payment_token'   => $paymentToken,
                    'order_number'    => $orderRef,
                    'billing_address' => $billing_id,
                    'total_amount'    => $item->product->product_cost * $item->quantity,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('DB Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to save order in database.');
        }

        return redirect()->route('payment.page', [
            'order_id'    => Crypt::encrypt($orderGroupId),
            'payment_url' => urlencode($paymentUrl)
        ]);

    } catch (\Exception $e) {
        Log::error('Selcom API Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Payment gateway error: ' . $e->getMessage());
    }
}




    public function createOrderselcomsss(Request $request){
    	return $this->url;
    	exit();

        $id = Crypt::decrypt($request->user_id);
        $billing_id = $request->billing_address;
        

    	$cartItems = Cart::with('product')->where('user_id', $id)->get();
    	$shippingCharge = $request->shipping_charge;

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $userDeatils = User::find($id);

        // if ($userDeatils->isEmpty()) {
        //     return redirect()->back()->with('error', 'User email not found.');
        // }

        $UserBilling = address::with(['shippinglist'])->where('user_id', $id)->where('id',$billing_id)->get();
        $UserBillingDeatils = [];
        //return $UserBilling;

        foreach ($UserBilling as $value) {
        	$UserBillingDeatils[] = [
             'billing_address' => $value->office_address ?? $value->other_address ?? $value->home_address,
             'name'  => $value->name,
             'mobile_no'  => $value->mobile_no,
             'city_name' => $value->shippinglist->name,
        	];
        }
       //return $UserBillingDeatils;

        // if ($UserBilling->isEmpty()) {
        //     return redirect()->back()->with('error', 'User email not found.');
        // }

         // return $UserBillingDeatils[0]['billing_address'];
         // return $request->all();



    $apiKey = base64_encode($this->apiKeyRaw);

    $timestamp = now()->format('Y-m-d\TH:i:sP');

    $fields = [
        'vendor'             => $this->vendor,
        'order_id'           => 'ORD' . time(),
        'buyer_email'        => $userDeatils->email,
        'buyer_name'         =>  $userDeatils->name,
        'buyer_phone'        =>  $userDeatils->mobile,
        'amount'             => $request->total_ammount,
        'currency'           => 'TZS',
        'payment_methods'    => 'ALL',
         'billing' => [
                'firstname' => $userDeatils->name,
                'lastname'  => $userDeatils->name,
                'phone'     => $userDeatils->mobile,
                'address_1'   => $UserBillingDeatils[0]['billing_address'],
                'city'      => $UserBillingDeatils[0]['city_name'],
                'country'   => $UserBillingDeatils[0]['billing_address']
            ],
        'gateway_buyer_uuid' => '',
        'cancel_url'         => 'aHR0cHM6Ly9leGFtcGxlLmNvbS9jYW5jZWw=',
        'webhook'            => 'aHR0cHM6Ly9leGFtcGxlLmNvbS93ZWJob29r',
        'redirect_url'       =>  route('payment.callback'),
        'buyer_remarks'      => 'None',
        'merchant_remarks'   => 'None',
        'no_of_items'        => '1'
    ];

    $signedFields = [
        'vendor',
        'order_id',
        'buyer_email',
        'buyer_name',
        'buyer_phone',
        'amount',
        'currency',
        'payment_methods',
        'gateway_buyer_uuid',
        'redirect_url',
        'cancel_url',
        'webhook',
        'buyer_remarks',
        'merchant_remarks',
        'no_of_items'
    ];

    $digestParts = ["timestamp={$timestamp}"];
    foreach ($signedFields as $key) {
        $digestParts[] = "{$key}={$fields[$key]}";
    }
    $digestString = implode('&', $digestParts);

    Log::info('DigestString: ' . $digestString);

    $digest = base64_encode(hash_hmac('sha256', $digestString, $this->secretKey, true));
    Log::info('Digest: ' . $digest);

    $headers = [
        'Authorization'  => "SELCOM {$apiKey}",
        'Digest-Method'  => 'HS256',
        'Digest'         => $digest,
        'Signed-Fields'  => implode(',', $signedFields),
        'Timestamp'      => $timestamp,
        'Content-Type'   => 'application/json',
        'Accept'         => 'application/json',
    ];

    $client = new Client();

    try {
        $res = $client->post($this->url . '/v1/checkout/create-order', [
            'headers' => $headers,
            'json'    => $fields
        ]);

        $body = json_decode($res->getBody(), true);

        $encodedUrl  = $body['data'][0]['payment_gateway_url'] ?? null;
        $orderGroupId = 'ORD' . strtoupper(uniqid());

		if (!empty($encodedUrl)) {
		    $paymentUrl = base64_decode($encodedUrl);
		    DB::beginTransaction();
		    foreach ($cartItems as $index => $item) {
                Orders::create([
                    'user_id' => $id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'order_group_id' => $orderGroupId,
                    'method' => '1',
                    'shipping_charge' => ($index === 0) ? $shippingCharge : 0,
                    'order_status' => '1',
                    'shipping_address' => $request->shiping_address,
                    'color' => $request->color,
                    'payment_status' => '1',
                    'payment_token' => $body['data'][0]['payment_token'] ?? null,
                    'order_number' => $body['reference'],
                    'billing_address' => $request->billing_address,
                    'total_amount' => $item->product->product_cost * $item->quantity,
                ]);
            }
            DB::commit();

		return redirect()->route('payment.page', [
            'order_id' => Crypt::encrypt($orderGroupId),
            'payment_url' => urlencode($paymentUrl)
        ]);

		}


    } catch (\Exception $e) {
        return response()->json([
            'status'  => 'error',
            'message' => $e->getMessage()
        ]);

    }
}  

  #payment route
  #auth vivek yadav
  public function paymentPage(Request $request){
  	Log::info("payment page: ", $request->all());
    $order = Orders::findOrFail($request->order_id);
    $paymentUrl = $request->payment_url;

    return view('payment_page', compact('order', 'paymentUrl'));
  }

  #payment cancel
  #auth vivek yadav
  public function cancelPayment() {
  	Log::info("Selcom Cancel: ", $request->all());
  	$orderIds = Crypt::decrypt($orderId);
    $order = Orders::findOrFail($orderIds);

    $order->update(['payment_status' => '3']);

    return redirect()->route('order.success')
                     ->with('error', 'Payment cancelled.');
  }

  #payment Callback
  #auth vivek yadav
  public function paymentCallback(Request $request){
    $order = Orders::where('payment_token', $request->payment_token)->first();
    if (!$order) {
        return response()->json(['error' => 'Order not found'], 404);
    }

    if ($request->resultcode === "000") {

        $order->update(['payment_status' => '2']);
    } else {
        $order->update(['status' => 'failed']);
    }

    return response()->json(['status' => 'ok']);
}




}

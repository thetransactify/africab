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
        $this->apiSecret  = "0001BE12-0011AC1C-000383DB-00052C80";
        $this->url         = "https://apigw.selcommobile.com/v1/checkout/create-order";
    }

    
public function createOrderselcom(Request $request){
    $id          = Crypt::decrypt($request->user_id);
    $billing_id  = $request->billing_address;
    $shippingCharge = $request->shipping_charge;

    $cartItems = Cart::with('product')->where('user_id', $id)->get();
    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    $userDetails = User::find($id);
    if (!$userDetails) {
        return redirect()->back()->with('error', 'User not found.');
    }

    $UserBilling = Address::with('shippinglist')
        ->where('user_id', $id)
        ->where('id', $billing_id)
        ->first();

    if (!$UserBilling) {
        return redirect()->back()->with('error', 'Billing address not found.');
    }

    $billingAddress = $UserBilling->office_address ?? $UserBilling->other_address ?? $UserBilling->home_address;
    $cityName = $UserBilling->shippinglist->name ?? '';

    $orderGroupId = 'ORD' . time(); 

    $cancelUrl = route('payment.cancel', ['order' => Crypt::encrypt($orderGroupId)]); 
    $successUrl = route('payment.page', ['order' => Crypt::encrypt($orderGroupId)]);
    $webhookUrl = route('payment.callback');

    $payload = [
        'vendor' => $this->vendor,
        'order_id' => $orderGroupId,
        'buyer_email' => $userDetails->email,
        'buyer_name' => $userDetails->name,
        'buyer_phone' => $userDetails->mobile,
        'amount' => (string)$request->total_ammount,
        'currency' => 'TZS',
        'payment_methods' => 'ALL',
        
        'billing.firstname' => $userDetails->name,
        'billing.lastname' => $userDetails->name,
        'billing.address_1' => $billingAddress,
        'billing.address_2' => '',
        'billing.city' => $cityName,
        'billing.state_or_region' => 'DSM',
        'billing.country' => 'TZ',
        'billing.phone' => $userDetails->mobile,

        'gateway_buyer_uuid' => '',
        'cancel_url' => base64_encode($cancelUrl),
        'webhook' => base64_encode($webhookUrl),
        'redirect_url' => base64_encode($successUrl),
        'buyer_remarks' => 'Testing order',
        'merchant_remarks' => 'Laravel Test Order',
        'no_of_items' => (string)count($cartItems), 
    ];

    $signedFields = "vendor,order_id,buyer_email,buyer_name,buyer_phone,amount,currency,payment_methods,billing.firstname,billing.lastname,billing.address_1,billing.address_2,billing.city,billing.state_or_region,billing.country,billing.phone,gateway_buyer_uuid,cancel_url,webhook,redirect_url,buyer_remarks,merchant_remarks,no_of_items";

    $timestamp = now('+03:00')->format('Y-m-d\TH:i:sP');
    $fields = explode(',', $signedFields);
    $signString = "timestamp=" . $timestamp;
    foreach ($fields as $field) {
        $value = $payload[$field] ?? '';
        $signString .= "&" . $field . "=" . $value;
    }

    Log::info('=== SELCOM AUTH DEBUG ===');
    Log::info('API Key Raw: ' . $this->apiKeyRaw);
    Log::info('API Secret: ' . $this->apiSecret);
    Log::info('Vendor: ' . $this->vendor);
    Log::info('Timestamp: ' . $timestamp);
    Log::info('Signature String: ' . $signString);
    Log::info('Signature String Length: ' . strlen($signString));
    
    $digest = base64_encode(hash_hmac('sha256', $signString, $this->apiSecret, true));
    
    Log::info('Generated Digest: ' . $digest);
    Log::info('Signed Fields: ' . $signedFields);
    Log::info('Payload: ' . json_encode($payload, JSON_PRETTY_PRINT));

    $headers = [
        "Authorization" => "SELCOM " . base64_encode($this->apiKeyRaw),
        "Digest-Method" => "HS256",
        "Digest" => $digest,
        "Timestamp" => $timestamp,
        "Signed-Fields" => $signedFields,
        "Content-Type" => "application/json",
        "Accept" => "application/json",
    ];

    Log::info('Headers: ' . json_encode($headers, JSON_PRETTY_PRINT));

    $client = new Client(['verify' => false]);

    try {
        $response = $client->post('https://apigw.selcommobile.com/v1/checkout/create-order', [
            'headers' => $headers,
            'json' => $payload,
            'allow_redirects' => false,
            'timeout' => 30,
        ]);

        $body = json_decode($response->getBody(), true);
        Log::info('Selcom Success Response:', $body);

        $encodedUrl = $body['data'][0]['payment_gateway_url'] ?? null;
        $paymentToken = $body['data'][0]['payment_token'] ?? null;
        $orderRef = $body['reference'] ?? null;

        if (empty($encodedUrl)) {
            return redirect()->back()->with('error', 'Failed to generate payment URL.');
        }

        $paymentUrl = base64_decode($encodedUrl);

        DB::beginTransaction();
        try {
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
                    'payment_token' => $paymentToken,
                    'order_number' => $orderRef,
                    'billing_address' => $billing_id,
                    'total_amount' => $item->product->product_cost * $item->quantity,
                ]);
            }
            DB::commit();
Log::info('Final Payment URL: ' . $paymentUrl);
Log::info('URL Length: ' . strlen($paymentUrl));
return redirect()->away($paymentUrl, 302, [], false);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('DB Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to save order in database.');
        }

Log::info('Final Payment URL: ' . $paymentUrl);
Log::info('URL Length: ' . strlen($paymentUrl));
return redirect()->away($paymentUrl, 302, [], false);
    } catch (\Exception $e) {
        Log::error('Selcom API Error: ' . $e->getMessage());
        if (method_exists($e, 'getResponse') && $e->getResponse()) {
            $errorResponse = $e->getResponse()->getBody();
            Log::error('Selcom API Error Response: ' . $errorResponse);
        }
        return redirect()->back()->with('error', 'Payment gateway error: Please check your API credentials and try again.');
    }
}

  

  #payment route
  #auth vivek yadav
  public function paymentPage($order){
    $orderIds = Crypt::decrypt($order);
        Log::info("Selcom sucess Received", [
            'encrypted_order' => $order,
            'decrypted_order' => $orderIds
        ]);
    $orders = Orders::where('order_group_id', $orderIds)->get();
    if ($orders->isEmpty()) {
        Log::error("No orders found with this group ID", ['order_group_id' => $orderIds]);
        return redirect()->route('checkout.get')->with('error', 'Order not found.');
    }
    $userId = $orders->first()->user_id;
    $cartDeleted = Cart::where('user_id', $userId)->delete();
     Orders::where('order_group_id', $orderIds)
          ->update([
            'payment_status' => '2',
            'order_status' => '1'
        ]);

    return redirect()->route('order.success')
                     ->with('success', 'Payment Success.');
  }

  #payment cancel
  #auth vivek yadav
  public function cancelPayment($order) {
    $orderIds = Crypt::decrypt($order);
        Log::info("Selcom Cancel Request Received", [
            'encrypted_order' => $order,
            'decrypted_order' => $orderIds
        ]);
     $updatedCount = Orders::where('order_group_id', $orderIds)
                            ->update([
                                'payment_status' => '3',
                                'order_status' => '0'
                            ]);
     return redirect()->route('checkout.get')->with('error', 'Payment was cancelled.');
  }

  #payment Callback
  #auth vivek yadav
  public function paymentCallback(Request $request){
    try {
        Log::info("Selcom Webhook Received", $request->all());
        $transactionId = $request->input('transid');
        $orderId = $request->input('order_id');
        $resultCode = $request->input('resultcode');
        $status = $request->input('result');
        $reference = $request->input('reference');
        $paymentToken = $request->input('payment_token');

        Log::info("Webhook Processing", [
            'order_id' => $orderId,
            'result_code' => $resultCode,
            'status' => $status,
            'transaction_id' => $transactionId,
            'payment_token' => $paymentToken
        ]);

        if (empty($orderId)) {
            Log::error("Webhook missing order_id", $request->all());
            return response()->json(['error' => 'Order ID missing'], 400);
        }
        $orders = Orders::where('order_group_id', $orderId)->get();

        if ($orders->isEmpty()) {
            Log::error("No orders found for webhook", ['order_id' => $orderId]);
            return response()->json(['error' => 'Order not found'], 404);
        }
        if ($resultCode === "000" || $status === "SUCCESS") {
            $updatedCount = Orders::where('order_group_id', $orderId)
            ->update([
                'payment_status' => '2',
                'order_status' => '1',
                'transaction_id' => $transactionId,
                'payment_reference' => $reference
            ]);
            $userId = $orders->first()->user_id;
            Cart::where('user_id', $userId)->delete();

            Log::info("Webhook - Payment Success", [
                'order_id' => $orderId,
                'updated_orders' => $updatedCount,
                'user_id' => $userId,
                'transaction_id' => $transactionId
            ]);

        } else {
            $updatedCount = Orders::where('order_group_id', $orderId)
            ->update([
                'payment_status' => '3',
                'order_status' => '0',
                'transaction_id' => $transactionId
            ]);

            Log::warning("Webhook - Payment Failed", [
                'order_id' => $orderId,
                'result_code' => $resultCode,
                'status' => $status,
                'updated_orders' => $updatedCount
            ]);
        }
        return response()->json(['status' => 'success']);
    } catch (\Exception $e) {
        Log::error('Webhook processing error', [
            'error' => $e->getMessage(),
            'request_data' => $request->all()
        ]);
        return response()->json(['error' => 'Processing failed'], 500);
    }
}

}

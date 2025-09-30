<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Review;
use App\Models\Orders;
use App\Models\Wishlist;
use App\Models\address;
use App\Models\faqs;
use App\Models\ProductPrice;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Google_Client;
use Google_Service_Sheets;
use GuzzleHttp\Client as GuzzleClient;





class ClientController extends Controller
{
    //
    # admin reviewlist
    # auth: vivek
    public function ShowReview(){
    	$reviewlist = Review::with(['Product','users'])->where('status',1)->get();
      //return $reviewlist;
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
	        'product_name' => $review->product->listing_name,
	        'rating' => $review->rating,
	        'comment' => $review->comment
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
              'order_date' => $orderdeatils->created_at->format('d-m-y') ?? '',
              'payment_method' => $orderdeatils->method
            ];
          } 


          }   
        // return  $Orderhistory;
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
              'id'           => $orderdeatils->id,
              'order_number' => $orderdeatils->order_number,
              'order_status' => $statusTexts,
              'payment'     =>  $orderdeatils->payment_status == 1  ? 'Pending' : ($orderdeatils->payment_status == 2 ? 'Paid'  : ($orderdeatils->payment_status == 3  ? 'Failed' : 'Unknown')), 
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
        $MyWishlist = Wishlist::leftJoin('product_details as pd', 'wishlists.product_id', '=', 'pd.id')
                ->leftJoin('category as cat', 'pd.category_id', '=', 'cat.id')
                ->leftJoin(DB::raw('(SELECT * FROM product_gallery pg1 WHERE pg1.id = (SELECT MIN(id) FROM product_gallery WHERE product_id = pg1.product_id)) as pg'), 'wishlists.product_id', '=', 'pg.product_id')
                ->where('user_id', $id)
                ->select(
                    'pd.id',
                    'wishlists.id as ids',
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
        $id = Auth::user()->id;
        //return $id;
        $addresslist = address::orderByDesc('id')->where('user_id',$id)->get();
        $addressDetails = [];
        if($addresslist){
           foreach ($addresslist as $value) {
            $addressDetails [] = [
            'id' => $value['id'] ?? '',
            'name' => $value['name'] ?? '',
            'label' => $value->label ?? '',
            'home_address' => $value->home_address ?? '',
            'office_address' => $value->office_address ?? '',
            'other_address' => $value->other_address ?? '',
            'mobile_no' => $value->mobile_no ?? '',
            'pincode' => $value->pincode ?? '',
            ];
           }
        }
        return view('manage-address',compact('addressDetails'));
    }

    # client ManageAddress
    # auth: vivek
    public function SupportCentre(){
         $faqs = faqs::orderbydesc('id')->get();
        return view('support-centre',compact('faqs'));
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


  # client reviewlist
  # auth: vivek
    public function AddReviews(Request $request){
     // return $request;
        $request->validate([
        'product_price_id' => 'required',
        'rating' => 'required',
        'review' => 'required',
        'user_id' => 'required'
    ]);
     Review::create([
        'user_id' => $request->user_id,
        'product_id' => $request->product_price_id,
        'rating' => $request->rating,
        'comment' => $request->review,
        'status' => 1, 
    ]);

    return redirect()->back()->with('success', 'Review submitted for approval.');    
    }

  #offer list
  #auth vivek

   public function OffersDatils(){
    
       return view('offers');
   }





    private $vendor      = "config('services.selcom.vendor_id')";
    private $apiKeyRaw   = "config('services.selcom.api_key')";
    private $apiSecret   = "config('services.selcom.api_secret')";
    private $url         = "config('services.selcom.url')";
    private $baseUrl     = "https://apigw.selcommobile.com/v1/checkout/create-order";
    private $caCertPath  = "C:\\Users\\vivek kumar yadav\\Downloads\\cacert.pem"; // local path to cacert.pem

public function createOrderSelcoms(Request $request)
    {
        $apiKey = base64_encode($this->apiKeyRaw);
        $timestamp = now()->format('Y-m-d\TH:i:sP');
        $fields = [
            'vendor'             => $vendor,
            'order_id'           => 'ORD' . time(),
            'buyer_email'        => 'john@example.com',
            'buyer_name'         => 'John Doe',
            'buyer_phone'        => '255774786247',
            'amount'             => '1000',
            'currency'           => 'TZS',
            'payment_methods'    => 'ALL',
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
            $res = $client->post($url, [
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


    # admin reviewlist
    # auth: vivek
    public function privacyPolicy(){
      return view('privacy-policy');
    }

    #admin ExcelSheet
    #auth: vivek
    public function getExcelSheet(){
      return view(' Admin.ExcelSync');
    }

    #admin ExcelSheet 1st
    #auth: vivek
    public function FirstExcelSheet(){
        try {
            $credentialsPath = storage_path('app/google/projecttesting-473205-eaaed6001bfc.json');

             $client = new \Google_Client();
            $client->setAuthConfig($credentialsPath);
            $client->addScope(\Google_Service_Sheets::SPREADSHEETS_READONLY);

            $httpClient = new \GuzzleHttp\Client(['verify' => false]);
            $client->setHttpClient($httpClient);

            $service = new \Google_Service_Sheets($client);
            $spreadsheetId = env('GOOGLE_SHEET_ID');
            $spreadsheet = $service->spreadsheets->get($spreadsheetId);
            $sheetNames = [];
            foreach ($spreadsheet->getSheets() as $sheet) {
                $sheetNames[] = $sheet->getProperties()->getTitle();
            }
            foreach ($sheetNames as $sheetName) {
                $range = $sheetName;
                $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                $values = $response->getValues();
                if (empty($values)) continue;
                $headers = $values[0];
                $codeIndex  = array_search('CODE', $headers);
                $priceIndex = array_search('PRICE', $headers);

                if ($codeIndex === false || $priceIndex === false) continue;

                foreach ($values as $index => $row) {
                    if ($index === 0) continue;
                    $code  = $row[$codeIndex] ?? null;
                    $price = $row[$priceIndex] ?? null;

                    if ($code && $price) {
                        ProductPrice::where('code', $code)
                            ->where(function($q){
                                $q->whereNull('product_cost')
                                  ->orWhere('product_cost', '');
                            })
                            ->update(['product_cost' => $price]);
                    }
                }
            }

          
          return redirect()->back()->with('success', "Sync completed successfully.");

        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

        #admin ExcelSheet 1st
    #auth: vivek
    public function SecondExcelSheet(){
        try {
            $credentialsPath = storage_path('app/google/projecttesting-473205-eaaed6001bfc.json');

             $client = new \Google_Client();
            $client->setAuthConfig($credentialsPath);
            $client->addScope(\Google_Service_Sheets::SPREADSHEETS_READONLY);

            $httpClient = new \GuzzleHttp\Client(['verify' => false]);
            $client->setHttpClient($httpClient);

            $service = new \Google_Service_Sheets($client);
            $spreadsheetId = env('GOOGLE_SHEET_ID1');
            $spreadsheet = $service->spreadsheets->get($spreadsheetId);
            $sheetNames = [];
            foreach ($spreadsheet->getSheets() as $sheet) {
                $sheetNames[] = $sheet->getProperties()->getTitle();
            }
            foreach ($sheetNames as $sheetName) {
                $range = $sheetName;
                $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                $values = $response->getValues();
                if (empty($values)) continue;
                $headers = $values[0];
                $codeIndex  = array_search('CODE', $headers);
                $priceIndex = array_search('PRICE', $headers);

                if ($codeIndex === false || $priceIndex === false) continue;

                foreach ($values as $index => $row) {
                    if ($index === 0) continue;
                    $code  = $row[$codeIndex] ?? null;
                    $price = $row[$priceIndex] ?? null;

                    if ($code && $price) {
                        ProductPrice::where('code', $code)
                            ->where(function($q){
                                $q->whereNull('product_cost')
                                  ->orWhere('product_cost', '');
                            })
                            ->update(['product_cost' => $price]);
                    }
                }
            }

          return redirect()->back()->with('success', "Sync completed successfully.");

        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }



}

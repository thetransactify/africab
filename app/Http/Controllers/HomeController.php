<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Homeslider;
use App\Models\advertisement;
use App\Models\Brand;
use App\Models\faqs;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\ProductPrice;
use App\Models\Orders;
use App\Models\Review;

class HomeController extends Controller
{
    #view CreateHomepage
    #authr: vivek
    public function GetHomepage(){
    	$Homeslider = Homeslider::orderbydesc('id')->get();
    	return view('Admin.home',compact('Homeslider'));
    }


    #Add CreateHomepage
    #authr: vivek
    public function CreateHomepage(Request $request){
    	//return $request->all();
    	$request->validate([
		    'banner' => 'required',
		    'Category_file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
		]);
         $homepage = new Homeslider();
            $homepage->banner = $request->input('banner');
            if ($request->hasFile('Category_file')) {
                $image = $request->file('Category_file');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('uploads/Home', $imageName, 'public');
                $homepage->file = $imageName;  
            }

            $homepage->save();
        return redirect()->back()->with('success', 'Home Silder added successfully!');
    }

    #soft delete reviews list
    #authr: vivek
    public function Deletehomepage($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $homepage = Homeslider::findOrFail($decryptedId);
            $homepage->delete();

            return redirect()->back()->with('success', 'Home silder deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }

    #view Getbrand
    #authr: vivek
    public function Getbrand(){
    	$getbrand = Brand::orderbydesc('id')->get();
    	return view(' Admin.product_brand',compact('getbrand'));
    }

     #Add CreateHomepage
    #authr: vivek
    public function CreateBrand(Request $request){
    	//return $request->all();
    	$request->validate([
		    'brand_name' => 'required',
		    'Description' => 'required',
		    'Category_file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
		]);
         $CreateBrand = new Brand();
            $CreateBrand->name = $request->input('brand_name');
            $CreateBrand->brand_tagline = $request->input('Tagline');
            $CreateBrand->brand_website = $request->input('address');
            $CreateBrand->description = $request->input('Description');
            if ($request->hasFile('Category_file')) {
                $image = $request->file('Category_file');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('uploads/Home', $imageName, 'public');
                $CreateBrand->file = $imageName;  
            }

            $CreateBrand->save();
        return redirect()->back()->with('success', 'Brand added successfully!');
    }

    #soft delete reviews list
    #authr: vivek
    public function Deletebrand($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $Brand = Brand::findOrFail($decryptedId);
            $Brand->delete();

            return redirect()->back()->with('success', 'Brand deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }


    #view fasq
    #authr: vivek
    public function Getfasq(){
       try {
        $fasq = faqs::orderbydesc('id')->get();
        return view(' Admin.fasq',compact('fasq'));
       } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    #Add Createfasq
    #authr: vivek
    public function Createfasq(Request $request){
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
         $Createfasq = new faqs();
            $Createfasq->question = $request->input('question');
            $Createfasq->answer = $request->input('answer');
            $Createfasq->save();
        return redirect()->back()->with('success', 'Fasq added successfully!');
    }

    #soft delete fasq list
    #authr: vivek
    public function Deletefasq($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $Deletefasq = faqs::findOrFail($decryptedId);
            $Deletefasq->delete();

            return redirect()->back()->with('success', 'fasq deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }


    #view client home page
    #authr: vivek
    public function GetClientHomepage(){
        $Homeslider = Homeslider::latest()->take(3)->get();
        $ads = advertisement::orderbydesc('id')->get();
        $Categories = Category::where('status',1)->get();
        $productlist = ProductPrice::with(['category'])->orderbydesc('id')->get();
        $bestsallerlist = Orders::with(['product.category','product.productPrices'])->orderbydesc('id')->get()->unique('product_id')->values();
        //return $bestsallerlist ;

        $data = [];

        foreach ($bestsallerlist as $order) {
            $product = $order->product;
            $category = $product->category ?? null;
            $price = $product->productPrices->first(); // First price only

            $data[] = [
                'id'         => $price->id,
                'order_id'         => $order->id,
                'order_number'     => $order->order_number,
                'total_amount'     => $order->total_amount,
                'payment_status'   => $order->payment_status,
                'order_status'     => $order->order_status,
                'shipping_address' => $order->shipping_address,
                'product_name'     => $product->name ?? 'N/A',
                'product_file'     => $product->file ?? null,
                'category_name'    => $category->name ?? 'N/A',
                'offer_price'      => $price->offer_price ?? 'N/A',
                'listing_name'     => $price->listing_name ?? '',
                'product_cost'     => $price->product_cost ?? '',
            ];
        }

        $reviewlist = Review::with(['Product','users'])->orderbydesc('id')->where('status',2)->take(3)->get();
          $reviewlists = [];
          foreach($reviewlist as $review){
            $reviewlists[] = [
              'clientname' => $review->users->name,
              'comment' => $review->comment,
              'rating' => $review->rating,
              'productname' => $review->product->name ?? '',
            ];
          }

         $brandList = Brand::orderbydesc('id')->get(); 
         //return  $data;

        return view('index',compact('Homeslider','Categories','productlist','data','reviewlists','brandList','ads'));
    }

    #view CreateAdvertisement
    #authr: vivek
    public function Getadvertisement(){
        $advertisement = advertisement::orderbydesc('id')->get();
        return view('Admin.advertisement',compact('advertisement'));
    }


    #Add Createadvertisement
    #authr: vivek
    public function Createadvertisement(Request $request){
        //return $request->all();
        $request->validate([
            'banner' => 'required',
            'Category_file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
         $advertisement = new advertisement();
            $advertisement->ads_no = $request->input('banner');
            if ($request->hasFile('Category_file')) {
                $image = $request->file('Category_file');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('uploads/advertisement', $imageName, 'public');
                $advertisement->file = $imageName;  
            }

            $advertisement->save();
        return redirect()->back()->with('success', 'Advertisement added successfully!');
    }

    #soft delete Deleteadvertisement list
    #authr: vivek
    public function Deleteadvertisement($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $advertisement = advertisement::findOrFail($decryptedId);
            $advertisement->delete();

            return redirect()->back()->with('success', 'Advertisement deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }


}

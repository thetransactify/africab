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
use App\Models\offerlist;
use App\Models\videourl;
use App\Models\Review;
use App\Models\RecentViews;
use App\Models\productsPostion;
use App\Models\popularProducts;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    #view CreateHomepage
    #authr: vivek
    public function GetHomepage(){
    	$Homeslider = Homeslider::orderbydesc('id')->get();
    	return view('Admin.home',compact('Homeslider'));
    }
 // public function GetClientHomepagessss(){
 //    	return view('lunch');
 //    }

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
        $videourl = videourl::first();
        $productlist = ProductPrice::with(['category','galleries'])->orderbydesc('id')->get()
       ->groupBy(fn($product) => $product->category->id) 
                ->map(fn($products) => $products->first()) 
                ->values();
        $bestsallerlist = Orders::with(['products','products.category','products.galleries'])->orderbydesc('id')->get()->unique('product_id')->values();
        $productsPositioning = productsPostion::with(['Product.galleries'])
                ->orderByDesc('id')
                ->get()
                ->map(function ($item) {
                    $lastGallery = $item->Product && $item->Product->galleries->count() > 0
                        ? $item->Product->galleries->last()->file
                        : null;
                    return [
                        'id'       => $item->id,
                        'name'     => $item->Product->listing_name ?? 'N/A',
                        'position' => $item->position,
                        'image'    => $lastGallery ? asset('storage/uploads/product/'.$lastGallery) : null,
                    ];
                });
        $popularproducts = popularProducts::with(['Product.galleries'])
                ->orderByDesc('id')
                ->whereHas('Product', function($q) {
                        $q->where('product_online', 1);
                    })  
                ->orderByDesc('count')
                ->take(10)       
                ->get()
                ->map(function ($item) {
                    $lastGallery = $item->Product && $item->Product->galleries->count() > 0
                        ? $item->Product->galleries->last()->file
                        : null;
                    return [
                        'id'       => $item->id ?? 'N/A',
                        'name'     => $item->Product->listing_name ?? 'N/A',
                        'search'   => $item->count ?? 'N/A',
                        'offer_price'   => $item->Product->offer_price ?? 'N/A',
                        'product_cost'   => $item->Product->product_cost ?? 'N/A',
                        'image'    => $lastGallery ? asset('storage/uploads/product/'.$lastGallery) : null,
                    ];
                });
        $data = [];
        foreach ($bestsallerlist as $order) {
            $product = $order->products;
            $category = $product?->category ?? null;
            $price = $order->products?->first();
            $galleriess = optional($order->products->galleries)->first();
            $data[] = [
                'id'         => $price->id ?? '',
                'order_id'         => $order->id ?? '',
                'order_number'     => $order->order_number ?? '',
                'total_amount'     => $order->total_amount ?? '',
                'payment_status'   => $order->payment_status ?? '',
                'order_status'     => $order->order_status ?? '',
                'shipping_address' => $order->shipping_address ?? '',
                'product_name'     => $product->listing_name ?? 'N/A',
                'product_file'     => $galleriess->file ?? null,
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
         $rawData = DB::table('products_offers as po')
            ->leftJoin('product_details as pp', DB::raw('FIND_IN_SET(pp.id, po.proudct_deatils_id)'), '>', DB::raw('0'))
            ->leftJoin('product_gallery as pg', 'pg.product_id', '=', 'pp.id')
            ->where('po.product_online', 1)
            ->select(
                'po.id as offer_id',
                'po.label',
                'po.product_online',
                'po.proudct_deatils_id',
                'pp.id as product_id',
                'pp.listing_name',
                'pp.product_cost',
                'pp.offer_price',
                'po.file as image',
                'pg.file'
            )
            ->get();
            //return  $rawData;
            $grouped = $rawData->groupBy('offer_id')->map(function ($items) {
                $first = $items->first();

                $products = $items->groupBy('id')->map(function ($productItems) {
                    $firstProduct = $productItems->first();

                    return [
                        'id' => $firstProduct->product_id,
                        'ids' => $firstProduct->offer_id,
                        'label' => $firstProduct->label,
                        'listing_name' => $firstProduct->listing_name,
                        'product_cost' => $firstProduct->product_cost,
                        'offer_price' => $firstProduct->offer_price,
                        'images' => $firstProduct->image,
                        'gallery' => $productItems->pluck('file')->filter()->unique()->values(),
                    ];
                })->values();

                return [
                    'id' => $first->offer_id,
                    'label' => $first->label,
                    'product_online' => $first->product_online ?? '',
                    'products' => $products,
                ];
            })->values();
       // return $grouped;
        $recentviews = RecentViews::with(['productprice','galleries'])->orderbydesc('id')
        ->where('user_id', auth()->id())
        ->get();
        // return  $recentviews;

        $recentviewlist =[];
        foreach ($recentviews as $lists) {
             $product = $lists->productprice;
              $file = optional($product->galleries->first())->file ?? '-';
            $recentviewlist[] = [
            'product_name' => $product->listing_name ?? '',
            'file' => $file ?? 'default.jpg',
            ];
        }
        return view('index',compact('Homeslider','Categories','productlist','data','reviewlists','brandList','ads','grouped','recentviewlist','videourl','productsPositioning','popularproducts'));
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

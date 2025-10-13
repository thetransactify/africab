<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPrice;
use App\Models\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Orders;
use App\Models\Wishlist;
use App\Models\offerlist;
use App\Models\RecentViews;
use App\Models\videourl;
use App\Models\popularProducts;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Mail\ProductInStockMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;



class CategoryProductController extends Controller
{
    //
    #view Category
    #authr: vivek
    public function showProduct(){
    	$category = Category::orderbydesc('id')->get();
    	return view(' Admin.create_product',compact('category'));
    }


    #Add Prodcut
    #authr: vivek
    public function CreateProduct(Request $request){
    	//return $request->all();
    	$request->validate([
		    'CategoryList' => 'required',
		    'product_name' => 'required|string|max:255',
		    'description' => 'required|string',
		    // 'page_title' => 'required|string|max:255',
		    // 'page_description' => 'required|string',
		    // 'Category_file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
		]);
         $product = new Product();
            $product->category_id = $request->input('CategoryList');
            $product->name = $request->input('product_name');
            $product->description = $request->input('description');
            $product->page_title = $request->input('page_title');
            $product->page_description = $request->input('page_description');
            $product->check_remark = $request->input('radioswitch');
            // File Upload
            if ($request->hasFile('Category_file')) {
                $image = $request->file('Category_file');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('uploads/product', $imageName, 'public');
                $product->file = $imageName;  
            }

            $product->save();
        return redirect()->back()->with('success', 'SubCategories added successfully!');
    }

    #Product List
    #authr: vivek
    public function ViewProduct(){
        $productlist = Product::with('category')->orderBy('id', 'desc')->paginate(10);
        if ($productlist->isEmpty()) {
            return view(' Admin.view_product',compact('productlist'));
        }
    	return view(' Admin.view_product',compact('productlist'));
    }

    #Category Edit
    #authr: vivek
    public function EditProduct($id){
        try {
        $decryptedId = Crypt::decrypt($id);
        $category = Product::with('category')
        ->where('id',$decryptedId)
        ->get();
        $product = Product::with('category')
        ->where('id',$decryptedId)
        ->first();
        //return $category;
        return view(' Admin.edit_product', compact('category','product'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid or expired link.');
        }
    }

    #Update Category
    #authr: vivek
    public function UpdateProduct(Request $request, $encryptedId)
    {
        //return $request->all();
        $id = Crypt::decrypt($encryptedId);
        $product = product::findOrFail($id);

        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            // 'meta_page' => 'nullable|string|max:255',
            // 'page_description' => 'nullable|string',
            // 'Category_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $product->name = $request->product_name;
        $product->category_id = $request->CategoryList;
        $product->description = $request->description;
        $product->page_title = $request->meta_page;
        $product->page_description = $request->page_description;
        $product->check_remark = $request->radioswitch;
	    if($request->hasFile('Category_file') && $request->file('Category_file') != null){
	        if ($request->hasFile('Category_file')) {
	            $image = $request->file('Category_file');
	            $imageName = time() . '_' . $image->getClientOriginalName();
	            $image->storeAs('uploads/product', $imageName, 'public');
	            $product->file = $imageName;
	        }
	    }else{
	        $imageName = $request->Category_file_old;
	        $product->file = $imageName;
	    }

        $product->save();
        
        return redirect()->route('prodcut.view')->with('success', 'SubCategories updated successfully!');
   }

    #soft delete Product
    #authr: vivek
   public function DeleteProduct($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $product = Product::findOrFail($decryptedId);

            // Optional: delete image if exists
            if ($product->file) {
                Storage::disk('public')->delete('uploads/product/' . $product->file);
            }

            $product->delete();

            return redirect()->back()->with('success', 'SubCategories deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

}

    //
    #Price List 
    #authr: vivek
    public function ProdcutPriceList(){
            $productlist = ProductPrice::orderbydesc('id')->get();
            $categories = Category::all();
        // $category = Category::orderbydesc('id')->get();
        return view('Admin.product_price',compact('categories','productlist'));
    }
    
    #product List 
    #authr: vivek
    public function getProducts($category_id){
        $products = ProductPrice::where('category_id', $category_id)->get();
        return response()->json($products);
    }

    #product List 
    #authr: vivek
    public function subcategiores($category_id){
        $products = Product::where('category_id', $category_id)->get();
        return response()->json($products);
    }



    #product Name 
    #authr: vivek
    public function getProductlist($category_id){
        $products = ProductPrice::where('category_id', $category_id)->get();
        return response()->json($products);
    }

    #Add ProdcutList
    #authr: vivek
    public function CreateProductList(Request $request){
        //return $request->all();
        $request->validate([
            'CategoryList' => 'required',
            'productList' => 'required',
            'name' => 'required|string|max:255',
            'Weight' => 'required|string',
            'packing_type' => 'required|string|max:255',
            'offer_price' => 'required|string',
            'Item_cost' => 'required|string',
        ]);
         $ProductList = new ProductPrice();
            $ProductList->product_id = $request->input('productList');
            $ProductList->category_id = $request->input('CategoryList');
            $ProductList->listing_name = $request->input('name');
            $ProductList->description = $request->input('description');
            $ProductList->packing_weight = $request->input('Weight');
            $ProductList->packing_type = $request->input('packing_type');
            $ProductList->product_cost = $request->input('Item_cost');
            $ProductList->product_online = $request->input('OnlineProduct',2);
            $ProductList->code = $request->input('Code');
            $ProductList->color_name =  implode(',', $request->input('colors'));
            $ProductList->offer_price = $request->input('offer_price');
            $ProductList->status = $request->input('sellSingle',2);
            $ProductList->save();   
        return redirect()->back()->with('success', 'Product List added successfully!');
    }

    #Category Edit
    #authr: vivek
    public function EditProductList($id){
        try {
        $decryptedId = Crypt::decrypt($id);
        $productList = ProductPrice::with(['category','product'])
        ->where('id',$decryptedId)
        ->first();
        $categories = Category::all();
        $products = Product::all();
        //return $productList;
        return view(' Admin.edit_productlist', compact('productList','categories','products'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid or expired link.');
        }
    }

    #Update productPriceList
    #authr: vivek
    public function UpdateProductList(Request $request, $encryptedId)
    {
        //return $request->all();
        $id = Crypt::decrypt($encryptedId);
        $ProductPrice = ProductPrice::findOrFail($id);

        $request->validate([
            'CategoryList' => 'required|max:255',
            'productList' => 'required|string',
            'price_list' => 'required|string',
            'description' => 'required|string',
            'weight' => 'required|string',
            'type' => 'required|string',
            'cost' => 'required|string',
            'offer_price' => 'required|string'
        ]);
        $oldStatus = $ProductPrice->product_online ?? null;
        $ProductPrice->product_id = $request->productList;
        $ProductPrice->category_id = $request->CategoryList;
        $ProductPrice->listing_name = $request->price_list;
        $ProductPrice->description = $request->description;
        $ProductPrice->packing_weight = $request->weight;
        $ProductPrice->packing_type = $request->type;
        $ProductPrice->product_cost = $request->cost;
        $ProductPrice->offer_price = $request->offer_price;
        $ProductPrice->code = $request->Code;
        $ProductPrice->color_name =  implode(',', $request->colors);
        $ProductPrice->product_online = $request->input('Online', 2);
        $ProductPrice->status = $request->input('Sell',2);
        $ProductPrice->save();
        if ($oldStatus == 2 && $ProductPrice->product_online == 1) {
            $this->notifyCustomers($ProductPrice);
        }
        return redirect()->route('get.productlists')->with('success', 'Product Price updated successfully!');
   }

   #email in stock
   protected function notifyCustomers($product){
    $wishlistUsers = $product->wishlist()->with('users')->get()->pluck('users');
    $listUsers = $product->lists()->with('users')->get()->pluck('users');
    $allUsers = $wishlistUsers->merge($listUsers)->unique('id');

    // 👉 Log info for debugging
    Log::info('NotifyCustomers called', [
        'product_id' => $product->id,
        'product_name' => $product->listing_name ?? null,
        'total_users' => $allUsers->count(),
        'users' => $allUsers->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name ?? null,
                'email' => $user->email ?? null,
            ];
        }),
    ]);

    foreach ($allUsers as $user) {
        Mail::to($user->email)->send(new ProductInStockMail($product, $user));
     }
   }


    #soft delete ProductPrice list
    #authr: vivek
   public function DeleteProductList($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $ProductList = ProductPrice::findOrFail($decryptedId);
            $ProductList->delete();

            return redirect()->back()->with('success', 'Product List deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

}

    #Product Gallery 
    #authr: vivek
    public function ProdcutGallery(){
            $productlist = ProductPrice::orderbydesc('id')->get();
            $ProdcutGallery = ProductGallery::with(['category','ProductPrice'])->orderbydesc('id')->where('status','1')->get();
            //return $ProdcutGallery;
            $categories = Category::all();
        // $category = Category::orderbydesc('id')->get();
        return view('Admin.product_gallery',compact('categories','productlist','ProdcutGallery'));
    }

    #Add Gallery
    #authr: vivek
    public function CreateGallery(Request $request){
        //return $request->all();
        $request->validate([
            'CategoryList' => 'required',
            'productList' => 'required|string',
            'image_label' => 'required|string',
            'Category_file' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
         $ProdcutGallery = new ProductGallery();
            $ProdcutGallery->category_id = $request->input('CategoryList');
            $ProdcutGallery->product_id = $request->input('productList');
            $ProdcutGallery->label = $request->input('image_label');
            // File Upload
            if ($request->hasFile('Category_file')) {
                $image = $request->file('Category_file');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('uploads/product', $imageName, 'public');
                $ProdcutGallery->file = $imageName;  
            }

            $ProdcutGallery->save();
        return redirect()->back()->with('success', 'Product Gallery added successfully!');
    }
    #soft delete ProductPrice list
    #authr: vivek
   public function Deletegallery($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $Productgallery = ProductGallery::findOrFail($decryptedId);
            $Productgallery->status = 2;
            $Productgallery->save();
            return redirect()->back()->with('success', 'Gallery Product deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }

     #customer list 
    #auth vivek
    public function Getcustomer(){
        $customer_list = User::with(['wishlists','Orders'])->withCount('orders')->withCount('wishlists')->orderbydesc('id')->where('role',1)->get();
        //return  $customer_list;
        return view(' Admin.customer_manage',compact('customer_list'));
    }
    #customer summary list 
    #auth vivek
    public function Getsummary(){
        $customer_summary = User::with(['wishlists','Orders'])->withCount('orders')->withCount('wishlists')->orderbydesc('id')->where('role',1)->get();
        //return  $customer_summary;
        return view(' Admin.customer_summary',compact('customer_summary'));
    }
    

    #customer Orders list 
    #auth vivek
    public function fetchOrders(Request $request){
    $user = User::with('orders')->find($request->customer_id);

    if (!$user) {
        return response()->json(['orders' => []]);
    }


    $orders = $user->orders->map(function ($order) {
        return [
            'order_no' => $order->order_number ?? 'N/A',
            'order_date' => $order->created_at->format('d/m/Y'),
            'amount' => $order->total_amount ?? 0,
            'order_status' => $order->order_status ?? 'Unknown',
        ];
    });

    return response()->json(['orders' => $orders]);
    }

    #customer wishlist list 
    #auth vivek
    public function Getwishlist(){
         $Getwishlist = User::with(['wishlists','Orders'])->withCount('orders')->withCount('wishlists')->orderbydesc('id')->where('role',1)->get();
        return view(' Admin.customer_wishlist',compact('Getwishlist'));
    }

    #customer Orders list 
    #auth vivek
  public function fetchWishlist(Request $request)
{
    $user = User::with('wishlists.productPrice.category')->find($request->customer_id);
    //return $user;

    if (!$user) {
        return response()->json(['wishlists' => []]);
    }

    $wishlists = $user->wishlists->map(function ($wishlist, $index) {
         $product = $wishlist->productPrice;
         $image = $product && $product->galleries->count() > 0
        ? $product->galleries->first()->file
        : ($product->file ?? 'no-image.png');
        return [
            'id'         => $index + 1,
            'added_on'   => $wishlist->created_at->format('d/m/Y'),
            'image_url'  => asset('storage/uploads/product/' . ($image ?? 'no-image.png')),
            'product'    => $wishlist->productPrice->listing_name ?? '—',
            'category'   => $wishlist->productPrice->category->name ?? '—',
            'label'      => $wishlist->productPrice->label ?? '—',
        ];
    });

    return response()->json(['wishlists' => $wishlists]);
}


    
    #Toggle Customer Access 
    #auth vivek
    public function toggleStatus(Request $request, $id){
         $ids = Crypt::decrypt($id);
    $customer = User::findOrFail($ids);
    $customer->is_suspended = $request->status;
    $customer->save();
    return response()->json(['success' => true]);
   }

    #view Permission
    #authr: vivek
    public function GetPermission(){
        $Permission = ProductPrice::with(['category','product'])->orderBy('id', 'desc')->paginate(10);
        //return $Permission;
        return view(' Admin.product_permission',compact('Permission'));
    }
    
    #view Orders
    #authr: vivek
    public function GetOrders(){
       $orderlist = Orders::with(['users','products'])
       ->latest()
       ->get()
       ->groupBy('order_group_id');
       //return   $orderlist;

       $ordergroups = [];

       foreach ($orderlist as $groupId => $orders) {
        $firstOrder = $orders->first();

        $ordergroups[] = [
            'order_group'    => $groupId,
            'id'    => Crypt::encrypt($firstOrder->id),
            'txn_id'   => $firstOrder->order_number,
            'customer_name'  => $firstOrder->users->name ?? 'Guest',
            'customer_email' => $firstOrder->users->email ?? '-',
            'customer_mobile'=> $firstOrder->users->mobile ?? '-',
            'amount'         => $orders->sum(fn($o) => $o->total_amount + ($o->shipping_charge ?? 0)),
            'order_status'   => [1 => 'Processing', 2 => 'Shipped', 3 => 'Delivered'][$firstOrder->order_status] ?? 'Unknown',
            'payment_status' => [1 => 'Pending', 2 => 'Paid', 3 => 'Failed'][$firstOrder->payment_status] ?? 'Unknown',
            'method'         => [1 => 'Online', 2 => 'Cash on Delivery'][$firstOrder->method] ?? 'Unknown',
            'created_at'     => $firstOrder->created_at->format('d/m/Y'),
        ];
    }
         return view(' Admin.product_orders', compact('ordergroups'));
    }


    public function toggleVisibility(Request $request, $id){
    $product = ProductPrice::findOrFail($id);
    $product->product_online = $request->status;
    $product->save();

    return response()->json(['message' => 'Product visibility updated.']);
   }

   public function Clientshow($slug){
    $category = Category::whereRaw("LOWER(REPLACE(name, ' ', '-')) = ?", [$slug])->first();
    if (!$category) {
        abort(404, 'Category not found.');
    }
    $products = Product::with(['productPrices' => function($query) {
                    $query->with(['galleries' => function($q) {
                        $q->orderByDesc('id')->limit(1);
                    },'product']);
                }, 'category'])
                ->where('category_id', $category->id)
                ->where('status', 1)
                ->get();
    $productsList = [];
    $subcategoriesList = [];
    foreach ($products as $product) {
        if ($product->relationLoaded('productPrices') && $product->productPrices->isNotEmpty()) {
        $onlinePrices = $product->productPrices->where('product_online', 1);
           if ($onlinePrices->isNotEmpty()) {
            foreach ($product->productPrices as $product_price) {
                $productsList[] = [
                    'id' => $product_price->id ?? 'N/A',
                    'productname' => $product_price->listing_name ?? 'N/A',
                    'product_code' => $product_price->code ?? 'N/A',
                    'tag' => $product->check_remark ?? 'N/A',
                    'product_cost' => $product_price->product_cost ?? 'N/A',
                    'offer_price' => $product_price->offer_price ?? 'N/A',
                    'SubCategories'  => $product_price->product->name ?? 'N/A',
                    'category' => $product->category->name ?? 'N/A',
                    'product_image' => $product_price->galleries->isNotEmpty()
    ? asset('storage/uploads/category/' . $product_price->galleries->first()->file)
    : asset('storage/no-image.png'),
                    'category_image' => asset('storage/uploads/category/' . $category->file), 
                ];
            }
         }
      }
    }
//return $productsList;
    foreach ($products as $product) {
        if ($product->category_id == $category->id && $product->id != $category->id) {
            $subcategoriesList[] = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'category' => $product->category->name ?? 'N/A',
            ];
        }
    }    

     $recentviews = RecentViews::with(['productprice','galleries'])->orderbydesc('id')
        ->where('user_id', auth()->id())
        ->get();
        $recentviewlist =[];
        foreach ($recentviews as $lists) {
             $product = $lists->productprice;
              $file = optional($product->galleries->first())->file;
            $recentviewlist[] = [
            'product_name' => $product->listing_name ?? '',
            'file' => $file ?? 'default.jpg',
            ];
        }
  //return $productsList;
    return view('product-category', compact('productsList', 'subcategoriesList','category','recentviewlist'));
   }

   public function GetProduct($slug){
       $normalizedSlug = Str::slug($slug);
        $ProductList = ProductPrice::get()->first(function($product) use ($normalizedSlug) {
            return Str::slug(trim($product->listing_name)) === $normalizedSlug;
        });          


        if (!$ProductList) {
        abort(404, 'Product not found.');
        }
        $productPriceId = $ProductList->id;
        $productDetails = ProductPrice::with([
        'product' => function($query) {
            $query->select('id', 'name', 'description');
        },
        'category' => function($query) {
            $query->select('id', 'name','file');
        },
        'galleries',
        'reviews' => function($query) {
        $query->orderByDesc('id');
        }
        ])
        ->where('id', $productPriceId)
        ->first();

        if (!$productDetails) {
        abort(404, 'Product details not found.');
        }

        $galleryFiles = $productDetails->galleries->pluck('file')->toArray();
        $reviewRatings = $productDetails->reviews->pluck('rating')->toArray();
        $reviewuser = $productDetails->reviews->pluck('user_id')->toArray();
        $reviewComment = $productDetails->reviews->pluck('comment')->toArray();
        $colors = explode(',', $productDetails->color_name); 
        $data = [
        'product_price' => [
            'id' => $productDetails->id,
            'listing_name' => $productDetails->listing_name,
            'color' => $colors,
            'description' => $productDetails->description,
            'packing_weight' => $productDetails->packing_weight,
            'packing_type' => $productDetails->packing_type,
            'product_cost' => $productDetails->product_cost,
            'offer_price' => $productDetails->offer_price,
            'product_online' => $productDetails->product_online,
            'status' => $productDetails->status,
            'sub_categories' => $productDetails->product->name ?? null,
            'category' => $productDetails->category->name ?? null,
            'category_file' => $productDetails->category->file ?? null,
            'galleries' => $galleryFiles,
            'reviewRatings' => $reviewRatings,
            'reviewuser' => $reviewuser,
            'comment' => $reviewComment
        ]
        ];

    if (auth()->check()) {
        $userId = auth()->id();
        RecentViews::updateOrCreate(
            ['user_id' => $userId, 'product_id' => $productDetails->id],
            ['created_at' => now()]
        );
        $recentViews = RecentViews::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($recentViews->count() > 5) {
            $extra = $recentViews->slice(5)->pluck('id');
            RecentViews::whereIn('id', $extra)->delete();
        }
    }

     $recentviews = RecentViews::with(['productprice','galleries'])->orderbydesc('id')
        ->where('user_id', auth()->id())
        ->get();
        $recentviewlist =[];
        foreach ($recentviews as $lists) {
             $product = $lists->productprice;
              $file = optional($product->galleries->first())->file;
            $recentviewlist[] = [
            'product_name' => $product->listing_name ?? '',
            'file' => $file ?? 'default.jpg',
            ];
        }
        // product tracker 
        $tracker = DB::table('products_tracker')->updateOrInsert(
            ['product_id' => $productDetails->id],
            ['count' => DB::raw('count + 1'), 'updated_at' => now(), 'created_at' => now()]
        );

        return view('product_list', compact('data','recentviewlist'));
   }

   public function search(Request $request)
   {
    $search = $request->input('query');

    $products = DB::table('product as p')
        ->leftJoin('category as c', 'p.category_id', '=', 'c.id')
        ->leftJoin('product_details as pd', 'p.id', '=', 'pd.product_id')
        ->leftJoin('product_gallery as g', 'p.id', '=', 'g.product_id') // product image

        ->where(function ($query) use ($search) {
            $query->where('p.name', 'LIKE', "%{$search}%")
                  ->orWhere('c.name', 'LIKE', "%{$search}%")
                  ->orWhere('pd.code', 'LIKE', "%{$search}%")
                  ->orWhere('pd.listing_name', 'LIKE', "%{$search}%");
        })
        ->select(
            'p.id',
            'p.name as product_name',
            'pd.listing_name',
            'pd.code',
            'c.name as category_name',
            'c.file as category_image',
            'g.file as product_image'

        )
        ->groupBy('p.id','pd.code', 'p.name', 'pd.listing_name', 'c.name','category_image','product_image')
        ->limit(10)
        ->get();

   $html = '';
if ($products->count()) {
    foreach ($products as $product) {
        $productImg = asset('storage/uploads/product/' . ($product->product_image ?? 'default.png'));
        $categoryImg = asset('storage/uploads/category/' . ($product->category_image ?? 'default.png'));

        // Generate slugs for URL
        $categorySlug = Str::slug($product->category_name);
        $productSlug = Str::slug($product->listing_name);

        $productUrl = url('product/'  . $productSlug);
        $categoryUrl = url('product-category/' . $categorySlug);

        $html .= '<div class="search-item d-flex align-items-start gap-3 border-bottom py-3">';
        $html .= '<img src="' . $productImg . '" width="60" height="60" style="object-fit: cover; border-radius: 6px;">';
        $html .= '<div>';

        // 👉 Product Name Link
        $html .= '<a href="' . $productUrl . '" class="fw-bold d-block" style="font-size: 16px; color: #000;">'
              . ($product->listing_name) . '</a>';

        // 👉 Category Name Link
        $html .= '<a href="' . $categoryUrl . '" class="text-muted" style="font-size: 13px;">';
        $html .= 'Category: ' . ($product->category_name ?? '-') . '</a><br>';

        // 👉 Category Image (optional)
        $html .= '<img src="' . $categoryImg . '" width="40" height="40" style="object-fit: cover; border-radius: 4px; margin-top: 5px;">';

        $html .= '</div></div>';
    }
} else {
    $html .= '<div class="text-muted text-center">No results found.</div>';
}

return $html;

}


   #Offer list 
   #authr: vivek
    public function ProdcutOffer(){
            $productlist = offerlist::orderbydesc('id')->get();
            $categories = Category::all();
        // $category = Category::orderbydesc('id')->get();
        return view('Admin.manage_offer',compact('categories','productlist'));
    }

    
    #Add ProdcutList
    #authr: vivek
    public function CreateProductListoffers(Request $request){
        //return $request->all();
        $request->validate([
            'productList' => 'required',
            'CategoryList' => 'required',
            'name' => 'required',
            'productName' => 'required',
        ]);
         $ProductOfferList = new offerlist();
            $ProductOfferList->label = $request->input('name');
            $ProductOfferList->category_id = $request->input('CategoryList');
            $ProductOfferList->subcategory_id = $request->input('productList');
            $ProductOfferList->proudct_deatils_id = implode(',', $request->input('productName'));
            $ProductOfferList->product_online = $request->input('OnlineProduct',2);
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('uploads/product', $imageName, 'public');
                $ProductOfferList->file = $imageName;  
            }
            $ProductOfferList->save();
        return redirect()->back()->with('success', 'Product Offer List added successfully!');
    }

    #soft delete Offers list
    #authr: vivek
   public function DeleteOffersProductList($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $ProductList = offerlist::findOrFail($decryptedId);
            $ProductList->delete();

            return redirect()->back()->with('success', 'Product offerlist List deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    #offers Edit
    #authr: vivek
    public function EditProductOffersList($id){
        //return $id;
        try {
        $decryptedId = Crypt::decrypt($id);
        $productList = offerlist::with(['category','productDetails','subcategory'])
        ->where('id',$decryptedId)
        ->first();
        $categories = Category::all();
        $products = Product::all();
        $productLists = ProductPrice::all();
        //return $productList;
        return view(' Admin.edit_productoffers', compact('productList','categories','products','productLists'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid or expired link.');
        }
    }

    #Update productPriceListoffer
    #authr: vivek
    public function UpdateProductOffersList(Request $request, $encryptedId)
    {
        //return $request->all();
        $id = Crypt::decrypt($encryptedId);
        $ProdcutOffer = offerlist::findOrFail($id);
        $request->validate([
            'label' => 'required',
            'CategoryList' => 'required',
            'productList' => 'required',
            'Subcategories' => 'required',
        ]);

        $ProdcutOffer->label = $request->label;
        $ProdcutOffer->category_id = $request->CategoryList;
        $ProdcutOffer->subcategory_id = $request->Subcategories;
        $ProdcutOffer->proudct_deatils_id = implode(',', $request->input('productList'));
        $ProdcutOffer->product_online = $request->input('Online', 2);
         if($request->hasFile('file') && $request->file('file') != null){
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('uploads/product', $imageName, 'public');
                $ProdcutOffer->file = $imageName;
            }
        }else{
            $imageName = $request->banner_file_old;
            $ProdcutOffer->file = $imageName;
        }
        $ProdcutOffer->save();
        return redirect()->route('get.ProdcutOffer')->with('success', 'Product Offer updated successfully!');
   }
   
   #get ecxel upload
   #auth vivek
   public function GetExcelProduct(){
       return view('Admin.import-form');
   }
    
   #add ecxel upload
   #auth vivek
    public function AddExcelProduct(Request $request){
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ProductsImport, $request->file('excel_file'));

        return back()->with('success', 'Products Imported Successfully!');
    }

    #auth vivek
    # offer list
     public function showOffer($label)
    {   

        $id = Crypt::decrypt($label);
        $rawData = DB::table('products_offers as po')
            ->leftJoin('product_details as pp', DB::raw('FIND_IN_SET(pp.id, po.proudct_deatils_id)'), '>', DB::raw('0'))
            ->leftJoin('product_gallery as pg', 'pg.product_id', '=', 'pp.id')
            ->where('po.product_online', 1)
            ->where('po.id', $id)
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

                $products = $items->groupBy('product_id')->map(function ($productItems) {
                    $firstProduct = $productItems->first();

                    return [
                        'id' => $firstProduct->product_id,
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
        $recentviews = RecentViews::with(['productprice','galleries'])->orderbydesc('id')
        ->where('user_id', auth()->id())
        ->get();
        $recentviewlist =[];
        foreach ($recentviews as $lists) {
             $product = $lists->productprice;
              $file = optional($product->galleries->first())->file;
            $recentviewlist[] = [
            'product_name' => $product->listing_name ?? '',
            'file' => $file ?? 'default.jpg',
            ];
        }
        return view('offerlist', compact('grouped','recentviewlist') );
    }

    #view video
    #authr: vivek
    public function GetUploadvideo(){
        $videourl = videourl::orderbydesc('id')->get();
        return view('Admin.upload_video',compact('videourl'));
    }
    #Add CreateVideo
    #authr: vivek
    public function CreateUploadvideo(Request $request){
         $videourl = new videourl();
            $videourl->url = $request->input('videourl');
            $videourl->save();
        return redirect()->back()->with('success', 'Video url added successfully!');
    }

    #delete url
    #authr: vivek
    public function Deleteurl($id){
        try {
            $decryptedId = Crypt::decrypt($id);
            $homepage = videourl::findOrFail($decryptedId);
            $homepage->delete();

            return redirect()->back()->with('success', 'Url deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

    }

}

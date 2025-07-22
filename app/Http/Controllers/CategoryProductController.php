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
use Illuminate\Support\Facades\DB;



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
        //return $productlist;
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
        $products = Product::where('category_id', $category_id)->get();
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
            $ProductList->product_id = $request->input('CategoryList');
            $ProductList->category_id = $request->input('productList');
            $ProductList->listing_name = $request->input('name');
            $ProductList->description = $request->input('description');
            $ProductList->packing_weight = $request->input('Weight');
            $ProductList->packing_type = $request->input('packing_type');
            $ProductList->product_cost = $request->input('Item_cost');
            $ProductList->product_online = $request->input('OnlineProduct',2);
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
        //return $category;
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

        $ProductPrice->product_id = $request->CategoryList;
        $ProductPrice->category_id = $request->productList;
        $ProductPrice->listing_name = $request->price_list;
        $ProductPrice->description = $request->description;
        $ProductPrice->packing_weight = $request->weight;
        $ProductPrice->packing_type = $request->type;
        $ProductPrice->product_cost = $request->cost;
        $ProductPrice->offer_price = $request->offer_price;
        $ProductPrice->product_online = $request->input('Online', 2);
        $ProductPrice->status = $request->input('Sell',2);
        $ProductPrice->save();
        return redirect()->route('get.productlist')->with('success', 'Product Price updated successfully!');
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
            $ProdcutGallery = ProductGallery::with(['category','product'])->orderbydesc('id')->where('status','1')->get();
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
    $user = User::with('wishlists.product.category')->find($request->customer_id);

    if (!$user) {
        return response()->json(['wishlists' => []]);
    }

    $wishlists = $user->wishlists->map(function ($wishlist, $index) {
        return [
            'id'         => $index + 1,
            'added_on'   => $wishlist->created_at->format('d/m/Y'),
            'image_url'  => asset('storage/uploads/product/' . ($wishlist->product->file ?? 'no-image.png')),
            'product'    => $wishlist->product->name ?? '—',
            'category'   => $wishlist->product->category->name ?? '—',
            'label'      => $wishlist->product->label ?? '—',
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
         return view(' Admin.product_orders');
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
    $products = Product::with(['productPrices','category'])
                ->where('category_id', $category->id)
                ->where('status',1)
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
                    'tag' => $product->check_remark ?? 'N/A',
                    'product_cost' => $product_price->product_cost ?? 'N/A',
                    'offer_price' => $product_price->offer_price ?? 'N/A',
                    'category' => $product->category->name ?? 'N/A',
                    'category_image' => asset('storage/uploads/category/' . $category->file), 
                ];
            }
         }
      }
    }

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
  //return $productsList;
    return view('product-category', compact('productsList', 'subcategoriesList','category'));
   }

   public function GetProduct($slug){
        $ProductList = ProductPrice::whereRaw("LOWER(REPLACE(listing_name, ' ', '-')) = ?", [$slug])->first();

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
        'reviews'
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

        $data = [
        'product_price' => [
            'id' => $productDetails->id,
            'listing_name' => $productDetails->listing_name,
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
        return view('product_list', compact('data'));
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
                  ->orWhere('pd.listing_name', 'LIKE', "%{$search}%");
        })
        ->select(
            'p.id',
            'p.name as product_name',
            'pd.listing_name',
            'c.name as category_name',
            'c.file as category_image',
            'g.file as product_image'

        )
        ->groupBy('p.id', 'p.name', 'pd.listing_name', 'c.name','category_image','product_image')
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



}

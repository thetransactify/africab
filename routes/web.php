<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
//start admin 



Route::get('/tsfy-admin', function () {
    return view('admin.index'); // loads resources/views/admin/index.blade.php
});
//Route::prefix('admin')->group(function () {
    // Route::get('/africabe-shop/admin/', function () {
    //     return view(' Admin.index');  // Correct path
    // })->name('admin.index');
//});

// login
Route::prefix('/tsfy-admin')->group(function () {
Route::get('/login', [LoginController::class, 'Showlogin'])->name('login');
Route::post('/logins', [LoginController::class, 'LoginCreadintial']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/forget-password', [LoginController::class, 'ForgetPassword']);
// Route::post('/forgot-passwords', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');
// Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
// Route::post('/reset-password', [LoginController::class, 'reset'])->name('password.update');




Route::middleware(['auth'])->group(function () {
//Dashboard
Route::get('/dashboard', [DashboardController::class, 'GetDashboard']);

//Category
Route::get('/manage-profile', [DashboardController::class, 'ManageProfile']);
Route::post('/update-profile', [DashboardController::class, 'UpdateProfile']);
Route::get('/create-category', [CategoryController::class, 'showcategory']);
Route::get('/view-category', [CategoryController::class, 'Viewcategory'])->name('category.list');
Route::post('/post-category', [CategoryController::class, 'CreateCategory']);
Route::get('edit-category/{id}', [CategoryController::class, 'EditCategory'])->name('category.edit');
Route::post('/update-category/{id}', [CategoryController::class, 'UpdateCategory'])->name('category.update');
Route::get('/delete-category/{id}', [CategoryController::class, 'DeleteCategory'])->name('category.delete');
// product
Route::get('/create-subcategory', [CategoryProductController::class, 'showProduct']);
Route::get('/view-subcategory', [CategoryProductController::class, 'ViewProduct'])->name('prodcut.view');
Route::post('/post-product', [CategoryProductController::class, 'CreateProduct']);
Route::get('edit-SubCategories/{id}', [CategoryProductController::class, 'EditProduct'])->name('product.edit');
Route::post('/update-product/{id}', [CategoryProductController::class, 'UpdateProduct'])->name('product.update');
Route::get('/delete-category/{id}', [CategoryProductController::class, 'DeleteProduct'])->name('product.delete');
Route::get('/product-price', [CategoryProductController::class, 'ProdcutPriceList'])->name('get.productlist');
Route::get('/get-products/{category_id}', [CategoryProductController::class, 'getProducts'])->name('get.products');
Route::post('/add-productlist', [CategoryProductController::class, 'CreateProductList']);
Route::get('/edit-productlist/{id}', [CategoryProductController::class, 'EditProductList']);
Route::post('/update-productlist/{id}', [CategoryProductController::class, 'UpdateProductList'])->name('category.productprice');
Route::get('/delete-productlist/{id}', [CategoryProductController::class, 'DeleteProductList'])->name('productlist.delete');

Route::get('/product-permission', [CategoryProductController::class, 'GetPermission']);
Route::get('/product-orders', [CategoryProductController::class, 'GetOrders']);
Route::post('/products-permission/{id}/toggle-visibility', [CategoryProductController::class, 'toggleVisibility']);

//Product Gallery
Route::get('/product-gallery', [CategoryProductController::class, 'ProdcutGallery'])->name('get.productgallery');
Route::post('/post-gallery', [CategoryProductController::class, 'CreateGallery']);
Route::get('/delete-gallery/{id}', [CategoryProductController::class, 'Deletegallery'])->name('product.gallery');


//Admin Review
Route::get('/review-list', [ClientController::class, 'ShowReview'])->name('get.ShowReview');
Route::get('/get-review/{id}', [ClientController::class, 'getReview']);
Route::get('/delete-reviews/{id}', [ClientController::class, 'Deletereviews'])->name('review.delete');
Route::post('/update-review-status', [ClientController::class, 'updateStatus']);
Route::get('/moderated-review', [ClientController::class, 'ModeratedReview'])->name('get.ShowModeratedReview');
// Admin client list
Route::get('/customer-manage', [CategoryProductController::class, 'Getcustomer'])->name('get.GetCustomer');
Route::get('/customer-summary', [CategoryProductController::class, 'Getsummary'])->name('get.Getsummary');
Route::get('/customer-wishlist', [CategoryProductController::class, 'Getwishlist'])->name('get.Getwishlist');
Route::post('/customers/{id}/toggle-status', [CategoryProductController::class, 'toggleStatus']);
Route::post('/customer-orders', [CategoryProductController::class, 'fetchOrders'])->name('customer.orders');
Route::post('/customer/wishlists', [CategoryProductController::class, 'fetchWishlist'])->name('customer.wishlist');

//Admin Homepage
Route::get('/homepage', [HomeController::class, 'GetHomepage'])->name('get.GetHomepage');
Route::post('/post-homepage', [HomeController::class, 'CreateHomepage'])->name('get.CreateHomepage');
Route::get('/delete-homepage/{id}', [HomeController::class, 'Deletehomepage'])->name('homepage.delete');
// home ads
Route::get('/advertisement', [HomeController::class, 'Getadvertisement'])->name('get.advertisement');
Route::post('/post-advertisement', [HomeController::class, 'Createadvertisement'])->name('create.advertisement');
Route::get('/delete-advertisement/{id}', [HomeController::class, 'Deleteadvertisement'])->name('advertisement.delete');

// Admin banner
Route::get('/brand', [HomeController::class, 'Getbrand'])->name('get.Getbrand');
Route::post('/post-brand', [HomeController::class, 'CreateBrand'])->name('get.CreateBrand');
Route::get('/delete-brand/{id}', [HomeController::class, 'Deletebrand'])->name('brand.delete');

//question ans 
Route::get('/frequently-asked-questions', [HomeController::class, 'Getfasq'])->name('get.Getfasq');
Route::post('/post-fasq', [HomeController::class, 'Createfasq'])->name('get.Createfasq');
Route::get('/delete-fasq/{id}', [HomeController::class, 'Deletefasq'])->name('fasq.delete');


// end admin
});

});

//start client 
// Route::get('/', function () {
//     return view('index'); // loads resources/views/admin/index.blade.php
// });
Route::get('/', [HomeController::class, 'GetClientHomepage'])->name('get.Getfasq');
Route::get('/index', [HomeController::class, 'GetClientHomepage'])->name('get.Getfasq');
Route::get('/product-category/{slug}', [CategoryProductController::class, 'Clientshow'])->name('product-category.show');
Route::get('/product/{slug}', [CategoryProductController::class, 'GetProduct'])->name('product.shows');
Route::get('/reviews', [ClientController::class, 'ClientReviews'])->name('ClientReviews.shows');


Route::get('/login', [LoginController::class, 'ClientLogin'])->name('get.ClientLogin');
Route::post('/clientlogins', [LoginController::class, 'ClientLoginCreadintial']);
Route::get('/logouts', [LoginController::class, 'clientlogout']);
Route::get('/change-password', [LoginController::class, 'ChangePassword']);

Route::post('/forgot-passwords-client', [LoginController::class, 'sendResetLinkEmailClient'])->name('client.password.email');
Route::get('/reset-password-client/{token}', [LoginController::class, 'showResetFormClient'])->name('password.reset');
Route::post('/reset-password', [LoginController::class, 'resetClient'])->name('password.updateClient');
Route::get('/register', [LoginController::class, 'getregister']);
Route::post('/post-register', [LoginController::class, 'postregister']);
Route::get('/search-products', [CategoryProductController::class, 'search'])->name('search.products');


Route::middleware(['auth'])->group(function () {
Route::get('/my-account', [ClientController::class, 'MyAccount'])->name('MyAccount.shows');
Route::get('/order-history', [ClientController::class, 'Orderhistory'])->name('Orderhistory.shows');
Route::get('/my-wishlist', [ClientController::class, 'MyWishlist'])->name('MyWishlist.shows');
Route::get('/manage-address', [ClientController::class, 'ManageAddress'])->name('ManageAddress.shows');
Route::get('/edit-profile', [ClientController::class, 'EditProfile'])->name('edit-profile.shows');
Route::post('/profile/update', [ClientController::class, 'update'])->name('profile.update');

Route::get('/change-password', [LoginController::class, 'ChangePasswords'])->name('profile.password');
Route::get('/wishlist/add/{id}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist/delete/{id}', [WishlistController::class, 'delete'])->name('wishlist.delete');

});
Route::get('/support-centre', [ClientController::class, 'SupportCentre'])->name('SupportCentre.shows');
//end client
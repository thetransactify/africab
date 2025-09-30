<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReminderController;

//start admin 
Route::get('/tsfy-admin', function () {
    return view('Admin.index'); // loads resources/views/admin/index.blade.php
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




Route::middleware(['auth', 'role:2'])->group(function () {
//Dashboard
Route::get('/dashboard', [DashboardController::class, 'GetDashboard']);
Route::get('/Dashboard-Orders/{id}', [DashboardController::class, 'DashboardOrders'])->name('Dashboard-Orders');
Route::post('/orders/update-group', [DashboardController::class, 'updateGroup'])->name('orders.updateGroup');

//Category
Route::get('/manage-profile', [DashboardController::class, 'ManageProfile']);
Route::post('/update-profile', [DashboardController::class, 'UpdateProfile']);
Route::get('/create-category', [CategoryController::class, 'showcategory']);
Route::get('/view-category', [CategoryController::class, 'Viewcategory'])->name('category.list');
Route::post('/post-category', [CategoryController::class, 'CreateCategory']);
Route::get('edit-category/{id}', [CategoryController::class, 'EditCategory'])->name('category.edit');
Route::post('/update-category/{id}', [CategoryController::class, 'UpdateCategory'])->name('category.update');
Route::get('/delete-categorys/{id}', [CategoryController::class, 'DeleteCategory'])->name('category.delete');
// product
Route::get('/create-subcategory', [CategoryProductController::class, 'showProduct']);
Route::get('/view-subcategory', [CategoryProductController::class, 'ViewProduct'])->name('prodcut.view');
Route::post('/post-product', [CategoryProductController::class, 'CreateProduct']);
Route::get('edit-SubCategories/{id}', [CategoryProductController::class, 'EditProduct'])->name('product.edit');
Route::post('/update-product/{id}', [CategoryProductController::class, 'UpdateProduct'])->name('product.update');
Route::get('/delete-category/{id}', [CategoryProductController::class, 'DeleteProduct'])->name('product.delete');
Route::get('/product-price', [CategoryProductController::class, 'ProdcutPriceList'])->name('get.productlists');
Route::get('/get-products/{category_id}', [CategoryProductController::class, 'getProducts'])->name('get.products');
Route::get('/get-subcategiores/{category_id}', [CategoryProductController::class, 'subcategiores'])->name('get.productssd');
Route::get('/get-productslist/{category_id}', [CategoryProductController::class, 'getProductlist'])->name('get.productlist');
Route::post('/add-productlist', [CategoryProductController::class, 'CreateProductList']);
Route::get('/edit-productlist/{id}', [CategoryProductController::class, 'EditProductList']);
Route::post('/update-productlist/{id}', [CategoryProductController::class, 'UpdateProductList'])->name('category.productprice');
Route::get('/delete-productlist/{id}', [CategoryProductController::class, 'DeleteProductList'])->name('productlist.delete');

Route::get('/product-permission', [CategoryProductController::class, 'GetPermission']);
Route::get('/product-orders', [CategoryProductController::class, 'GetOrders']);
Route::post('/products-permission/{id}/toggle-visibility', [CategoryProductController::class, 'toggleVisibility']);

Route::get('/add-product', [CategoryProductController::class, 'GetExcelProduct']);
Route::post('/add-excel-product', [CategoryProductController::class, 'AddExcelProduct'])->name('GetExcelProduct.product');
// excelSheet
Route::get('/google-sheet', [ClientController::class, 'getExcelSheet'])->name('getExcelSheet');
Route::post('/sync-sheet1', [ClientController::class, 'FirstExcelSheet'])->name('excel.FirstExcelSheet');
Route::get('/sync-sheet2', [ClientController::class, 'SecondExcelSheet'])->name('excel.SecondExcelSheet');

// offer list start
Route::get('/manage-offers', [CategoryProductController::class, 'ProdcutOffer'])->name('get.ProdcutOffer');
Route::post('/add-productoffers', [CategoryProductController::class, 'CreateProductListoffers']);
Route::get('/delete-offers/{id}', [CategoryProductController::class, 'DeleteOffersProductList'])->name('productlistoffers.delete');
Route::get('/edit-offers/{id}', [CategoryProductController::class, 'EditProductOffersList']);
Route::post('/update-productlistoffers/{id}', [CategoryProductController::class, 'UpdateProductOffersList'])->name('category.productpriceOffers');
// offer list end
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
// cart reminder 
Route::get('/cart-reminder', [ReminderController::class, 'Getcartreminder'])->name('get.Getcartreminder');
Route::post('/customer/cartreminder', [ReminderController::class, 'fetchcartreminder'])->name('customer.cartreminder');
Route::post('/cart-reminder/email', [ReminderController::class, 'sendEmail'])->name('customer.emailreminder');
Route::post('/cart-remindersms/sms', [ReminderController::class, 'sendSms'])->name('customer.sendSms');
Route::post('/wishlist/send-emails', [ReminderController::class, 'sendEmails'])
    ->name('wishlist.sendEmails');

// save to cart
Route::get('/save-to-cart', [ReminderController::class, 'GetSaveToCart'])->name('get.GetSaveToCart');
Route::post('/savetocart/send-emails', [ReminderController::class, 'sendEmailSavecart'])
    ->name('savetocart.sendEmailSavecart');


Route::post('/customers/{id}/toggle-status', [CategoryProductController::class, 'toggleStatus']);
Route::post('/customer-orders', [CategoryProductController::class, 'fetchOrders'])->name('customer.orders');
Route::post('/customer/wishlists', [CategoryProductController::class, 'fetchWishlist'])->name('customer.wishlist');
// upload video
Route::get('/upload-video', [CategoryProductController::class, 'GetUploadvideo'])->name('get.GetUploadvideo');
Route::post('/post-video', [CategoryProductController::class, 'CreateUploadvideo'])->name('get.CreateUploadvideo');
Route::get('/delete-url/{id}', [CategoryProductController::class, 'Deleteurl'])->name('url.delete');
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

//shhiping zone 
Route::get('/shipping-zone', [WishlistController::class, 'Getshipping'])->name('get.shipping');
 Route::post('/post-shipping', [WishlistController::class, 'Createshipping'])->name('get.Createshipping');
 Route::get('/delete-shipping/{id}', [WishlistController::class, 'Deleteshipping'])->name('product.gallery');
// store list 
Route::get('/shop-list', [WishlistController::class, 'Getshop'])->name('get.Getfasq');
Route::post('/post-shop', [WishlistController::class, 'Createshop'])->name('get.Createshop');
Route::get('/delete-shop/{id}', [WishlistController::class, 'Deleteshop'])->name('product.shop');
// Product Positioning
Route::get('/product-positioning', [WishlistController::class, 'GetProductPostion'])->name('get.ProductPositioning');
Route::post('/post-productpositioning', [WishlistController::class, 'CreateProductPostion'])->name('get.CreateProductPostion');
Route::get('/product-positioning/{id}', [WishlistController::class, 'Deletepositioning'])->name('product.positioning');
//product tracker
Route::get('/popular-product', [WishlistController::class, 'GetPopularProduct'])->name('get.PopularProduct');
// end admin
});

});

//start client 
// Route::get('/', function () {
//     return view('index'); // loads resources/views/admin/index.blade.php
// });
Route::get('/', [HomeController::class, 'GetClientHomepagessss'])->name('get.Getfasqss');
Route::get('/index', [HomeController::class, 'GetClientHomepagessss'])->name('get.Getfasqss');

Route::get('/testing', [HomeController::class, 'GetClientHomepage'])->name('get.Getfasq');
Route::get('/test', [HomeController::class, 'GetClientHomepage'])->name('get.Getfasq');
Route::get('/product-category/{slug}', [CategoryProductController::class, 'Clientshow'])->name('product-category.show');
Route::get('/product/{slug}', [CategoryProductController::class, 'GetProduct'])->name('product.shows');
Route::get('/offerlist/{label}', [CategoryProductController::class, 'showOffer'])->name('offerlist.show');

Route::get('/reviews', [ClientController::class, 'ClientReviews'])->name('ClientReviews.shows');
Route::get('/offers', [ClientController::class, 'OffersDatils'])->name('offers.shows');

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


Route::middleware(['auth','role:1'])->group(function () {
Route::get('/my-account', [ClientController::class, 'MyAccount'])->name('MyAccount.shows');
Route::get('/order-history', [ClientController::class, 'Orderhistory'])->name('Orderhistory.shows');
Route::get('/my-wishlist', [ClientController::class, 'MyWishlist'])->name('MyWishlist.shows');
Route::get('/manage-address', [ClientController::class, 'ManageAddress'])->name('ManageAddress.shows');
Route::get('/edit-profile', [ClientController::class, 'EditProfile'])->name('edit-profile.shows');
Route::post('/profile/update', [ClientController::class, 'update'])->name('profile.update');

Route::get('/change-password', [LoginController::class, 'ChangePasswords'])->name('profile.password');
Route::get('/wishlist/add/{id}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist/delete/{id}', [WishlistController::class, 'delete'])->name('wishlist.delete');
Route::post('/add-reviews', [ClientController::class, 'AddReviews'])->name('addReviews.shows');

Route::get('/cart', [CartController::class, 'GetCart'])->name('cart.get');
Route::post('/add-cart', [CartController::class, 'CreateCart'])->name('cart.create');
Route::get('/cart-delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');
Route::get('/checkout', [CartController::class, 'GetCheckout'])->name('checkout.get');
Route::post('/address/store', [CartController::class, 'store'])->name('address.store');
Route::get('/address/delete/{id}', [CartController::class, 'DeleteAddress'])->name('address.delete');
Route::post('/checkout/cod', [CartController::class, 'codCheckout'])->name('checkout.cod');

Route::get('/order-status', [CartController::class, 'orderStatus'])->name('order.success');

Route::get('/cart-save-later/{id}', [CartController::class, 'saveForLater']); 
Route::get('/move-to-cart/{id}', [CartController::class, 'moveToCart']); 
Route::get('/save-later-delete/{id}', [CartController::class, 'SaveToCartdestroy'])->name('save.delete');

});
Route::get('/support-centre', [ClientController::class, 'SupportCentre'])->name('SupportCentre.shows');
// payment method
Route::get('/selcom-test', [ClientController::class, 'createOrderSelcoms']);
Route::post('/payment', [PaymentController::class, 'createOrderSelcom'])->name('selcom.create.order');
Route::get('/payment-page', [PaymentController::class, 'paymentPage'])->name('payment.page');
Route::get('/payment-cancel/{order}', [PaymentController::class, 'cancelPayment'])->name('payment.cancel');
Route::post('/payment-callback', [PaymentController::class, 'paymentCallback'])->name('payment.callback');
Route::get('/privacy-policy', [ClientController::class, 'privacyPolicy']);


Route::get('/test-smtp', function () {
    try {
        Mail::raw('This is a test email to check SMTP configuration.', function ($message) {
            $message->to('vivekdeveloper3232@gmail.com')
                    ->subject('SMTP Test Email');
        });
        return 'Email sent successfully. Check your inbox.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
//end client


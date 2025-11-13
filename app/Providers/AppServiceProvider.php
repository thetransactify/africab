<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Homeslider;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\shipping;
use App\Models\ProductGallery;
use App\Models\offerlist;
use Illuminate\Support\Facades\DB;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
            Schema::defaultStringLength(191);

    View::composer(['layout.header','layout.navigation'], function ($view) {
        $cartCount = 0;
        if (Auth::check()) {
            $cartCount = DB::table('carts')->where('user_id', Auth::id())->count();
        }
        $view->with([
            'homeslider' => Homeslider::latest()->take(3)->get(),
            'Categories' => Category::where('status',1)->get(),
            'offerlist' => offerlist::where('product_online',1)->get(),
            'message' => 'Welcome to MySite!',
            'cartCount' => $cartCount,
        ]);
    });

    View::creator('layout.footer', function ($view) {
    if (Auth::check()) {
        $user = Auth::user();
        $wishlist = DB::table('carts as w')
        ->join('product_details as pp', 'w.product_id', '=', 'pp.id')
        ->leftJoin(DB::raw('
            (
                SELECT pg1.*
                FROM product_gallery pg1
                INNER JOIN (
                    SELECT product_id, MAX(id) as max_id
                    FROM product_gallery
                    GROUP BY product_id
                ) latest_pg ON pg1.id = latest_pg.max_id
            ) as pg
        '), 'w.product_id', '=', 'pg.product_id')
        ->where('w.user_id', $user->id)
        ->select(
            'w.*',
            'w.product_id',
            'pp.description',
            'pp.listing_name',
            'pp.offer_price',
            'pp.code',
            'pp.product_cost',
            'pg.file as file'
        )
        ->get();

        \Log::info('User Wishlist:', $wishlist->toArray());

    }else {
         $wishlist = collect();
    }
    $view->with([
        'wishlist' => $wishlist,
        'cartCount' => $wishlist->count(),
    ]);
    });


    View::creator('layout.footer', function ($view) {
        $view->with([
            'shipping' => shipping::orderbydesc('id')->get(),
            'message' => 'Welcome to MySite!'
        ]);
    });


    }
}

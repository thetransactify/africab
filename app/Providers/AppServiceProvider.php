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
use App\Models\ProductGallery;
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

    View::creator('layout.header', function ($view) {
        $view->with([
            'homeslider' => Homeslider::latest()->take(3)->get(),
            'Categories' => Category::where('status',1)->get(),
            'message' => 'Welcome to MySite!'
        ]);
    });

    View::creator('layout.footer', function ($view) {
    if (Auth::check()) {
        $user = Auth::user();
        $wishlist = DB::table('wishlists as w')
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
        '), 'w.product_id', '=', 'pg.product_id') // latest image per product
        ->where('w.user_id', $user->id)
        ->select(
            'w.*',
            'w.product_id',
            'pp.description',
            'pp.listing_name',
            'pp.offer_price',
            'pp.product_cost',
            'pg.file as file'
        )
        ->get();

                \Log::info('User Wishlist:', $wishlist->toArray());

    }else {
         $wishlist = collect();
    }
    $view->with('wishlist', $wishlist);
    });


    // View::composer('layout.footer', function ($view) {
    //    if (Auth::check()) {
    //     $categories = Category::where('status', 1)->take(5)->get();
    // } else {
    //     $categories = collect();
    // }

    // dd($categories); // <-- Debug output

    // $view->with([
    //     'footerCategories' => $categories,
    // ]);
    // });


    }
}

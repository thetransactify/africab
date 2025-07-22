<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPrice extends Model
{
    //
    use HasFactory;
    protected $table = 'product_details';

    protected $fillable = [
        'product_id',
        'category_id',
        'listing_name',
        'description',
        'packing_weight',
        'packing_type',
        'product_cost',
        'offer_price',
        'product_online',
        'status',
        'created_at',
        'updated_at',
    ];

    public function category(){
    return $this->belongsTo(Category::class, 'category_id');
    }

    public function product(){
    return $this->belongsTo(Product::class, 'product_id');
    }

    public function orders(){
    return $this->hasMany(Orders::class, 'product_id');
    }

    public function galleries() {
    return $this->hasMany(ProductGallery::class,'product_id');
    }

    public function reviews() {
    return $this->hasMany(Review::class,'product_id');
    }

    

}

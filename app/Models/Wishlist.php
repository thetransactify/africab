<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    //
     use HasFactory;
    protected $table = 'wishlists';

    protected $fillable = [
    	'user_id',
        'product_id',
        'created_at',
        'updated_at',
    ];

    public function Product(){
    return $this->belongsTo(Product::class, 'product_id');
    }

    public function productPrice()
{
    return $this->belongsTo(ProductPrice::class, 'product_id', 'id');
}


    public function users(){
    return $this->belongsTo(User::class, 'user_id');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

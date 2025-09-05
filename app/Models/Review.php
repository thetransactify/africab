<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    //
      use HasFactory;
    protected $table = 'reviews';

    protected $fillable = [
        'product_id',
        'user_id',
        'comment',
        'rating',
        'status',
        'created_at',
        'updated_at',
    ];

    public function Product(){
    return $this->belongsTo(ProductPrice::class, 'product_id');
    }

    public function users(){
    return $this->belongsTo(User::class, 'user_id');
    }

     public function productprice(){
    return $this->belongsTo(ProductPrice::class, 'product_id');
    }
}

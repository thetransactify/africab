<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class popularProducts extends Model
{
    //

    use HasFactory;
    protected $table = 'products_tracker';

    protected $fillable = [
        'product_id',
        'count',
        'created_at',
        'updated_at',
    ];

    public function Product(){
    return $this->belongsTo(ProductPrice::class, 'product_id');
    }
} 

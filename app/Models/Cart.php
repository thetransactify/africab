<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Cart extends Model
{
    //
    use HasFactory;
    protected $table = 'carts';

    protected $fillable = [
        'user',
        'user_id',
        'product_id',
        'price',
        'quantity',
        'created_at',
        'updated_at',
    ];

    public function product(){
    return $this->belongsTo(ProductPrice::class, 'product_id');
    }



}

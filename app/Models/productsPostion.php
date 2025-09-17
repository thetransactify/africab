<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class productsPostion extends Model
{
    use HasFactory;
    protected $table = 'product_sections';

    protected $fillable = [
        'product_id',
        'position',
        'created_at',
        'updated_at',
    ];

    public function Product(){
    return $this->belongsTo(ProductPrice::class, 'product_id');
    }
}


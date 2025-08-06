<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    //
     use HasFactory;
    protected $table = 'product';

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'page_title',
        'page_description',
        'file',
        'status',
        'check_remark',
        'created_at',
        'updated_at',
    ];

    public function category(){
    return $this->belongsTo(Category::class, 'category_id');
    }

    public function productPrices(){
    return $this->hasMany(ProductPrice::class, 'product_id');
    }

    public function productDetails(){
        return $this->hasMany(ProductPrice::class, 'product_id');
    }
    
}

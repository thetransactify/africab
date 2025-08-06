<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class offerlist extends Model
{
    //
         use HasFactory;
    protected $table = 'products_offers';

    protected $fillable = [
        'label',
        'category_id',
        'subcategory_id',
        'proudct_deatils_id',
        'product_online',
        'created_at',
        'updated_at',
    ];

    public function category(){
    return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory(){
    return $this->belongsTo(Product::class, 'subcategory_id');
    }

    public function productDetails(){
        return $this->belongsTo(ProductPrice::class, 'proudct_deatils_id');
    }
}

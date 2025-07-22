<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductGallery extends Model
{
    //
    use HasFactory;
    protected $table = 'product_gallery';

    protected $fillable = [
        'category_id',
        'product_id',
        'label',
        'file',
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

}

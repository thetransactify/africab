<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecentViews extends Model
{
    // 
    use HasFactory;
    protected $table = 'recent_views';

    protected $fillable = [
        'user_id',
        'product_id',
        'created_at',
        'updated_at',
    ];

    public function productprice(){
       return $this->belongsTo(ProductPrice::class, 'product_id');
    }

      public function galleries() {
    return $this->hasMany(ProductGallery::class,'product_id');
    }
}

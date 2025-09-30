<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SaveToLater extends Model
{
    // 
    //
    use HasFactory;
    protected $table = 'saved_products';

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'color',
        'price',
        'created_at',
        'updated_at',
    ];

    public function product(){
    return $this->belongsTo(ProductPrice::class, 'product_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

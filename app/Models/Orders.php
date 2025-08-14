<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    //
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
    	'user_id',
        'product_id',
        'quantity',
        'order_group_id',
        'order_number',
        'shipping_charge',
        'total_amount',
        'payment_status',
        'method',
        'order_status',
        'color',
        'billing_address',
        'shipping_address',
        'created_at',
        'updated_at',
    ];

    public function users(){
    return $this->belongsTo(User::class, 'user_id');
    }

    public function product(){
    return $this->belongsTo(Product::class, 'product_id');
    }

    public function products(){
    return $this->belongsTo(ProductPrice::class, 'product_id');
    }

    

}

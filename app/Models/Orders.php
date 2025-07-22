<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    //
    use HasFactory;
    protected $table = 'Orders';

    protected $fillable = [
    	'user_id',
        'product_id',
        'order_number',
        'total_amount',
        'payment_status',
        'method',
        'order_status',
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

    

}

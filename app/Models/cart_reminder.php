<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class cart_reminder extends Model
{
    // 
    use HasFactory;
    protected $table = 'cart_reminder';

    protected $fillable = [
        'cart_id',
        'user_id',
        'product_id',
        'sms_count',
        'email_count',
        'created_at',
        'updated_at'
    ];
}

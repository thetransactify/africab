<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_group_id',
        'payment_status',
        'custom_message',
        'created_by',
    ];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

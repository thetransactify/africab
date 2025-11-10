<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderUpdate extends Model
{
    use HasFactory;

    protected $table = 'order_update';

    protected $fillable = [
        'order_group_id',
        'order_status',
        'payment_status',
        'shipper_name',
        'tracking_no',
        'custom_message',
        'created_by',
        'updated_at'
    ];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

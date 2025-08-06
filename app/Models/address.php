<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class address extends Model
{
    //
    use HasFactory;
    protected $table = 'address';

    protected $fillable = [
        'user_id',
        'label',
        'name',
        'home_address',
        'office_address',
        'other_address',
        'region_id',
        'mobile_no',
        'pincode',
        'created_at',
        'updated_at',
    ];

    public function userlist(){
    return $this->belongsTo(user::class, 'id');
    }

    public function shippinglist(){
    return $this->belongsTo(shipping::class, 'region_id');
    }
}

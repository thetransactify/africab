<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class shipping extends Model
{
    //
    use HasFactory;
    protected $table = 'shipping_zone';

    protected $fillable = [
        'name',
        'price',
        'created_at',
        'updated_at',
    ];
}

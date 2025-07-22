<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Homeslider extends Model
{
    //
         use HasFactory;
    protected $table = 'homeslider';

    protected $fillable = [
        'banner',
        'file',
        'created_at',
        'updated_at',
    ];
}

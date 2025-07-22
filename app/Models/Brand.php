<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    //
    use HasFactory;
    protected $table = 'brand';

    protected $fillable = [
        'name',
        'brand_tagline',
        'brand_website',
        'description',
        'file',
        'created_at',
        'updated_at'
    ];
}

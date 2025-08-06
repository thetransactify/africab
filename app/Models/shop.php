<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class shop extends Model
{ 
    //
    use HasFactory;
    protected $table = 'shop';

    protected $fillable = [
        'name',
        'address',
        'created_at',
        'updated_at',
    ];
}

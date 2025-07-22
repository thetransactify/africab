<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class advertisement extends Model
{
    //

    use HasFactory;
    protected $table = 'advertisement';

    protected $fillable = [
        'ads_no',
        'file'
    ];
}

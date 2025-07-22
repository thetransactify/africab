<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class faqs extends Model
{
    //
    use HasFactory;
    protected $table = 'faqs';

    protected $fillable = [
        'question',
        'answer',
        'created_at',
        'updated_at'
    ];
}

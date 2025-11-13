<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxFormula extends Model
{
    use HasFactory;

    protected $fillable = [
        'txn_value',
    ];
}

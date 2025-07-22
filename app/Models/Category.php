<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    //
    use HasFactory;
    protected $table = 'category';

    protected $fillable = [
        'name',
        'description',
        'page_title',
        'page_description',
        'file',
        'status',
        'created_at',
        'updated_at',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function ProductDeatils(): HasMany
    {
        return $this->hasMany(ProductPrice::class);
    }
}

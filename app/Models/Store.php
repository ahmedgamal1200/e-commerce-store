<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo_image' ,
        'cover_image',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }
}

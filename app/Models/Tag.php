<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug'
    ];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

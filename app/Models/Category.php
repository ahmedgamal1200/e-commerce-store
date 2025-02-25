<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'status',
        'image',
        'slug'
    ];

    public function scopeActive(Builder $builder): void
    {
        $builder->where('status', '=', 'active');
    }
    public function scopeFilter(Builder $builder, $filters): void
    {
        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where('categories.name', 'LIKE', "%{$value}%");
        });
        $builder->when($filters['status'] ?? false, function ($builder, $value) {
            $builder->where('categories.status', '=', $value);
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
        ->withDefault([
            'name' => '_'
        ]);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products(): HasMany
    {
        // one to many اكتر من بروديكت مرتبط ب category واحد
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

}

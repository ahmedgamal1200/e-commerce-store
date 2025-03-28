<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected  $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'price',
        'compare_price',
        'status',
        'category_id',
        'store_id'
    ];

    protected $hidden = [
        'image', 'created_at', 'updated_at', 'deleted_at'
    ];

    protected $appends = [
        'image_url',
    ];
    protected static function booted(): void
    {
        static::addGlobalScope('store', new StoreScope());

        static::creating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
                 Tag::class, // Related Model
                   'product_tag', // Pivot table name
            'product_id', // FK in pivot table for the current model
            'tag_id',     //FK in pivot table for the related model
                  'id',       // PK current model
                  'id',       // Pk related model
                                        // todo: ده في حالة انا اسماء التيبولز مختلفة
        );

    }

    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('status', '=', 'active');
    }

    // Accessors -> get...Attribute

    /*
     * 1- لو المنتج ملهوش صورة حط الصورة الافتراضية
     * 2- لو لينك الصورة بيدأ ب http.. رجع الصورة
     * 3- غير كده رجعها من الاستوريتج
     */
    public function getImageUrlAttribute(): string
    {
        if(!$this->image){
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startswith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getSalePercentAttribute(): float
    {
        if(!$this->compare_price){
            return 0;
        }
        return round(100 - (100 * $this->price / $this->compare_price), 1); // round عشان اتحكم في الكسور
    }

    public function scopeFilter(Builder $builder, $filters): void
    {
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'tag_id' => null,
            'status' => 'active',
        ], $filters);

        $builder->when($options['status'], function ($query, $status){
            return $query->where('status', '=', $status);
        });

        $builder->when($options["store_id"], function ($builder, $value) {
            $builder->where('store_id', $value);
        });
        $builder->when($options["category_id"], function ($builder, $value) {
            $builder->where('category_id', $value);
        });

        $builder->when($options["tag_id"], function ($builder, $value) {
            $builder->whereExists(function ($query) use ($value) {
                $query->select(1)
                    ->from('product_tag')
                    ->whereRaw('product_id = products.id')
                    ->where('tag_id', $value);
            });
        });
    }
}

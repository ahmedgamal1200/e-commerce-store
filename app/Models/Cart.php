<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Cart extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'cookie_id', 'user_id', 'product_id', 'quantity', 'options',
    ];

    // Events (observers)
    // creating, created, updated, updating, saving, saved
    // deleting, deleted, restoring, restored, retrieved

    protected static function booted(): void
    {
        static::observe(CartObserver::class);

        static::addGlobalScope('cookie_id',  function(Builder $builder){
            $builder->where('cookie_id', '=', Cart::getCookieId());
        });
//        static::creating(function (Cart $cart) {
//            $cart->id = Str::uuid(); // creating random uuid
//    });
    }

    public static function getCookieId(): array|string|null
    {
        $cookie_id = Cookie::get('cart_id');
        if(!$cookie_id){
            $cookie_id = (string) Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60); // 30days
        }
        return $cookie_id;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Anonymous',
        ]);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

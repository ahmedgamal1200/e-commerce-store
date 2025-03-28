<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Listeners\DeductProductQuantity;
use App\Listeners\EmptyCart;
use App\Listeners\SendOrderCreatedNotification;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping(); // عشان الغي اk response api يرجع في array data[]
        Paginator::useBootstrapFour();

//        Event::listen(
//        'order.created', [
//            DeductProductQuantity::class, 'handle',
//            EmptyCart::class, 'handle'],
//        );
            Event::listen(OrderCreated::class, [DeductProductQuantity::class, 'handle']);
//            Event::listen(OrderCreated::class,  [EmptyCart::class, 'handle']);
            Event::listen(SendOrderCreatedNotification::class, 'handle');
    }
}

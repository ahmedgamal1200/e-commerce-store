<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Throwable;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        //Update products SET quantity = quantity - 1

        try {
        foreach($order->products as $product) {
            $product->decrement('quantity', $product->pivot->quantity);

//            Product::query()->where('id', '=', $item->product_id)
//                ->update([
//                    'quantity' => DB::raw("quantity - {$item->quantity}" ) // عشان لوعملتله 'quantity - 1' هيفهما انها استرنج
//                ]);
        }
    }catch (Throwable $e){
            throw $e;
        }
    }
}

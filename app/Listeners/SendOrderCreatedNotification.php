<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;

class SendOrderCreatedNotification
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
//        $store = $event->order->store();
        $order = $event->order;

        // send mails to single user
        $user = User::query()->where('store_id', '=', $order->store_id)->first();
        if($user)
        {
            $user->notify(new OrderCreatedNotification($order));
        }

        // send mails to collection of users
//        $users = User::query()->where('store_id', $order->store_id)->get();
//        $user->send($users, new OrderCreatedNotification($order));


    }
}

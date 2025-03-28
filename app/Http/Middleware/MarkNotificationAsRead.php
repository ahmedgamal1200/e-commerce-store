<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        dd(Auth::id());
        $notification_id = $request->query('notification_id');
        if($notification_id) {
            $user = $request->user();
//            dd($user);
            if($user) {
                $notification = $user->unreadNotifications()->find($notification_id);
                if($notification) {
                    $notification->markAsRead();
                }
            }
        }
        return $next($request);
    }
}

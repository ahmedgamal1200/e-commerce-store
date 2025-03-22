<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserLastActiveAt
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $excludedRoutes = ['login', 'register'];

        if($request->is($excludedRoutes))
        {
            return $next($request);
        }
        $user = $request->user();
//        dd($request->user());
        if($user){
            // forceFill to added in database without $fillable
            $user->forceFill([
                'last_active_at' => Carbon::now(),
            ])
            ->save();
        }
        return $next($request);
    }
}

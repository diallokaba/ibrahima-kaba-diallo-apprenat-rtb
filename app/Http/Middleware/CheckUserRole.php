<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->attributes->get('user');
        $role = $user['role'];
        if(!$role){
            return response()->json(['message' => 'No role found for this user'], 401);
        }
        if(!in_array($role, $roles)){
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $next($request);
    }
}

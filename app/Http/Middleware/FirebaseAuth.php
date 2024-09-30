<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Kreait\Firebase\Exception\Auth\InvalidToken; 
use App\Facades\FirebaseAuthFacade as FirebaseService;
use App\Models\UserFirebase;

class FirebaseAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        if(!$token){
            return response()->json(['message' => 'Token not provided'], 401);
        }
        try{
            $firebaseAuth = FirebaseService::createAuth();
            $verifiedIdToken = $firebaseAuth->verifyIdToken($token);
            $firebaseUser = $verifiedIdToken->claims();
            $user = UserFirebase::findByKeyValue('uid', $firebaseUser->get('user_id'));
            if(!$user){
                return response()->json(['message' => 'User not found'], 401);
            }
            $request->attributes->set('user', $user);
        }catch(InvalidToken $invalidToken){
            return response()->json(['message' => 'Invalid Token ' . $invalidToken->getMessage()], 401);
        }
        
        return $next($request);
    }
}

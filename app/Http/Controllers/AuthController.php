<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Facades\FirebaseAuthFacade as FirebaseService;

class AuthController extends Controller
{

    public function __construct(){
    }

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        try {

            $firebaseToken = FirebaseService::generateToken($credentials['email'], $credentials['password']);
            if($firebaseToken){
                return response()->json(['connexion' => 'firestore', 'token' => $firebaseToken], 200);
            }
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
            return response()->json(['error' => 'Login ou mot de passe incorrect : ' . $e->getMessage()], 401);
        }
    }
}

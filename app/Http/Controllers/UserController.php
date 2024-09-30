<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Facades\UserServiceFacade as UserService;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $user = UserService::create($request->all());
        return response()->json(["data" => $user, "message" => "Utilisateur crée avec succès"], 201);
    }

    public function index(Request $request){
        $users = UserService::query($request);
        return response()->json(["users" => $users], 200);
    }
}

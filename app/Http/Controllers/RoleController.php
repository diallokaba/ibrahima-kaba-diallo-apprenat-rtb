<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;

use App\Facades\RoleServiceFacade as RoleService;

class RoleController extends Controller
{
    public function store(RoleRequest $request){
        $role = $request->all();
        return response()->json(["data" => RoleService::create($role), "message" => "Role ajoute avec succès"], 201);
    }

    public function index(){
        return response()->json(["data" => RoleService::findAll(), "message" => "Liste des roles"], 200);
    }
}

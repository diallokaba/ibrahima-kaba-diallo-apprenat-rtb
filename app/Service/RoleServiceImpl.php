<?php

namespace App\Service;

use App\Facades\RoleRepositoryFacade as RoleRepository;
use Exception;

class RoleServiceImpl implements RoleServiceInterface
{
    public function create(array $data){
        $role = RoleRepository::findByKeyValue("nom", $data["nom"]);
        if($role){
            throw new Exception("Le role " . $data["nom"] . " existe déjà");
        }
        return RoleRepository::create($data);
    }

    public function findAll(){
        $roles = RoleRepository::findAll();
        $roleArray = [];
        foreach($roles as $r){
            $roleArray[] = $r;
        }
        return $roleArray;
    }
}
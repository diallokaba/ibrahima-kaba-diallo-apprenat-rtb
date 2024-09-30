<?php 

namespace App\Repositories;

use App\Models\Role;

class RoleRepositoryImpl implements RoleRepositoryInterface
{
    public function create(array $data){
        return Role::create($data);
    }

    public function findByKeyValue(string $key, $value){
        return Role::findByKeyValue($key, $value);
    }

    public function findAll(){
        return Role::all();
    }
}
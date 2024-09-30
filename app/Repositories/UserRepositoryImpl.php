<?php

namespace App\Repositories;
use App\Models\UserFirebase;

class UserRepositoryImpl implements UserRepositoryInterface
{
    public function create(array $data)
    {
        return UserFirebase::create($data);
    }

    public function query($params){
        return UserFirebase::query($params);
    }
}
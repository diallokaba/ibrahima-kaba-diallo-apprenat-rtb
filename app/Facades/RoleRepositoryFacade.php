<?php 

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class RoleRepositoryFacade extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'roleRepository';
    }
}
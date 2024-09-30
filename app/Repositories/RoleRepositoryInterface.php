<?php 

namespace App\Repositories;

interface RoleRepositoryInterface
{
    public function create(array $data);
    public function findByKeyValue(string $key, $value);
    public function findAll();
}
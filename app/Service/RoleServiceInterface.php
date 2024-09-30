<?php

namespace App\Service;

interface RoleServiceInterface
{
    public function create(array $data);
    public function findAll();
}
<?php 

namespace App\Service;

interface UserServiceInterface
{
    public function create(array $data);
    public function query($request);
}
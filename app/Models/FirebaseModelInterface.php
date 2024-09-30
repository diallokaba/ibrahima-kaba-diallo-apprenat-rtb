<?php

namespace App\Models;

interface FirebaseModelInterface{

    public static function create(array $data);
    public static function findByKeyValue(string $data, $value);
    public static function all();
}
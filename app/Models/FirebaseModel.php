<?php

namespace App\Models;

use App\Facades\FirebaseAuthFacade as FirebaseService;

abstract class FirebaseModel implements FirebaseModelInterface
{
    protected static $collection;
    private static $firebaseDB;

    public function __construct(){
    }

   

    public static function create(array $data){
       $firebaseDB = FirebaseService::firebaseRTB();
        $newKey = $firebaseDB->getReference(static::$collection)->push()->getKey();
        $collection = static::$collection;
        return $firebaseDB->getReference("{$collection}/{$newKey}")->set($data);
    }

    //Gère moi cette fonction 
    public static function findByKeyValue($key, $value){
        $firebaseDB = FirebaseService::firebaseRTB();
        $collection = static::$collection;
        $query = $firebaseDB->getReference("{$collection}")->orderByChild($key)->equalTo($value)->getSnapshot()->getValue();
        if($query){
            // Accéder au premier élément du tableau
            $query = reset($query);
            return $query;
        }
        return null;
    }

    public static function all(){
        $firebaseDB = FirebaseService::firebaseRTB();
        $collection = static::$collection;
        $query = $firebaseDB->getReference("{$collection}")->getSnapshot()->getValue();
        if($query){
            return $query;
        }
        return null;
    }
}

<?php 

namespace App\Service;

use App\Facades\UserRepositoryFacade as UserRepository;
use App\Facades\FirebaseAuthFacade as FirebaseService;
use App\Facades\ImgUrServiceFacade as ImgUrService;

class UserServiceImpl implements UserServiceInterface
{

    public function create(array $data)
    {
        $firebaseAuth = FirebaseService::createAuth();
        $firebaseUser = $firebaseAuth->createUserWithEmailAndPassword($data["email"], $data["password"]);
        $photoUrl = ImgUrService::uploadImageWithImgur($data["photo"]);
        $createdUser = UserRepository::create([
            'uid' => $firebaseUser->uid,
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'adresse' => $data['adresse'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'fonction' => $data['fonction'],
            'statut' => 'ACTIF',
            'photo' => $photoUrl,
            'role' => $data["role"],
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);
        return $createdUser;
    }

    public function query($request){
        return UserRepository::query($request);
    }
}
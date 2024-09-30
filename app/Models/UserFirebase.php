<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Facades\FirebaseAuthFacade as FirebaseService;

class UserFirebase extends FirebaseModel
{
    protected static $collection = 'users';

    public static function query($params)
    {
        $firebaseDB = FirebaseService::firebaseRTB();
        $collection = static::$collection;

        try {
            // Commencer la requête sur la collection des utilisateurs
            $reference = $firebaseDB->getReference($collection);

            // Si un paramètre de rôle est présent, on filtre par ce rôle
            if ($params && $params->input('role')) {
                $role = strtoupper($params->input('role'));

                // Filtrer les utilisateurs selon le rôle avec orderByChild et equalTo
                $query = $reference->orderByChild('role')->equalTo($role);
            } else {
                // Si aucun paramètre n'est passé, récupérer tous les utilisateurs
                $query = $reference;
            }

            // Obtenir le snapshot des données
            $snapshot = $query->getSnapshot();

            // Si des données existent, les retourner, sinon retourner un tableau vide
            $results = [];
            if ($snapshot->exists()) {
                $results = $snapshot->getValue(); // Récupère tous les utilisateurs
            }

            return $results; // Retourner les utilisateurs filtrés ou non
        } catch (\Exception $e) {
            // Gestion des erreurs liées à Firebase Realtime Database
            return response()->json(['error' => $e->getMessage()], 500);
        }

            
    }
}

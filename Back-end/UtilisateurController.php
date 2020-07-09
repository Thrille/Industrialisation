<?php

require_once __ROOT__.'/Database/UtilisateursManager.php';
require_once __ROOT__.'/Back-end/Helpers.php';

class UtilisateurController{

    use Helpers;
    //variable objet pour le MaterielsManager
    private static $_utilisateursManager;

    // Récupération de tous les Techniciens
    static function GetAllTechniciens(){
        self::$_utilisateursManager = new UtilisateursManager;
        $utilisateurs = self::$_utilisateursManager->getAllTechniciens();

        return Helpers::CollectionToJSON($utilisateurs);
    }

}
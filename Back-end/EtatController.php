<?php

require_once __ROOT__.'/Database/EtatsManager.php';
require_once __ROOT__.'/Back-end/Helpers.php';

class EtatController{

    use Helpers;
    //variable objet pour le EtatsManager
    private static $_etatsManager;

       // Récupération de tous les etats
       static function GetAllEtats(){
        self::$_etatsManager = new EtatsManager;
        $etats = self::$_etatsManager->GetAllEtats();

        return Helpers::CollectionToJSON($etats);
    }

}
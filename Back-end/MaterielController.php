<?php

require_once __ROOT__.'/Database/MaterielsManager.php';
require_once __ROOT__.'/Back-end/Helpers.php';

class MaterielController{

    use Helpers;
    //variable objet pour le MaterielsManager
    private static $_materielsManager;

       // Récupération de tous les materiels
       static function GetAllMateriels(){
        self::$_materielsManager = new MaterielsManager;
        $materiels = self::$_materielsManager->getAllMateriels();

        return Helpers::CollectionToJSON($materiels);
    }

}
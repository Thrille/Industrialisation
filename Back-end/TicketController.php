<?php
require_once __ROOT__.'/Database/TicketsManager.php';
require_once __ROOT__.'/Back-end/Helpers.php';

class TicketController{

    use Helpers;

    //variable objet pour le TicketsManager
    private static $_ticketsManager;

    // Création d'un nouveau ticket
    //a besoin de l'id du createur et l'id du prochain intervenant
    static function Create(array $aParam){
        self::$_ticketsManager = new TicketsManager;
        $bCreate = self::$_ticketsManager->createTicket($aParam);
        return $bCreate->toJSON();
    }

    // Récupération de tous les ticket
    static function GetAllTickets(){
        self::$_ticketsManager = new TicketsManager;
        $aTickets = self::$_ticketsManager->getAllTickets();

        return Helpers::CollectionToJSON($aTickets);
    }

    //Récupération d'un ticket précis
    static function GetTicket($iId){
        self::$_ticketsManager = new TicketsManager;
        $oTicket = self::$_ticketsManager->getTicket($iId);
        return $oTicket->toJSON();
    }

    //Mise à jour du ticket
    static function Update($iId, array $aParam){
        self::$_ticketsManager = new TicketsManager;
        $oTicket = self::$_ticketsManager->updateTicket($iId,$aParam);

        if ($oTicket === NULL) {
            return json_encode($oTicket);
        }

        return $oTicket->toJSON();
    }

    //Suppression du ticket
    static function Delete($iId){
        self::$_ticketsManager = new TicketsManager;
        $bDelete = self::$_ticketsManager->deleteTicket($iId);

        return json_encode($bDelete);
    }
}

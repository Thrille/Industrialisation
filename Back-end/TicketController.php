<?php
require_once __ROOT__.'/Database/TicketsManager.php';
require_once __ROOT__.'/Back-end/Helpers.php';

class TicketController{

    use Helpers;

    //variable objet pour le TicketsManager
    private static $_ticketsManager;

    // Création d'un nouveau ticket
    static function Create(array $param){  
        self::$_ticketsManager = new TicketsManager;
        $bCreate = self::$_ticketsManager->createTicket($param);
        
        if (is_bool($ticket)) {
            return json_encode($ticket);
        }

        return $bCreate->toJSON();
    }

    // Récupération de tous les ticket
    static function GetAllTickets(){
        self::$_ticketsManager = new TicketsManager;
        $tickets = self::$_ticketsManager->getAllTickets();

        return Helpers::CollectionToJSON($tickets);
    }

    //Récupération d'un ticket précis
    static function GetTicket($id){
        self::$_ticketsManager = new TicketsManager;
        $ticket = self::$_ticketsManager->getTicket($id);
        return $ticket->toJSON();
    }

    //Mise à jour du ticket
    static function Update($id, array $param){      
        self::$_ticketsManager = new TicketsManager;
        $ticket = self::$_ticketsManager->updateTicket($id,$param);

        if ($ticket === NULL) {
            return json_encode($ticket);
        }
        
        return $ticket->toJSON();        
    }

    //Suppression du ticket
    static function Delete($id){
        self::$_ticketsManager = new TicketsManager;
        $bDelete = self::$_ticketsManager->deleteTicket($id);

        return json_encode($bDelete);
    }
}
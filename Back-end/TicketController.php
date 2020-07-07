<?php
require_once(__ROOT__.'/Database/TicketManager.php');

class TicketController{

    private static $_ticketsManager;

    // Création d'un nouveau ticket
    static function Create(array $param){  
              self::$_ticketManager = new TicketManager;
    }

    // Récupération de tous les ticket
    static function GetAllTickets(){
        self::$_ticketsManager = new TicketsManager;
        $tickets = self::$_ticketsManager->getAllTickets();    
        return $tickets;    
    }

    //Récupération d'un ticket précis
    static function GetTicket($id){
        self::$_ticketsManager = new TicketsManager;
        $ticket = self::$_ticketsManager->getTicket($id);
        return $ticket;
    }

    //Mise à jour du ticket
    static function Update($id, array $param){      
        self::$_ticketManager = new TicketsManager;
        $ticket = self::$_ticketManager->updateTicket($id,$param);
        return $ticket;        
    }

    //Suppression du ticket
    static function Delete($id){
        self::$_ticketManager = new TicketsManager;
        $bDelete = self::$_ticketManager->deleteTicket($id);
        return $bDelete;
    }
}

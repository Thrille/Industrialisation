<?php
require_once '../Database/TicketsManager.php';

class TicketController{

    private static $_ticketsManager;

    // Création d'un nouveau ticket
    static function Create(array $param){  
              
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

    }

    //Suppression du ticket
    static function Delete($id){

    }
}

$tickets = TicketController::GetAllTickets();
foreach ($tickets as $ticket) {
    echo $ticket->getT_DESCRIPTION();
}
echo '<br/>';
echo TicketController::GetTicket(2)['T_DESCRIPTION'];

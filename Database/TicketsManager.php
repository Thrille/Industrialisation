<?php
require_once('Model.php');
require_once('Ticket.php');
class TicketsManager extends Model{
  public function getAllTickets(){
    return $this->getAll('ticket', 'Ticket');
  }

  public function getTicket($id)
  {    
    $req = $this->getBdd()->prepare('SELECT * FROM ticket WHERE T_ID='.$id);
    $req->execute();
    $var = $req->fetch(PDO::FETCH_ASSOC);    
    return $var;
  }
}
?>

<?php
require_once('Model.php');
class TicketsManager extends Model{
  public function getTickets(){
    return $this->getAll('ticket', 'Ticket');
  }
}
?>

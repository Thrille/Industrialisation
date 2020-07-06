<?php
namespace Model;

class TicketsManager extend Model{
  public function getTickets(){
    return $this->getAll('ticket', 'Ticket');
  }
}
?>

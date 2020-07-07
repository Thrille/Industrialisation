<?php
require_once(__root__.'/Database/Model.php');
require_once(__root__.'/Database/Ticket.php');
class TicketsManager extends Model{

  //récupère tous les tickets
  public function getAllTickets(){
    return $this->getAll('ticket', 'Ticket');
  }

  //récupère un ticket par rapport à son id
  public function getTicket($id)
  {
    $req = $this->getBdd()->prepare('SELECT * FROM ticket WHERE T_ID='.$id);
    $req->execute();
    $var = $req->fetch(PDO::FETCH_ASSOC);
    return $var;
  }

  //modifie le ticket avec l'id correspondant + retourne le ticket modifié
  public function updateTicket($id, array $param){
    $req = $this->getBdd()->prepare("UPDATE ticket SET T_NUMERO = '".$param[0]."', T_DATE_SAISIE = '".$param[1]."', T_DESCRIPTION = '".$param[2]."', MATERIEL_M_ID = '".$param[3]."', ETAT_E_CODE = '".$param[4]."' WHERE T_ID = ".$id);
    $req->execute();
    return getTicket($id);
  }

  //supprime le ticket avec l'id correspondant + retourne un true si supression effectué et false sinon
  public function deleteTicket($id){
    $req = $this->getBdd()->prepare("DELETE FROM ticket WHERE T_ID = ".$id);
    $count = $req->execute();
    if($count != 0){
      return true;
    }
    else{
      return false;
    }
  }
}
?>

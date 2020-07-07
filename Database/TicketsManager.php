<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Ticket.php';
class TicketsManager extends Model{

  private $sModel = 'Ticket';

  //récupère tous les tickets
  public function getAllTickets(){
    return $this->getAll('TICKET', 'Ticket');
  }

  //récupère un ticket par rapport à son id
  public function getTicket(int $id)
  {
    $req = $this->getBdd()->prepare('SELECT * FROM TICKET WHERE T_ID= :id;');
    $req->execute(array(
      ':id' => $id
    ));
    $var = $req->fetch(PDO::FETCH_ASSOC);

    if (is_array($var)) {
      return new $this->sModel($var);
    }
    
    return NULL;
  }

  //modifie le ticket avec l'id correspondant + retourne le ticket modifié
  public function updateTicket(int $id, array $param){

    $req = $this->getBdd()->prepare('UPDATE TICKET SET T_NUMERO = :number, T_DESCRIPTION = :description, MATERIEL_M_ID = :deviceCode, ETAT_E_CODE = :deviceCode WHERE T_ID = :id;');
    $req->execute(array(
      ':number' => $param['number'], 
      ':description' => $param['description'], 
      ':deviceCode' => $param['deviceCode'], 
      ':stateCode' => $param['stateCode'], 
      ':id' => $id
    ));
    return $this->getTicket($id);
  }

  //supprime le ticket avec l'id correspondant + retourne un true si supression effectué et false sinon
  public function deleteTicket(int $id){
    $req = $this->getBdd()->prepare("DELETE FROM INTERVENTION WHERE TICKET_T_ID = :id; DELETE FROM TICKET WHERE T_ID = :id;");
    $count = $req->execute(array(
      ':id' => $id
    ));
    if($count != 0){
      return true;
    }
    else{
      return false;
    }
  }

  //créer un nouveau ticket
  public function createTicket(array $param){
    $req = $this->getBdd()->prepare('INSERT INTO TICKET (T_NUMERO, T_DATE_SAISIE, T_DESCRIPTION, MATERIEL_M_ID, ETAT_E_CODE) VALUES (:number, now(), :description, :deviceCode, :stateCode);');
    $count = $req->execute(array(
      ':number' => $param['number'], 
      ':description' => $param['description'], 
      ':deviceCode' => $param['deviceCode'], 
      ':stateCode' => $param['stateCode'], 
    ));
    if($count != 0){

      $req = $this->getBdd()->prepare('SELECT LAST_INSERT_ID() AS ID;');
      $req->execute();
      $var = $req->fetch(PDO::FETCH_ASSOC);

      return $this->getTicket(intval($var['ID']));
    }
    else{
      return false;
    }
  }
}
?>

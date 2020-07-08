<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Ticket.php';
class TicketsManager extends Model{

  private $sModel = 'Ticket';

  //récupère tous les tickets
  public function getAllTickets(){
    $req = $this->getBdd()->prepare('SELECT TICKET.T_NUMERO, TICKET.T_DATE_SAISIE, TICKET.T_DESCRIPTION, MATERIEL.M_LIBELLE, ETAT.E_LIBELLE, UTILISATEUR.U_IDENTIFIANT, TYPE_INTERVENTION.TI_LIBELLE, INTERVENTION.I_DATE FROM TICKET JOIN INTERVENTION ON TICKET.T_ID = INTERVENTION.TICKET_T_ID JOIN UTILISATEUR ON INTERVENTION.UTILISATEUR_U_ID = UTILISATEUR.U_ID JOIN TYPE_INTERVENTION ON INTERVENTION.TYPE_INTERVENTION_TI_CODE = TYPE_INTERVENTION.TI_CODE JOIN MATERIEL ON TICKET.MATERIEL_M_ID = MATERIEL.M_ID JOIN ETAT ON TICKET.ETAT_E_CODE = ETAT.E_CODE ORDER BY TICKET.T_NUMERO;');
    $req->execute();
    while($data = $req->fetch(PDO::FETCH_ASSOC)){

      $var[] = new $this->sModel($data);
    }

    return $var;
    $req->closeCursor();
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
    $req = $this->getBdd()->prepare('DELETE FROM INTERVENTION WHERE TICKET_T_ID = :id; DELETE FROM TICKET WHERE T_ID = :id;');
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
      ':stateCode' => $param['stateCode']
    ));
    if($count != 0){

      $req = $this->getBdd()->prepare('SELECT LAST_INSERT_ID() AS ID;');
      $req->execute();
      $var = $req->fetch(PDO::FETCH_ASSOC);
      //paramètres pour creation intervention 1
      $param2 = array(
        'utilisateurId'=> $param['createurId'],
        'ticketId' => $var['ID'],
        'typeInterventionCode' => 1,
        'date' => now()
      );
      //paramètres pour création intervention 2
      $param3 = array(
        'utilisateurId'=> $param['intervenantId'],
        'ticketId' => $var['ID'],
        'typeInterventionCode' => 2,
        'date' => now()
      );
      //création des interventions
      $req2 = $this->createIntervention($param2);
      $req3 = $this->createIntervention($param3);

      //return le ticket créé
      return $this->getTicket(intval($var['ID']));
    }
    else{
      return false;
    }
  }
}
?>

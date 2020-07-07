<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Intervention.php';

class InterventionsManager extends Model{

  private $sModel = 'Intervention';

  //récupère toutes les interventions
  public function getAllInterventions(){
    return $this->getAll('INTERVENTION', 'Intervetion');
  }

  //récupère une intervention par rapport à l'id de l'utilisateur et l'id du ticket
  public function getIntervention(int $utilisateurId, int $ticketId)
  {
    $req = $this->getBdd()->prepare('SELECT * FROM INTERVENTION WHERE TICKET_T_ID= :ticketId AND UTILISATEUR_U_ID= :utilisateurId;');
    $req->execute(array(
      ':utilisateurId' => $utilisateurId,
      'ticketId' => $ticketId
    ));
    $var = $req->fetch(PDO::FETCH_ASSOC);

    if (is_array($var)) {
      return new $this->sModel($var);
    }

    return NULL;
  }

  //modifie l'intervention avec les ids correspondants + retourne l'intervention modifiée
  public function updateIntervention(int $utilisateurId, int $ticketId, array $param){

    $req = $this->getBdd()->prepare('UPDATE INTERVENTION SET UTILISATEUR_U_ID = :paramUtilisateurId, TICKET_T_ID = :paramTicketId, TYPE_INTERVENTION_TI_CODE = :typeInterventionCode, I_DATE = :date WHERE TICKET_T_ID = :ticketId AND UTILISATEUR_U_ID = :utilisateurId;');
    $req->execute(array(
      ':paramUtilisateurId' => $param['utilisateurId'],
      ':paramTicketId' => $param['ticketId'],
      ':typeInterventionCode' => $param['typeInterventionCode'],
      ':date' => $param['date'],
      ':utilisateurId' => $utilisateurId,
      'ticketId' => $ticketId
    ));
    return $this->getIntervention($param['utilisateurId'], $param['ticketId']);
  }

  //supprime l'intervention avec les ids correspondants + retourne un true si supression effectué et false sinon
  public function deleteIntervention(int $utilisateurId, int $ticketId){
    $req = $this->getBdd()->prepare('DELETE FROM INTERVENTION WHERE TICKET_T_ID = :ticketId AND UTILISATEUR_U_ID = :utilisateurId;');
    $count = $req->execute(array(
      ':ticketId' => $ticketId,
      ':utilisateurId' => $utilisateurId
    ));
    if($count != 0){
      return true;
    }
    else{
      return false;
    }
  }

  //créer une nouvelle intervention
  public function createIntervention(array $param){
    $req = $this->getBdd()->prepare('INSERT INTO INTERVENTION (UTILISATEUR_U_ID, TICKET_T_ID, TYPE_INTERVENTION_TI_CODE, I_DATE) VALUES (:utilisateurId, :ticketId, :typeInterventionCode, :date);');
    $count = $req->execute(array(
      ':utilisateurId' => $param['utilisateurId'],
      ':ticketId' => $param['ticketId'],
      ':typeInterventionCode' => $param['typeInterventionCode'],
      ':date' => $param['date']
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

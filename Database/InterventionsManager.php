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
  public function getIntervention(int $iUtilisateurId, int $iTicketId)
  {
    $req = $this->getBdd()->prepare('SELECT * FROM INTERVENTION WHERE TICKET_T_ID= :ticketId AND UTILISATEUR_U_ID= :utilisateurId;');
    $req->execute(array(
      ':utilisateurId' => $iUtilisateurId,
      'ticketId' => $iTicketId
    ));
    $aData = $req->fetch(PDO::FETCH_ASSOC);

    if (is_array($aData)) {
      return new $this->sModel($aData);
    }

    return NULL;
  }

  //modifie l'intervention avec les ids correspondants + retourne l'intervention modifiée
  public function updateIntervention(int $iUtilisateurId, int $iTicketId, array $aParam){

    $req = $this->getBdd()->prepare('UPDATE INTERVENTION SET UTILISATEUR_U_ID = :paramUtilisateurId, TICKET_T_ID = :paramTicketId, TYPE_INTERVENTION_TI_CODE = :typeInterventionCode, I_DATE = :date WHERE TICKET_T_ID = :ticketId AND UTILISATEUR_U_ID = :utilisateurId;');
    $req->execute(array(
      ':paramUtilisateurId' => $aParam['utilisateurId'],
      ':paramTicketId' => $aParam['ticketId'],
      ':typeInterventionCode' => $aParam['typeInterventionCode'],
      ':date' => $aParam['date'],
      ':utilisateurId' => $iUtilisateurId,
      'ticketId' => $iTicketId
    ));
    return $this->getIntervention($aParam['utilisateurId'], $aParam['ticketId']);
  }

  //supprime l'intervention avec les ids correspondants + retourne un true si supression effectué et false sinon
  public function deleteIntervention(int $iUtilisateurId, int $iTicketId){
    $req = $this->getBdd()->prepare('DELETE FROM INTERVENTION WHERE TICKET_T_ID = :ticketId AND UTILISATEUR_U_ID = :utilisateurId;');
    $iNumLigne = $req->execute(array(
      ':ticketId' => $iTicketId,
      ':utilisateurId' => $iUtilisateurId
    ));
    if($iNumLigne != 0){
      return true;
    }
    else{
      return false;
    }
  }

  //créer une nouvelle intervention
  public function createIntervention(array $aParam){
    $req = $this->getBdd()->prepare('INSERT INTO INTERVENTION (UTILISATEUR_U_ID, TICKET_T_ID, TYPE_INTERVENTION_TI_CODE, I_DATE) VALUES (:utilisateurId, :ticketId, :typeInterventionCode, :date);');
    $iNumLigne = $req->execute(array(
      ':utilisateurId' => $aParam['utilisateurId'],
      ':ticketId' => $aParam['ticketId'],
      ':typeInterventionCode' => $aParam['typeInterventionCode'],
      ':date' => $aParam['date']
    ));
    if($iNumLigne != 0){

      $req = $this->getBdd()->prepare('SELECT LAST_INSERT_ID() AS ID;');
      $req->execute();
      $aData = $req->fetch(PDO::FETCH_ASSOC);

      return $this->getTicket(intval($aData['ID']));
    }
    else{
      return false;
    }
  }
}
?>

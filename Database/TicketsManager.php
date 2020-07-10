<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Ticket.php';
class TicketsManager extends Model{

  private $sModel = 'Ticket';

/*--------------------------------OUTILS ------------------------------------*/

  //utilisée dans getAllTickets() : créer un nouveau ticket à ajouter
  //dans le tableau de tickets
  private function ajoutTicketAuTableau($aData){
    $aNouvelleIntervention = array(
      'UTILISATEUR_U_IDENTIFIANT' => $aData['UTILISATEUR_U_IDENTIFIANT'],
      'TYPE_INTERVENTION_TI_CODE' => $aData['TYPE_INTERVENTION_TI_CODE'],
      'TYPE_INTERVENTION_TI_LIBELLE' => $aData['TYPE_INTERVENTION_TI_LIBELLE'],
      'I_DATE' => $aData['I_DATE']
    );

    $aNouveauTicket = array(
      'T_ID' => $aData['T_ID'],
      'T_NUMERO' => $aData['T_NUMERO'],
      'T_DATE_SAISIE' => $aData['T_DATE_SAISIE'],
      'T_DESCRIPTION' => $aData['T_DESCRIPTION'],
      'MATERIEL_M_ID' => $aData['MATERIEL_M_ID'],
      'MATERIEL_M_LIBELLE' => $aData['MATERIEL_M_LIBELLE'],
      'ETAT_E_CODE' => $aData['ETAT_E_CODE'],
      'ETAT_E_LIBELLE' => $aData['ETAT_E_LIBELLE'],
      'INTERVENTION' => array()
    );
    array_push($aNouveauTicket['INTERVENTION'], $aNouvelleIntervention);
    return $aNouveauTicket;
  }
/*--------------------------------OUTILS ------------------------------------*/

  //récupère tous les tickets
  //compare le resultat de la requete au tableau de tickets
  //si le code du ticket est le même, il ajoute uniquement la nouvelle intervention
  //au tableau d'interventions, sinon il ajoute tout le nouveau ticket.
  public function getAllTickets(){

    $req = $this->getBdd()->prepare('SELECT TICKET.T_NUMERO, TICKET.T_DATE_SAISIE, TICKET.T_DESCRIPTION, MATERIEL.M_LIBELLE AS MATERIEL_M_LIBELLE, ETAT.E_LIBELLE AS ETAT_E_LIBELLE, UTILISATEUR.U_IDENTIFIANT AS UTILISATEUR_U_IDENTIFIANT, TYPE_INTERVENTION.TI_LIBELLE AS TYPE_INTERVENTION_TI_LIBELLE, TYPE_INTERVENTION.TI_CODE AS TYPE_INTERVENTION_TI_CODE, INTERVENTION.I_DATE, TICKET.T_ID, TICKET.MATERIEL_M_ID, TICKET.ETAT_E_CODE FROM TICKET JOIN INTERVENTION ON TICKET.T_ID = INTERVENTION.TICKET_T_ID JOIN UTILISATEUR ON INTERVENTION.UTILISATEUR_U_ID = UTILISATEUR.U_ID JOIN TYPE_INTERVENTION ON INTERVENTION.TYPE_INTERVENTION_TI_CODE = TYPE_INTERVENTION.TI_CODE JOIN MATERIEL ON TICKET.MATERIEL_M_ID = MATERIEL.M_ID JOIN ETAT ON TICKET.ETAT_E_CODE = ETAT.E_CODE ORDER BY TICKET.T_NUMERO;');
    $req->execute();
    $aTickets = array();
    while($aData = $req->fetch(PDO::FETCH_ASSOC)){
      $bVerif = false;
      $iNumTicket = $aData['T_NUMERO'];
      //Verifier si le tableau est vide, pour la première insertion
      if(!empty($aTickets)){
        //comparer les valeurs de la requete avec celles du tableau
        foreach($aTickets as &$aLigne){
          //si on trouve le même numéro de ticket dans le tableau, on rajoute uniquement la partie intervention
          if($iNumTicket == $aLigne['T_NUMERO']){
            $aIntervention = array(
              'UTILISATEUR_U_IDENTIFIANT' => $aData['UTILISATEUR_U_IDENTIFIANT'],
              'TYPE_INTERVENTION_TI_CODE' => $aData['TYPE_INTERVENTION_TI_CODE'],
              'TYPE_INTERVENTION_TI_LIBELLE' => $aData['TYPE_INTERVENTION_TI_LIBELLE'],
              'I_DATE' => $aData['I_DATE']
            );
            array_push($aLigne['INTERVENTION'], $aIntervention);
            $bVerif = true;
          }
        }
        //si a la fin de la comparaison aucun ticket du meme numero a été détecté, on le créer dans le tableau
        if($bVerif === false){
          $aNouveauTicket = $this->ajoutTicketAuTableau($aData);
          array_push($aTickets, $aNouveauTicket);
          $bVerif = true;
        }
      }
      //si le tableau est vide, on créer le premier ticket qui arrive (première insertion)
      else{
        $aNouveauTicket = $this->ajoutTicketAuTableau($aData);
        array_push($aTickets, $aNouveauTicket);
      }
    }
    //retourne le tableau de ticket mis en ordre
    return $aTickets;
    $req->closeCursor();
  }

  //récupère un ticket par rapport à son id
  public function getTicket(int $iId)
  {
    $req = $this->getBdd()->prepare('SELECT * FROM TICKET WHERE T_ID= :id;');
    $req->execute(array(
      ':id' => $iId
    ));
    $aData = $req->fetch(PDO::FETCH_ASSOC);

    if (is_array($aData)) {
      return new $this->sModel($aData);
    }

    return NULL;
  }

  //modifie le ticket avec l'id correspondant + retourne le ticket modifié
  public function updateTicket(int $iId, array $aParam){

    $req = $this->getBdd()->prepare('UPDATE TICKET SET T_NUMERO = :number, T_DESCRIPTION = :description, MATERIEL_M_ID = :deviceCode, ETAT_E_CODE = :deviceCode WHERE T_ID = :id;');
    $req->execute(array(
      ':number' => $aParam['number'],
      ':description' => $aParam['description'],
      ':deviceCode' => $aParam['deviceCode'],
      ':stateCode' => $aParam['stateCode'],
      ':id' => $iId
    ));
    return $this->getTicket($iId);
  }

  //supprime le ticket avec l'id correspondant + retourne un true si supression effectué et false sinon
  public function deleteTicket(int $iId){
    $req = $this->getBdd()->prepare('DELETE FROM INTERVENTION WHERE TICKET_T_ID = :id; DELETE FROM TICKET WHERE T_ID = :id;');
    $iCount = $req->execute(array(
      ':id' => $iId
    ));
    if($iCount != 0){
      return true;
    }
    else{
      return false;
    }
  }

  //créer un nouveau ticket
  public function createTicket(array $aParam){
    $req = $this->getBdd()->prepare('INSERT INTO TICKET (T_NUMERO, T_DATE_SAISIE, T_DESCRIPTION, MATERIEL_M_ID, ETAT_E_CODE) VALUES (:number, now(), :description, :deviceCode, :stateCode);');
    $iCount = $req->execute(array(
      ':number' => $aParam['number'],
      ':description' => $aParam['description'],
      ':deviceCode' => $aParam['deviceCode'],
      ':stateCode' => $aParam['stateCode']
    ));
    if($iCount != 0){

      $req = $this->getBdd()->prepare('SELECT LAST_INSERT_ID() AS ID;');
      $req->execute();
      $aData = $req->fetch(PDO::FETCH_ASSOC);
      //paramètres pour creation intervention 1
      $aParam2 = array(
        'utilisateurId'=> $aParam['createurId'],
        'ticketId' => $aData['ID'],
        'typeInterventionCode' => 1,
        'date' => now()
      );
      //paramètres pour création intervention 2
      $aParam3 = array(
        'utilisateurId'=> $aParam['intervenantId'],
        'ticketId' => $aData['ID'],
        'typeInterventionCode' => 2,
        'date' => now()
      );
      //création des interventions
      $this->createIntervention($aParam2);
      $this->createIntervention($aParam3);

      //return le ticket créé
      return $this->getTicket(intval($aData['ID']));
    }
    else{
      return false;
    }
  }
}
?>

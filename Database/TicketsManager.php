<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Ticket.php';
class TicketsManager extends Model{

  private $sModel = 'Ticket';

/*--------------------------------OUTILS ------------------------------------*/

  //utilisée dans getAllTickets() : créer un nouveau ticket à ajouter
  //dans le tableau de tickets
  private function ajoutTicketAuTableau($data){
    $aNouvelleIntervention = array(
      'UTILISATEUR_U_IDENTIFIANT' => $data['UTILISATEUR_U_IDENTIFIANT'],
      'TYPE_INTERVENTION_TI_CODE' => $data['TYPE_INTERVENTION_TI_CODE'],
      'TYPE_INTERVENTION_TI_LIBELLE' => $data['TYPE_INTERVENTION_TI_LIBELLE'],
      'I_DATE' => $data['I_DATE']
    );

    $aNouveauTicket = array(
      'T_ID' => $data['T_ID'],
      'T_NUMERO' => $data['T_NUMERO'],
      'T_DATE_SAISIE' => $data['T_DATE_SAISIE'],
      'T_DESCRIPTION' => $data['T_DESCRIPTION'],
      'MATERIEL_M_ID' => $data['MATERIEL_M_ID'],
      'MATERIEL_M_LIBELLE' => $data['MATERIEL_M_LIBELLE'],
      'ETAT_E_CODE' => $data['ETAT_E_CODE'],
      'ETAT_E_LIBELLE' => $data['ETAT_E_LIBELLE'],
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
    while($data = $req->fetch(PDO::FETCH_ASSOC)){
      $b = false;
      $num_ticket = $data['T_NUMERO'];
      //Verifier si le tableau est vide, pour la première insertion
      if(!empty($aTickets)){
        //comparer les valeurs de la requete avec celles du tableau
        foreach($aTickets as &$value){
          //si on trouve le même numéro de ticket dans le tableau, on rajoute uniquement la partie intervention
          if($num_ticket == $value['T_NUMERO']){
            $aIntervention = array(
              'UTILISATEUR_U_IDENTIFIANT' => $data['UTILISATEUR_U_IDENTIFIANT'],
              'TYPE_INTERVENTION_TI_CODE' => $data['TYPE_INTERVENTION_TI_CODE'],
              'TYPE_INTERVENTION_TI_LIBELLE' => $data['TYPE_INTERVENTION_TI_LIBELLE'],
              'I_DATE' => $data['I_DATE']
            );
            array_push($value['INTERVENTION'], $aIntervention);
            $b = true;
          }
        }
        //si a la fin de la comparaison aucun ticket du meme numero a été détecté, on le créer dans le tableau
        if($b === false){
          $aNouveauTicket = $this->ajoutTicketAuTableau($data);
          array_push($aTickets, $aNouveauTicket);
          $b = true;
        }
      }
      //si le tableau est vide, on créer le premier ticket qui arrive (première insertion)
      else{
        $aNouveauTicket = $this->ajoutTicketAuTableau($data);
        array_push($aTickets, $aNouveauTicket);
      }
    }
    //retourne le tableau de ticket mis en ordre
    return $aTickets;
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

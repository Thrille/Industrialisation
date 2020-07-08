<?php
require_once __ROOT__.'/Database/Entity.php';
class Ticket extends Entity{
  protected $T_ID, $T_NUMERO, $T_DATE_SAISIE, $T_DESCRIPTION, $MATERIEL_M_ID, $ETAT_E_CODE, $ETAT_E_LIBELLE, $MATERIEL_M_LIBELLE, $TYPE_INTERVENTION_TI_LIBELLE, $UTILISATEUR_U_IDENTIFIANT;

  public function __construct(array $data){
    $this->hydrate($data);
  }

  //hydratation
  public function hydrate(array $data){
    foreach($data as $key => $value){
      $method = 'set'.ucfirst($key);
      if(method_exists($this, $method)){
        $this->$method($value);
      }
    }
  }

  //SETTERS
  public function setT_ID($T_ID){
    $T_ID = (int) $T_ID;
    if($T_ID > 0){
      $this->T_ID = $T_ID;
    }
  }

  public function setT_NUMERO($T_NUMERO){
    $this->T_NUMERO = $T_NUMERO;
  }

  public function setT_DATE_SAISIE($T_DATE_SAISIE){
    $this->T_DATE_SAISIE = $T_DATE_SAISIE;
  }

  public function setT_DESCRIPTION($T_DESCRIPTION){
    $this->T_DESCRIPTION = $T_DESCRIPTION;
  }

  public function setMATERIEL_M_ID($MATERIEL_M_ID){
    $this->MATERIEL_M_ID = $MATERIEL_M_ID;
  }

  public function setETAT_E_CODE($ETAT_E_CODE){
    $this->ETAT_E_CODE = $ETAT_E_CODE;
  }

  public function setETAT_E_LIBELLE($ETAT_E_LIBELLE){
    $this->ETAT_E_LIBELLE = $ETAT_E_LIBELLE;
  }

  public function setMATERIEL_M_LIBELLE($MATERIEL_M_LIBELLE){
    $this->MATERIEL_M_LIBELLE = $MATERIEL_M_LIBELLE;
  }

  public function setTYPE_INTERVENTION_TI_LIBELLE($TYPE_INTERVENTION_TI_LIBELLE){
    $this->TYPE_INTERVENTION_TI_LIBELLE = $TYPE_INTERVENTION_TI_LIBELLE;
  }

  public function setUTILISATEUR_U_IDENTIFIANT($UTILISATEUR_U_IDENTIFIANT){
    $this->UTILISATEUR_U_IDENTIFIANT = $UTILISATEUR_U_IDENTIFIANT;
  }


  //GETTERS
  public function getT_ID(){
    return $this->T_ID;
  }

  public function getT_NUMERO(){
    return $this->T_NUMERO;
  }

  public function getT_DATE_SAISIE(){
    return $this->T_DATE_SAISIE;
  }

  public function getT_DESCRIPTION(){
    return $this->T_DESCRIPTION;
  }

  public function getMATERIEL_M_ID(){
    return $this->MATERIEL_M_ID;
  }

  public function getETAT_E_CODE(){
    return $this->ETAT_E_CODE;
  }

  public function getETAT_E_LIBELLE(){
    return $this->ETAT_E_LIBELLE;
  }

  public function getMATERIEL_M_LIBELLE(){
    return $this->MATERIEL_M_LIBELLE;
  }

  public function getTYPE_INTERVENTION_TI_LIBELLE(){
    return $this->TYPE_INTERVENTION_TI_LIBELLE;
  }

  public function getUTILISATEUR_U_IDENTIFIANT(){
    return $this->UTILISATEUR_U_IDENTIFIANT;
  }
}
?>

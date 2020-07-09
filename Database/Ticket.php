<?php
require_once __ROOT__.'/Database/Entity.php';
class Ticket extends Entity{
  protected $T_ID, $T_NUMERO, $T_DATE_SAISIE, $T_DESCRIPTION, $MATERIEL_M_ID, $ETAT_E_CODE, $ETAT_E_LIBELLE, $MATERIEL_M_LIBELLE, $TYPE_INTERVENTION_TI_LIBELLE, $UTILISATEUR_U_IDENTIFIANT;

  public function __construct(array $aData){
    $this->hydrate($aData);
  }

  //hydratation
  public function hydrate(array $aData){
    foreach($aData as $sKey => $sValue){
      $sMethod = 'set'.ucfirst($sKey);
      if(method_exists($this, $sMethod)){
        $this->$sMethod($sValue);
      }
    }
  }

  //SETTERS
  public function setT_ID($iT_ID){
    $iT_ID = (int) $iT_ID;
    if($iT_ID > 0){
      $this->T_ID = $iT_ID;
    }
  }

  public function setT_NUMERO($iT_NUMERO){
    $iT_NUMERO = (int) $iT_NUMERO;
    if($iT_NUMERO > 0){
      $this->T_NUMERO = $iT_NUMERO;
    }
  }

  public function setT_DATE_SAISIE($dT_DATE_SAISIE){
    $this->T_DATE_SAISIE = $dT_DATE_SAISIE;
  }

  public function setT_DESCRIPTION($sT_DESCRIPTION){
    $this->T_DESCRIPTION = $sT_DESCRIPTION;
  }

  public function setMATERIEL_M_ID($iMATERIEL_M_ID){
    $iMATERIEL_M_ID = (int) $iMATERIEL_M_ID;
    if($iMATERIEL_M_ID > 0){
      $this->MATERIEL_M_ID = $iMATERIEL_M_ID;
    }
  }

  public function setETAT_E_CODE($iETAT_E_CODE){
    $iETAT_E_CODE = (int) $iETAT_E_CODE;
    if($iETAT_E_CODE > 0){
      $this->ETAT_E_CODE = $iETAT_E_CODE;
    }
  }

  public function setETAT_E_LIBELLE($sETAT_E_LIBELLE){
    $this->ETAT_E_LIBELLE = $sETAT_E_LIBELLE;
  }

  public function setMATERIEL_M_LIBELLE($sMATERIEL_M_LIBELLE){
    $this->MATERIEL_M_LIBELLE = $sMATERIEL_M_LIBELLE;
  }

  public function setTYPE_INTERVENTION_TI_LIBELLE($sTYPE_INTERVENTION_TI_LIBELLE){
    $this->TYPE_INTERVENTION_TI_LIBELLE = $sTYPE_INTERVENTION_TI_LIBELLE;
  }

  public function setUTILISATEUR_U_IDENTIFIANT($iUTILISATEUR_U_IDENTIFIANT){
    $iUTILISATEUR_U_IDENTIFIANT = (int) $iUTILISATEUR_U_IDENTIFIANT;
    if($iUTILISATEUR_U_IDENTIFIANT > 0){
      $this->UTILISATEUR_U_IDENTIFIANT = $iUTILISATEUR_U_IDENTIFIANT;  
    }
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

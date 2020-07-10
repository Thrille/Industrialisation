<?php
require_once __ROOT__.'/Database/Entity.php';
class Utilisateur extends Entity{
  protected $U_ID, $U_IDENTIFIANT, $ROLE_R_CODE;
  private $U_MDP;

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
  public function setU_ID($U_ID){
    $this->U_ID = $U_ID;
  }

  public function setU_IDENTIFIANT($U_IDENTIFIANT){
    $this->U_IDENTIFIANT = $U_IDENTIFIANT;
  }

  public function setROLE_R_CODE($ROLE_R_CODE){
    $this->ROLE_R_CODE = $ROLE_R_CODE;
  }

  public function setU_MDP($U_MDP){
    $this->U_MDP = $U_MDP;
  }

  //GETTERS
  public function getU_ID(){
    return $this->U_ID;
  }

  public function getU_IDENTIFIANT(){
    return $this->U_IDENTIFIANT;
  }

  public function getROLE_R_CODE(){
    return $this->ROLE_R_CODE;
  }
  public function getU_MDP(){
    return $this->U_MDP;
  }
}
?>

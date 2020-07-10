<?php
require_once __ROOT__.'/Database/Entity.php';
class Role extends Entity{
  protected $R_LIBELLE, $R_CODE;

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
  public function setR_LIBELLE($R_LIBELLE){
    $this->R_LIBELLE = $R_LIBELLE;
  }

  public function setR_CODE($R_CODE){
    $this->R_CODE = $R_CODE;
  }

  //GETTERS
  public function getR_LIBELLE(){
    return $this->R_LIBELLE;
  }

  public function getR_CODE(){
    return $this->R_CODE;
  }
}
?>

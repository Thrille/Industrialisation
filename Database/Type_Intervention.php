<?php
require_once __ROOT__.'/Database/Entity.php';
class Type_Intervention extends Entity{
  protected $TI_CODE, $TI_LIBELLE;

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
  public function setTI_CODE($TI_CODE){
    $this->TI_CODE = $TI_CODE;
  }

  public function setTI_LIBELLE($TI_LIBELLE){
    $this->TI_LIBELLE = $TI_LIBELLE;
  }

  //GETTERS
  public function getTI_CODE(){
    return $this->TI_CODE;
  }

  public function getTI_LIBELLE(){
    return $this->TI_LIBELLE;
  }
}
?>

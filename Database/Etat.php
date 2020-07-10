<?php
require_once __ROOT__.'/Database/Entity.php';
class Etat extends Entity{
  protected $E_CODE, $E_LIBELLE;

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
  public function setE_CODE($E_CODE){
    $this->E_CODE = $E_CODE;
  }

  public function setE_LIBELLE($E_LIBELLE){
    $this->E_LIBELLE = $E_LIBELLE;
  }

  //GETTERS
  public function getE_CODE(){
    return $this->E_CODE;
  }

  public function getE_LIBELLE(){
    return $this->E_LIBELLE;
  }
}
?>

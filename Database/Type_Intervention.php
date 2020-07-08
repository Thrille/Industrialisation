<?php
require_once __ROOT__.'/Database/Entity.php';
class Type_Intervention extends Entity{
  protected $TI_CODE, $TI_LIBELLE;

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

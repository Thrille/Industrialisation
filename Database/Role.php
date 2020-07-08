<?php
require_once __ROOT__.'/Database/Entity.php';
class Role extends Entity{
  protected $R_LIBELLE, $R_CODE;

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

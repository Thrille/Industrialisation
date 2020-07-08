<?php
require_once __ROOT__.'/Database/Entity.php';
class Etat extends Entity{
  protected $E_CODE, $E_LIBELLE;

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

<?php
require_once __ROOT__.'/Database/Entity.php';
class Jeton_Authentification extends Entity{
  protected $JA_ID, $JA_HASH, $JA_DUREE, $UTILISATEUR_U_ID;

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
  public function setJA_ID($JA_ID){
    $JA_ID = (int) $JA_ID;
    if($JA_ID > 0){
      $this->JA_ID = $JA_ID;
    }
  }

  public function setJA_HASH($JA_HASH){
    $this->JA_HASH = $JA_HASH;
  }

  public function setJA_DUREE($JA_DUREE){
    $this->JA_DUREE = $JA_DUREE;
  }

  public function setUTILISATEUR_U_ID($UTILISATEUR_U_ID){
    $this->UTILISATEUR_U_ID = $UTILISATEUR_U_ID;
  }

  //GETTERS
  public function getJA_ID(){
    return $this->JA_ID;
  }

  public function getJA_HASH(){
    return $this->JA_HASH;
  }

  public function getJA_DUREE(){
    return $this->JA_DUREE;
  }

  public function getUTILISATEUR_U_ID(){
    return $this->UTILISATEUR_U_ID;
  }
}
?>

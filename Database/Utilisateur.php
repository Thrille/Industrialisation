<?php
require_once __ROOT__.'/Database/Entity.php';
class Utilisateur extends Entity{
  protected $U_ID, $U_IDENTIFIANT, $ROLE_R_CODE;
  private $U_MDP;

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
    return $this->U_MDR;
  }
}
?>
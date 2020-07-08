<?php
require_once __ROOT__.'/Database/Entity.php';
class Intervention extends Entity{
  protected $UTILISATEUR_U_ID, $TICKET_T_ID, $TYPE_INTERVENTION_TI_CODE, $I_DATE;

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
  public function setUTILISATEUR_U_ID($UTILISATEUR_U_ID){
    $UTILISATEUR_U_ID = (int) $UTILISATEUR_U_ID;
    if($UTILISATEUR_U_ID > 0){
      $this->UTILISATEUR_U_ID = $UTILISATEUR_U_ID;
    }
  }

  public function setTICKET_T_ID($TICKET_T_ID){
    $TICKET_T_ID = (int) $TICKET_T_ID;
    if($TICKET_T_ID > 0){
      $this->TICKET_T_ID = $TICKET_T_ID;
    }
  }

  public function setTYPE_INTERVENTION_TI_CODE($TYPE_INTERVENTION_TI_CODE){
    $this->TYPE_INTERVENTION_TI_CODE = $TYPE_INTERVENTION_TI_CODE;
  }

  public function setI_DATE($I_DATE){
    $this->I_DATE = $I_DATE;
  }

  //GETTERS
  public function getUTILISATEUR_U_ID(){
    return $this->UTILISATEUR_U_ID;
  }

  public function getTICKET_T_ID(){
    return $this->TICKET_T_ID;
  }

  public function getTYPE_INTERVENTION_TI_CODE(){
    return $this->TYPE_INTERVENTION_TI_CODE;
  }

  public function getI_DATE(){
    return $this->I_DATE;
  }
}
?>

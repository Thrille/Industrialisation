<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Type_Intervention.php';
class TypesInterventionManager extends Model{

  //récupère tous les types d'intervention
  public function getAllTypesIntervention(){
    return $this->getAnn('TYPE_INTERVENTION', 'Type_Intervention');
  }

  //récupère un type d'intervention parr rapport à son code
  public function getType_Intervention($code){
    $req = $this->getBdd()->prepare('SELECT * FROM TYPE_INTERVENTION WHERE TI_CODE='.$code);
    $req->execute();
    $var = $req->fetch(PDO::FETCH_ASSOC);
    return $var;
  }
}
?>

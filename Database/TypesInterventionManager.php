<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Type_Intervention.php';
class TypesInterventionManager extends Model{

  private $sModel = 'Type_Intervention';

  //récupère tous les types d'intervention
  public function getAllTypes_Intervention(){
    return $this->getAll('TYPE_INTERVENTION', 'Type_Intervention');
  }

  //récupère un type d'intervention parr rapport à son code
  public function getType_Intervention($iCode){
    $req = $this->getBdd()->prepare('SELECT * FROM TYPE_INTERVENTION WHERE TI_CODE= :code;');
    $req->execute(array(
      ':code' => $iCode
    ));
    $aData = $req->fetch(PDO::FETCH_ASSOC);

    if(is_array($aData)){
      return new $this->sModel($aData);
    }

    return NULL;
  }
}
?>

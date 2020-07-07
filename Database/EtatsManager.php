<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Etat.php';
class EtatsManager extends Model{

  private $sModel = 'Etat';

  //récupère tous les etats
  public function getAllEtats(){
    return $this->getAll('ETAT', 'Etat');
  }

  //récupère un etat par rapport à son code
  public function getEtat($code){
    $req = $this->getBdd()->prepare('SELECT * FROM ETAT WHERE E_CODE = :code;');
    $req->execute(array(
      ':code' => $code
    ));
    $var = $req->fetch(PDO::FETCH_ASSOC);

    if(is_array($var)){
      return new $this->sModel($var);
    }
    
    return NULL;
  }
}
?>

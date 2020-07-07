<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Etat.php';
class EtatsManager extends Model{

  //récupère tous les etats
  public function getAllEtats(){
    return $this->getAll('ETAT', 'Etat');
  }

  //récupère un etat par rapport à son code
  public function getEtat($code){
    $req = $this->getBdd()->prepare('SELECT * FROM ETAT WHERE E_CODE = '.$code.);
    $req->execute();
    $var = $req->fetch(PDO::FETCH_ASSOC);
    return $var;
  }
}
?>

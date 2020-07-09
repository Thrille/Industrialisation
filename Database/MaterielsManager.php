<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Materiel.php';
class MaterielsManager extends Model{

  private $sModel = 'Materiel';

  //récupère tous les matériels
  public function getAllMateriels(){
    return $this->getAll('MATERIEL', 'Materiel');
  }

  //récupère un matériel par rapport à son id
  public function getMateriel($id){
    $req = $this->getBdd()->prepare('SELECT * FROM MATERIEL WHERE M_ID= :id;');
    $req->execute(array(
      ':id' => $id
    ));
    $var = $req->fetch(PDO::FETCH_ASSOC);
    if(is_array($var)){
      return new $this->sModel($var);
    }

    return NULL;
  }
}
?>

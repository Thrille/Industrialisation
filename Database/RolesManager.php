<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Role.php';
class RolesManager extends Model{

  //récupère tous les roles
  public function getAllRoles(){
    return $this->getAll('TICKET')
  }

  //récupère un role par rapport à son code
  public function getRole($code){
    $req = $this->getBdd()->prepare('SELECT * FROM TOLE WHERE R_CODE='.$code);
    $req->execute();
    $var = $req->fetch(PDO::FETCH_ASSOC);
    return $var;
  }
}
?>

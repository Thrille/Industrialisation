<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Role.php';
class RolesManager extends Model{

  private $sModel = 'Role';

  //récupère tous les roles
  public function getAllRoles(){
    return $this->getAll('ROLE', 'Role');
  }

  //récupère un role par rapport à son code
  public function getRole($code){
    $req = $this->getBdd()->prepare('SELECT * FROM ROLE WHERE R_CODE= :code;');
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

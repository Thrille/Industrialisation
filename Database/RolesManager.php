<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Role.php';
class RolesManager extends Model{

  //récupère tous les roles
  public function getAllRoles(){
    return $this->getAll('TICKET')
  }

  //récupère un role par rapport à son code
  public
}
?>

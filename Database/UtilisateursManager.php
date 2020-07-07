<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Utilisateur.php';
class UtilisateursManager extends Model{

  private $sModel = 'Utilisateur';

  //récupère tous les utilisateurs
  public function getAllUtilisateurs(){
    return $this->getAll('UTILISATEUR', 'Utilisateur');
  }

  //récupère un utilisateur par rapport à son id
  public function getTicket($id)
  {
    $req = $this->getBdd()->prepare('SELECT * FROM UTILISATEUR WHERE U_ID= :id;');
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

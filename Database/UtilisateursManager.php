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
  public function getUtilisateur($id)
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

  //récupère un utilisateur par rapport à son identifiant
  public function getUtilisateurByIdentifiant($identifiant){
    $req = $this->getBdd()->prepare('SELECT * FROM UTILISATEUR WHERE U_IDENDTIFIANT= :identifiant;');
    $req->execute(array(
      ':identifiant' => $identifiant
    ));
    $var = $req->fetch(PDO::FETCH_ASSOC);

    if(is_array($var)){
      return new $this->sModel($var);
    }
    return NULL;
  }

  //récupère tous les techniciens
  public function getAllTechniciens(){
    $req = $this->getBdd()->prepare('SELECT * FROM UTILISATEUR WHERE ROLE_R_CODE= :role_code;');
    $req->execute(array(
      ':role_code' => 'T'
    ));
    $var = [];
    while($data = $req->fetch(PDO::FETCH_ASSOC)){

      $var[] = new $this->sModel($data);
    }

    if(is_array($var)){
      return $var;
    }
    return NULL;
  }

  //vérifie que le token identifie un technicien
  public function isTechnicien($JA_HASH){
    $req = $this->getBdd()->prepare('SELECT UTILISATEUR.ROLE_R_CODE FROM JETON_AUTHENTIFICATION JOIN UTILISATEUR ON JETON_AUTHENTIFICATION.UTILISATEUR_U_ID = UTILISATEUR.U_ID WHERE JETON_AUTHENTIFICATION.JA_HASH = :JA_HASH;');
    $req->execute(array(
      ':JA_HASH' => $JA_HASH
    ));
    $var = $req->fetch(PDO::FETCH_ASSOC);

    if($var['ROLE_R_CODE'] == 'T'){
      return true;
    }
    else{
      return false;
    }
  }
}
?>

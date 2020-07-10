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
  public function getUtilisateur($iId)
  {
    $req = $this->getBdd()->prepare('SELECT * FROM UTILISATEUR WHERE U_ID= :id;');
    $req->execute(array(
      ':id' => $iId
    ));
    $aData = $req->fetch(PDO::FETCH_ASSOC);

    if(is_array($aData)){
      return new $this->sModel($aData);
    }
    return NULL;
  }

  //récupère un utilisateur par rapport à son identifiant
  public function getUtilisateurByIdentifiant($iIdentifiant){
    $req = $this->getBdd()->prepare('SELECT * FROM UTILISATEUR WHERE U_IDENTIFIANT= :identifiant;');
    $req->execute(array(
      ':identifiant' => $iIdentifiant
    ));
    $aData = $req->fetch(PDO::FETCH_ASSOC);

    if(is_array($aData)){
      return new $this->sModel($aData);
    }
    return NULL;
  }

  //récupère tous les techniciens
  public function getAllTechniciens(){
    $req = $this->getBdd()->prepare('SELECT * FROM UTILISATEUR WHERE ROLE_R_CODE= :role_code;');
    $req->execute(array(
      ':role_code' => 'T'
    ));
    $aVar = [];
    while($aData = $req->fetch(PDO::FETCH_ASSOC)){

      $aVar[] = new $this->sModel($aData);
    }

    if(is_array($aVar)){
      return $aVar;
    }
    return NULL;
  }

  //vérifie que le token identifie un technicien
  public function isTechnicien($JA_HASH){
    $req = $this->getBdd()->prepare('SELECT UTILISATEUR.ROLE_R_CODE FROM JETON_AUTHENTIFICATION JOIN UTILISATEUR ON JETON_AUTHENTIFICATION.UTILISATEUR_U_ID = UTILISATEUR.U_ID WHERE JETON_AUTHENTIFICATION.JA_HASH = :JA_HASH;');
    $req->execute(array(
      ':JA_HASH' => $JA_HASH
    ));
    $aData = $req->fetch(PDO::FETCH_ASSOC);

    if($aData['ROLE_R_CODE'] == 'T'){
      return true;
    }
    else{
      return false;
    }
  }
}
?>

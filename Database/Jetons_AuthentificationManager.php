<?php
require_once __ROOT__.'/Database/Model.php';
require_once __ROOT__.'/Database/Jeton_Authentification.php';
class Jetons_AuthentificationManager extends Model{

  private $sModel = 'Jeton_Authentification';

  //récupère tous les jetons d'authentification
  public function getAllJetons_Authentification(){
    return $this->getAll('JETON_AUTHENTIFICATION', 'Jeton_Authentification');
  }

  //récupère un jeton d'authentification par rapport à son id
  public function getJeton_Authentification($id)
  {
    $req = $this->getBdd()->prepare('SELECT * FROM JETON_AUTHENTIFICATION WHERE JA_ID= :id;');
    $req->execute(array(
      ':id' => $id
    ));
    $var = $req->fetch(PDO::FETCH_ASSOC);

    if(is_array($var)){
      return new $this->sModel($var);
    }

    return NULL;
  }

  //modifie le jeton d'authentification avec l'id correspondant + retourne le jeton d'authentification modifié
  public function updateJeton_Authentification($id, array $param){
    $req = $this->getBdd()->prepare('UPDATE JETON_AUTHENTIFICATION SET JA_HASH = :hash, JA_DUREE = :duree, UTILISATEUR_U_ID = :utilisateur WHERE JA_ID = :id;');
    $req->execute(array(
      ':hash' => $param['hash'],
      ':duree' => $param['duree'],
      ':utilisateur' => $param['utilisateur'],
      ':id' => $id
    ));
    return getJeton_Authentification($id);
  }

  //supprime le jeton d'authentification avec l'id correspondant + retourne un true si supression effectué et false sinon
  public function deleteJeton_Authetification(int $id){
    $req = $this->getBdd()->prepare('DELETE FROM JETON_AUTHENTIFICATION WHERE JA_ID = :id;');
    $count = $req->execute(array(
      ':id' => $id
    ));
    if($count != 0){
      return true;
    }
    else{
      return false;
    }
  }

  //créer un nouveau jeton d'authentification
  public function createJeton_Authetification(array $param){
    $req = $this->getBdd()->prepare('INSERT INTO JETON_AUTHENTIFICATION (JA_HASH, JA_DUREE, UTILISATEUR_U_ID) VALUES (:hash, :duree, :utilisateur);');
    $count = $req->execute(array(
      ':hash' => $param['hash'],
      ':duree' => $param['duree'],
      ':utilisateur' => $param['utilisateur']
    ));
    if($count != 0){

      $req = $this->getBdd()->prepare('SELECT LAST_INSERT_ID() AS ID;');
      $req->execute();
      $var = $req->fetch(PDO::FETCH_ASSOC);

      return $this->getJeton_Authentification(intval($var['ID']));
    }
    else{
      return false;
    }
  }
}
?>

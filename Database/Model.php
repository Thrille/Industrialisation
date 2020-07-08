<?php
require_once(dirname(__FILE__).'/.env.php');

abstract class Model{
  private static $bdd;

  //instanciation connexion bdd
  private static function setBdd(){
    self::$bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';port='.DB_PORT.';charset='.DB_CHARSET, DB_USER, DB_PASSWORD);
    self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }

  //recupération bdd
  protected function getBdd(){
    if(self::$bdd == null){
      self::setBdd();
    }
    return self::$bdd;
  }

  protected function getAll($table, $obj){
    $var = [];
    $aResult = array();
    $req = $this->getBdd()->prepare('SELECT * FROM ' .$table);
    $req->execute();
    while($data = $req->fetch(PDO::FETCH_ASSOC)){

      $var[] = new $obj($data);  
    }

    return $var;
    $req->closeCursor();
  }
}
?>

<?php
require_once __ROOT__.'/Database/Entity.php';
  class Materiel extends Entity{
    protected $M_ID, $M_LIBELLE;

    public function __construct(array $data){
      $this->hydrate($data);
    }

    //hydratation
    public function hydrate(array $data){
      foreach($data as $key => $value){
        $method = 'set'.ucfirst($key);
        if(method_exists($this, $method)){
          $this->$method($value);
        }
      }
    }

    //SETTERS
    public function setM_ID($M_ID){
      $this->M_ID = $M_ID;
    }

    public function setM_LIBELLE($M_LIBELLE){
      $this->M_LIBELLE = $M_LIBELLE;
    }

    //GETTERS
    public function getM_ID(){
      return $this->M_ID;
    }

    public function getM_LIBELLE(){
      return $this->M_LIBELLE;
    }
  }
?>

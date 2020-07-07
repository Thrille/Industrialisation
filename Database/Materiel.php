<?php
  class Materiel{
    private $M_ID, $M_LIBELLE;

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

    //GETTERS
    public function getM_ID(){
      return $this->M_ID;
    }

    public function getM_LIBELLE(){
      return $this->M_LIBELLE;
    }
  }
?>

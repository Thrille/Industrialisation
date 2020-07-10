<?php
require_once __ROOT__.'/Database/Entity.php';
  class Materiel extends Entity{
    protected $M_ID, $M_LIBELLE;

    public function __construct(array $aData){
      $this->hydrate($aData);
    }

    //hydratation
    public function hydrate(array $aData){
      foreach($aData as $sKey => $sValue){
        $sMethod = 'set'.ucfirst($sKey);
        if(method_exists($this, $sMethod)){
          $this->$sMethod($sValue);
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

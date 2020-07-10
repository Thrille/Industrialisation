<?php

//class dont vont hériter les modèles
class Entity{

  //retourne les propriétés de l'objet
  public function getProperties() {
    return get_object_vars($this);
  }

  //permet de convertir l'objet en json
  public function toJSON(){

    return json_encode($this->getProperties());
  }
}
?>

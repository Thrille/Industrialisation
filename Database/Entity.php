<?php

class Entity{

  public function getProperties() {
    return get_object_vars($this);
  }

  public function toJSON(){

    return json_encode($this->getProperties());
  }
}
?>
<?php

trait Helpers {
    public static function CollectionToJSON(array $aCollection) {
        $aResultCollection = array();
    
        foreach($aCollection as $oEntry) {
          if (is_object($oEntry)) {
    
            if (is_subclass_of($oEntry, 'Entity')) {
              array_push($aResultCollection, $oEntry->getProperties());
            }
          }
          else {
            array_push($aResultCollection, $oEntry);
          }
        }
    
        return $aResultCollection;
        return json_encode($aResultCollection);
      }
}
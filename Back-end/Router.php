<?php

class Router
{
    private $_ctrl;

    public function routeReq()
    {
        try {
            // Chargement automatique des classes
            spl_autoload_register(function($class){
                require_once('Database/'.$class.'.php');
            });

            
        } catch (Exception $e) {
            //throw $th;
        }
    }
}
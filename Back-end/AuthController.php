<?php
require_once __ROOT__.'/Database/UtilisateursManager.php';
require_once __ROOT__.'/Database/Jetons_AuthentificationManager.php';

class AuthController{
    private static $_utilisateurManager;
    private static $_tokenManager;
    
    //Fonction de connection
    static function Login($Login, $Password)
    {
        self::$_utilisateurManager = new UtilisateursManager;
        $utilisateur = self::$_utilisateurManager->getUtilisateurByIdentifiant($Login);       
        $Password = hash('sha256', $Password);

        //Compare le mot de passe rentré et le mot de passe enregistré
        if ($utilisateur && $Password == $utilisateur->getU_MDP())
        {
            //si ok on set la session et le token d'id pour l'API        
            $sToken = date('Y-m-d').''.$utilisateur->getU_ID();
            $dDure = date('Y-m-d', strtotime("+1 week"));
            $hToken = hash('sha256', $sToken);
            self::$_tokenManager = new Jetons_AuthentificationManager;
            $aparam = array(
                'hash' => $hToken,
                'duree' => $dDure,
                'utilisateur' => $utilisateur->getU_ID()
            );
            self::$_tokenManager->createJeton_Authetification($aparam);
            return json_encode(array('token' => $hToken));            
        } 
        else 
        {
            //on renvoie une erreur de connexion          
            http_response_code(403);
            die();
        }
    }

    //Fonction de déconnexion
    function Logout(){

    }
}
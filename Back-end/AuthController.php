<?php
namespace Controller;

class AuthController{
    private static $_utilisateurManager;
    
    //Fonction de connection
    function Login($Login, $Password){
        self::$_utilisateurManager = new UtilisateurManager;
        $utilisateur = self::$_utilisateurManager->getUtilisateurByIdentifiant($Login);       

        //Compare le mot de passe rentré et le mot de passe enregistré
        if ($user && password_verify($Password, $user['U_IDENTIFIANT']))
        {
            //si ok on set la session et le token d'id pour l'API
            echo "Identifiant valide!";
        } else {
            //on renvoie une erreur de connexion
            echo "Identifiant invalide!";
        }
    }

    //Fonction de déconnexion
    function Logout(){

    }
}
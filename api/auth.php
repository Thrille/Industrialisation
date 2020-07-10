<?php
    // On importe les références pour appeler les controller, ce qui permet de déclancher les actions back-end
    @define('__ROOT__', dirname(__DIR__));

    require_once __ROOT__.'/Back-end/AuthController.php' ;
    

    // Cette fonction permet de lire le contenu de la requète lorsque $_GET, $_POST et $_REQUEST ne permettent pas de l'obtenir
    function ReadRequestBody() {

        // lecture du flux de donnée avec un retour sous forme de chaine
        $sRequestContent = file_get_contents('php://input');

        return json_decode($sRequestContent, true);
    }

    // On n'accepte que le contenu de type JSON pour le transite au sein de l'API
    if ($_SERVER['HTTP_ACCEPT'] !== 'application/json') {
        http_response_code(400);
        die();
    }

    // L'application adopte des comportements différents en fonction de la méthode HTTP utilisé
    switch($_SERVER['REQUEST_METHOD']) {
        // Si c'est une requète avec la méthode GET
        case 'POST':

            $bValid = false;

            // on met à jour le header pour préciser le type de données renvoyer (du JSON pour conserver le type de l'appel)
            header('Content-Type: application/json');

            // on utilise la fonction ReadRequestBody car php ne lit pas le contenu de la requete pour la méthode PATCH 
            $aRequestBody = ReadRequestBody();

            // on vérifie les données de la requete
            if (isset($aRequestBody['login'])) {
                $sLogin = strval($aRequestBody['login']);

                if (strlen($sLogin) > 0) {

                    if (isset($aRequestBody['password'])) {
                        $sPassword = strval($aRequestBody['password']);

                        if (strlen($sPassword) > 0) {
                            // on valide la requete
                            $bValid = true;
                        }
                    }
                }

            }

            // la requete est valide
            if ($bValid) {

                echo AuthController::Login($sLogin, $sPassword);
            }
            else {

                // la requete n'est pas valide, on revois l'erreur "400 Bad Request" car la requete est mal formée
                http_response_code(400);
            }

            break;
        default:
            // si la méthode n'est pas GET on renvois le code erreur "405 Method Not Allowed"
            http_response_code(405);
            break;
    }

    // on ferme la connection pour optimiser l'utilisation concurentielle
    die();
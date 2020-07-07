<?php
    // On importe les références pour appeler les controller, ce qui permet de déclancher les actions back-end
    require_once(dirname(__FILE__).'/../Back-end/TicketController.php');

    // On n'accepte que le contenu de type JSON pour le transite au sein de l'API
    if ($_SERVER['HTTP_ACCEPT'] !== 'application/json') {
        http_response_code(400);
        die();
    }

    // L'application adopte des comportements différents en fonction de la méthode HTTP utilisé
    switch($_SERVER['REQUEST_METHOD']) {
        // Si c'est une requète avec la méthode GET
        case 'GET':

            // on met à jour le header pour préciser le type de données renvoyer (du JSON pour conserver le type de l'appel)
            header('Content-Type: application/json');

            // On renvois les informations correspondant à la liste des ticket
            echo TicketController::GetAllTickets();
            break;
        default:
            // si la méthode n'est pas GET on renvois le code erreur "405 Method Not Allowed"
            http_response_code(405);
            break;
    }

    // on ferme la connection pour optimiser l'utilisation concurentielle
    die();
<?php
// On importe les références pour appeler les controller, ce qui permet de déclancher les actions back-end
    require_once (dirname(__FILE__).'/../Back-end/TicketController.php');
    use Controller\TicketController;

    // Cette fonction permet de lire le contenu de la requète lorsque $_GET, $_POST et $_REQUEST ne permettent pas de l'obtenir
    function ReadRequestBody() {

        $aRequestParameters = [];

        // lecture du flux de donnée avec un retour sous forme de chaine
        $sRequestContent = file_get_contents('php://input');

        // on converti la chaine en tableau
        $aSplitedRequestContent = explode('&', $sRequestContent);

        // on traite les entrées du tableau obtenu
        foreach($aSplitedRequestContent as $sValue) {

            // on converti la chaine en tableau
            $aExplodedValue = explode('=', $sValue);

            // on ajoute une entré au tableau final pour obtenir une structure semblable à $_GET, $_POST et $_REQUEST
            $aRequestParameters[$aExplodedValue[0]] = $aExplodedValue[1];
        }

        return $aRequestParameters;
    }

    // On n'accepte que le contenu de type JSON pour le transite au sein de l'API
    if ($_SERVER['HTTP_ACCEPT'] !== 'application/json') {
        http_response_code(400);
        die();
    }

    // L'application adopte des comportements différents en fonction de la méthode HTTP utilisé
    switch($_SERVER['REQUEST_METHOD']) {

        // Si c'est une requète avec la méthode GET
        case 'GET':

            // on définit une variable qui sera vrai si tout est valide
            $bValid = false;

            // on vérifie les données de la requete
            if (isset($_REQUEST['id'])) {
                $iId = intval($_REQUEST['id']);

                if ($iId > 0) {
                    
                    // on valide la requete
                    $bValid = true;
                }
            }

            // la requete est valide
            if ($bValid) {

                // on met à jour le header pour préciser le type de données renvoyer (du JSON pour conserver le type de l'appel)
                header('Content-Type: application/json');

                echo TicketController::GetTicket($iId);
            }
            else {

                // la requete n'est pas valide, on revois l'erreur "400 Bad Request" car la requete est mal formée
                http_response_code(400);
            }

            break;

        case 'POST':

            $bValid = false;


            // logique de validation du contenu de la requète
            if (isset($_REQUEST['ticket_number'])) {

                $sTicketNumber = strval($_REQUEST['ticket_number']);

                if (strlen($sTicketNumber) > 0) {

                    if (isset($_REQUEST['ticket_description'])) {

                        $sTicketDescription = strval($_REQUEST['ticket_description']);
    
                        if (strlen($sTicketDescription) > 0) {
    
                            if (isset($_REQUEST['ticket_state_code'])) {
    
                                $sTicketStateCode = strval($_REQUEST['ticket_state_code']);
        
                                if (strlen($sTicketStateCode) > 0) {
        
                                    if (isset($_REQUEST['ticket_device_code'])) {
        
                                        $sTicketDeviceCode = strval($_REQUEST['ticket_device_code']);
            
                                        if (strlen($sTicketDeviceCode) > 0) {
                                            $bValid = true;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if ($bValid) {

                // on construit les paramètres pour l'action l'action du controlleur
                $aParam = array(
                    'number'    =>  $sTicketNumber,
                    'description'   =>  $sTicketDescription,
                    'stateCode' =>  $sTicketStateCode,
                    'deviceCode'    =>  $sTicketDeviceCode
                );

                // on met à jour le header pour préciser le type de données renvoyer (du JSON pour conserver le type de l'appel)
                header('Content-Type: application/json');


                // on lance l'action de création du ticket
                echo TicketController::Create($aParam);
            }
            else {

                // la requete n'est pas valide, on revois l'erreur "400 Bad Request" car la requete est mal formée
                http_response_code(400);
            }

            break;

        case 'PATCH':

            $bValid = false;

            // on utilise la fonction ReadRequestBody car php ne lit pas le contenu de la requete pour la méthode PATCH 
            $aRequestBody = ReadRequestBody();

            // logique de validation
            if (isset($_REQUEST['id'])) {

                $iId = intval($_REQUEST['id']);

                if ($iId > 0) {

                    if (isset($aRequestBody['ticket_number'])) {

                        $sTicketNumber = strval($aRequestBody['ticket_number']);
        
                        if (strlen($sTicketNumber) > 0) {
        
                            if (isset($aRequestBody['ticket_description'])) {
        
                                $sTicketDescription = strval($aRequestBody['ticket_description']);
            
                                if (strlen($sTicketDescription) > 0) {
            
                                    if (isset($aRequestBody['ticket_state_code'])) {
            
                                        $sTicketStateCode = strval($aRequestBody['ticket_state_code']);
                
                                        if (strlen($sTicketStateCode) > 0) {
                
                                            if (isset($aRequestBody['ticket_device_code'])) {
                
                                                $sTicketDeviceCode = strval($aRequestBody['ticket_device_code']);
                    
                                                if (strlen($sTicketDeviceCode) > 0) {
                                                    $bValid = true;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if ($bValid) {

                // on construit le tableau de paramètres pour l'action du controlleur
                $aParam = array(
                    'number'    =>  $sTicketNumber,
                    'description'   =>  $sTicketDescription,
                    'stateCode' =>  $sTicketStateCode,
                    'deviceCode'    =>  $sTicketDeviceCode
                );

                // on met à jour le header pour préciser le type de données renvoyer (du JSON pour conserver le type de l'appel)
                header('Content-Type: application/json');

                // on met à jour le ticket via le controlleur
                echo TicketController::Update($iId, $aParam);
            }
            else {
                
                // la requete n'est pas valide, on revois l'erreur "400 Bad Request" car la requete est mal formée
                http_response_code(400);
            }

            break;
        case 'DELETE':

            $bValid = false;

            // logique du validateur
            if (isset($_REQUEST['id'])) {
                $iId = intval($_REQUEST['id']);

                if ($iId > 0) {
                    $bValid = true;
                }
            }

            if ($bValid) {

                // on met à jour le header pour préciser le type de données renvoyer (du JSON pour conserver le type de l'appel)
                header('Content-Type: application/json');

                // on lance le controleur de suptression du ticket
                echo TicketController::Delete($iId);
            }
            else {
                
                // la requete n'est pas valide, on revois l'erreur "400 Bad Request" car la requete est mal formée
                http_response_code(400);
            }

            break;
        default:

            // si la méthode n'est pas GET, POST, PATCH ou DELETE on renvois le code erreur "405 Method Not Allowed"
            http_response_code(405);
            break;
    }

    die();
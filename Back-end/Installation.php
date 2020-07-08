<?php

// Ce script permet de générer un fichier .env.php à partir du fichier .env.example.php
// pour l'exécuter, lancer la commande suivante : php Back-end/Installation.php
// pour remplacer les valeurs par défaut, spécifiez les arguments de la ligne de commande, par exemple :
// php Back-end/Installation.php DB_HOST=localhost
// remplacera la valeur de DB_HOST par 'localhost' dans le fichier d'environnemnt

// On défini le chemin statique vers la racine du projet
@define('__ROOT__', dirname(__DIR__));

// On définit les emplacement des fichiers (source et cible)
$sSourceFilePath = __ROOT__.'/Database/.env.example.php';
$sTargetFilePath = __ROOT__.'/Database/.env.php';

// on copie le fichier
if (!copy($sSourceFilePath, $sTargetFilePath)) {
    echo "Echec de copie du fichier $sSourceFilePath";
    die();
}

// on li les arguments de la commande
foreach($argv as $value) {
    $aValue = explode('=', $value);

    // si l'argument est du type Clé=Valeur
    if (count($aValue) > 1) {

        // on cherche la ligne de la Clé
        $sRegex = "/\('$aValue[0]'.+\)/";

        // on remplace la ligne par la nouvelle valeur
        $sReplace = "('$aValue[0]', '$aValue[1]')";

        // on li le contenu du fichier
        $sFileContent = file_get_contents($sTargetFilePath);

        // on remplace met à jour la valeur du fichier
        file_put_contents($sTargetFilePath, preg_replace($sRegex, $sReplace, $sFileContent));
    }
}
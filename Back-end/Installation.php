<?php

@define('__ROOT__', dirname(__DIR__));

$sSourceFilePath = __ROOT__.'/Database/.env.example.php';
$sTargetFilePath = __ROOT__.'/Database/.env.php';

if (!copy($sSourceFilePath, $sTargetFilePath)) {
    echo "Echec de copie du fichier $sSourceFilePath";
    die();
}

foreach($argv as $value) {
    $aValue = explode('=', $value);

    if (count($aValue) > 1) {

        $sRegex = "/\('$aValue[0]'.+\)/";

        $sReplace = "('$aValue[0]', '$aValue[1]')";

        $sFileContent = file_get_contents($sTargetFilePath);

        file_put_contents($sTargetFilePath, preg_replace($sRegex, $sReplace, $sFileContent));
        //file_put_contents($sTargetFilePath, str_replace('/$aValue[0]/', ', $aValue[1], file_get_contents($sTargetFilePath)));
    }
}
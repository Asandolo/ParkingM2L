<?php

//BDD MySql
////////////////////////////////////////////////////////////////////////////////////////////////////////////
$srv = '217.182.50.221'; //adresse du serveur (localhost si inconu)
$user = 'par'; //Nom d'utilisateur MySql (root si inconu)
$pass  = 'yolo'; //Mot de passe MySQL
$db = 'parking'; //Base de donnée
$port = '3306'; //Port MySql (3306 par defaut)

//////NE PAS TOUCHER ICI////////////////////////////////////////////////////////////////////////////////////

try {
    $bdd = new PDO('mysql:host='.$srv.';port='.$port.';dbname='.$db, $user, $pass);
}
catch(PDOException $e)
{
    echo 'Erreur : '.$e->getMessage().'<br />';
    echo 'N° : '.$e->getCode();
}

?>

?>
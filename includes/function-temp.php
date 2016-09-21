<?php 
// HASH Du MOT DE PASS
function hashMdp($psw) {


// FONCTION MINIMALISTE, prenez contact pour une fonction plus sécurisé

	return md5($psw);
}


//BDD MySql
////////////////////////////////////////////////////////////////////////////////////////////////////////////
 $srv = 'A REMPIRE'; //adresse du serveur (localhost si inconu)
 $user = 'A REMPIRE'; //Nom d'utilisateur MySql (root si inconu)
 $pass  = 'A REMPIRE'; //Mot de passe MySQL
 $db = 'A REMPIRE'; //Base de donnée
 $port = 'A REMPIRE'; //Port MySql (3306 par defaut)

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
<?php 
// HASH Du MOT DE PASS
function hashMdp($psw) {


	$mot1 = sha1(sha1(md5(sha1(md5(sha1(sha1(sha1(md5("A REMPLIRE")))))))));

	$mot2 = md5(md5(md5(sha1(sha1(sha1(sha1("A REMPLIRE")))))));

	$pw = md5(md5(md5(md5(md5(sha1(sha1(md5(md5($psw)))))))));

	return $mot1.$pw.$mot2;
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
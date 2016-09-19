<?php 
// HASH Du MOT DE PASS
function hashMdp($psw) {


	$mot1 = sha1(sha1(md5(sha1(md5(sha1(sha1(sha1(md5("Hasard")))))))));

	$mot2 = md5(md5(md5(sha1(sha1(sha1(sha1("Deuxiemme")))))));

	$pw = md5(md5(md5(md5(md5(sha1(sha1(md5(md5($psw)))))))));

	return $mot1.$pw.$mot2;
}


//BDD MySql
////////////////////////////////////////////////////////////////////////////////////////////////////////////
 $srv = 'localhost'; //adresse du serveur (localhost si inconu)
 $user = 'root'; //Nom d'utilisateur MySql (root si inconu)
 $pass  = ''; //Mot de passe MySQL
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

$var = "var";

?>
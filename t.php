<?php
include("includes/function.php");

$s = $bdd->prepare("SELECT * FROM `reserver`, `place`, `membre` WHERE `reserver`.`id_membre` = `membre`.`id_membre` AND `place`.`id_place` = `reserver`.`id_place` AND `reserver`.`id_membre` = ?");
$s->execute(array($user["id_membre"]));

while ($d=$s->fetch()) {
	echo "<pre>";;
	print_r($d);
	echo "</pre>";
}


?>
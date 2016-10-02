<?php 

include('includes/function.php');

$s = $bdd->query("SELECT * FROM `place` WHERE `active_place` = 1;");
$c = $s->rowCount();

if($c >=30 ){
	echo "30 premiere place deja ok";
}else {

for ($i=1; $i <=30 ; $i++) { 
	$u = $bdd->prepare("UPDATE `place` SET `active_place` = 1;");
	$u->execute();
	echo "ok".$i."<br />";
}

}




?>
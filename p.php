<?php 

include('includes/function.php');

$s = $bdd->query("SELECT * FROM `place`;");
$c = $s->rowCount();

if($c >=10 ){
	echo "10 premiere place deja ok";
}else {

for ($i=1; $i <=10 ; $i++) { 
	$in = $bdd->prepare("INSERT INTO `place` VALUES('',?);");
	$in->execute(array($i));
	echo "ok".$i."<br />";
}

}




?>
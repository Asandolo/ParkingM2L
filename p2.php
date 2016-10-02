<?php 

include('includes/function.php');

$s = $bdd->query("SELECT * FROM `place`;");
$c = $s->rowCount();

if($c >=30 ){
	echo "30 premiere place deja ok";
}else {

for ($i=1; $i <=30 ; $i++) { 
	$in = $bdd->prepare("INSERT INTO `place` (`num_place`) VALUES(?);");
	$in->execute(array($i));
	echo "ok".$i."<br />";
}

}




?>
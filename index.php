<?php 
$titre = "Acceuil";
include("includes/pages/header.php");
?>

		<div class="row">
			<div class="col-md-12 black">
				<p>ici presentation</p>
			</div>
			<div class="col-md-12 black">
				<?php
				$ajd = date("Y-m-d"); 
				$tsajd = strtotime($ajd);

				$places = $bdd->prepare("SELECT * FROM `reserver`, `place` WHERE `id_membre` = ? AND date_debut_periode <= ? AND date_fin_periode >= ? AND `reserver`.`id_place` = `place`.`id_place`");
				$places->execute(array($user["id_membre"],$ajd,$ajd));
				$place = $places->fetch();


				$count = $places->rowCount();

				if ($count<=0 && $user["rang"]<=0) {
					echo "Vous n'avez aucune place et n'etes pas dans la file d'atente";
				}elseif($user["rang"]<=0){
					echo "Vous avez la place : ".$place["num_place"];
				}else{
					echo "vous etes rang : ".$user["rang"];
				}


				?>
				<p></p>
			</div>
		</div>

<?php include("includes/pages/footer.php"); ?>
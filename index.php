
<?php 
$titre = "Acceuil";
include("includes/pages/header.php");

if (isset($_POST["reserver"])) {
	# code de reservation de place
}

?>

		<div class="row">
			<div class="col-md-12 black">
				<p>ici presentation</p>
			</div>
			<div class="col-md-12 black">
				<center>
				<?php
				$ajd = date("Y-m-d"); 
				$tsajd = strtotime($ajd);

				$places = $bdd->prepare("SELECT * FROM `reserver`, `place` WHERE `id_membre` = ? AND date_debut_periode <= ? AND date_fin_periode >= ? AND `reserver`.`id_place` = `place`.`id_place`");
				$places->execute(array($user["id_membre"],$ajd,$ajd));
				$place = $places->fetch();


				$count = $places->rowCount();

				if ($count<=0 && $user["rang"]<=0) {
					echo "<p style='font-size:20px'>Vous n'avez aucune place et n'etes pas dans la file d'atente</p>";
					echo "<form><input class='btn btn-danger' value='Reserver une place' name='reserver' /></form>";
				}elseif($user["rang"]<=0){
					echo "<p style='font-size:20px'>Vous avez la place : <br /><strong>".$place["num_place"]."</strong></p>";
				}else{
					echo "<p style='font-size:20px'>Vous avez le rang : <br /><strong>".$user["rang"]."</strong></p>";
				}


				?>
				</center>
			</div>
		</div>

<?php include("includes/pages/footer.php"); ?>
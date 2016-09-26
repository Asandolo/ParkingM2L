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

				$places = $bdd->prepare("SELECT * FROM `reserver` WHERE `id_membre` = ?");
				$places->execute(array($user["id_membre"]));

				$ajd = date("Y-m-d"); 
				$ajd = strtotime($ajd);



				?>
				<p></p>
			</div>
		</div>

<?php include("includes/pages/footer.php"); ?>
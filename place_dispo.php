<?php 
$titre = "places disponibles";
include("includes/pages/header.php");
?>

		<div class="row">
			<div class="col-md-12 black">
				<p>PLACES DISPONNIBLES</p>
				<?php
					$aujourdhui = date("y-m-d");
					$CheckPlace = $bdd->prepare("SELECT num_place FROM PLACE ");
					$CheckPlace->execute();
					$i = 1;
					while($donnee = $CheckPlace->fetch())
					{
						$place[$i]=$donnee['num_place'];
						$i++;
					}

					$k=1;
					while ($k< $i) 
					{
						echo $place[$k];
					}
					
					$ajd = date("Y-m-d"); 
					$tsajd = strtotime($ajd);

					$places = $bdd->prepare("SELECT * FROM `reserver`, `place` WHERE date_debut_periode > ? AND date_fin_periode < ? AND `reserver`.`id_place` = `place`.`id_place`");
					$places->execute(array($ajd,$ajd));
					$j = 1;
					while ($doneeDispo = $places->fetch()) 
					{
						$placeDispo[$j] = $donneeDispo['num_place'];
						$j++;
						echo "<pre>";
						echo $placeDispo[$j];
						echo "</pre>";
					}
				?>
			</div>
		</div>

<?php include("includes/pages/footer.php"); ?>
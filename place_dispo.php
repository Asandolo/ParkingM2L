<?php 
$titre = "places disponibles";
include("includes/pages/header.php");
?>

<div class="row">
	<div class="col-md-12 black">
		<p><center>PLACES DISPONNIBLES</center></p>
	</div>		
</div>
<div class="row">
	<div class="col-md-12 black">
		<p>
		<center>
			<?php
				$aujourdhui = date("y-m-d");
//-----------------------------
//SELECTION DES PLACES RESERVE |
//-----------------------------	


				$CheckPlace = $bdd->prepare("SELECT num_place FROM PLACE,RESERVER WHERE PLACE.id_place = RESERVER.id_place AND date_fin_periode>= ? AND date_debut_periode <= ?");
					$CheckPlace->execute(array($aujourdhui, $aujourdhui));
				$i = 1;
				while($donnee = $CheckPlace->fetch())
				{
					$place[$i]=$donnee['num_place'];
					echo $place[$i]."</br>";
					$i++;
				}


//--------------------------------------------
// SELECTION DE TOUTES LES PALCES DE PARKING |
//--------------------------------------------
				$tsajd = strtotime($aujourdhui);
				
				$places = $bdd->prepare("SELECT num_place FROM PLACE");
				$places->execute();
				
				$j = 1;
				while ($donneeDispo = $places->fetch()) 
				{
					$placeDispo[$j] = $donneeDispo['num_place'];
					echo $placeDispo[$j]."</br>";
					$j++;
				}

//----------------------------------------------------------------
//MAGNIPULATION DES TABLEAUX POUR RESORTIR LES PLACES DISPONIBLES |
//----------------------------------------------------------------

			?>
		</center>
		</p>
	</div>
</div>

<?php include("includes/pages/footer.php"); ?>
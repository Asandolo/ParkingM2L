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
				$i = 0;
				while($donnee = $CheckPlace->fetch())
				{
					$place[$i]=$donnee['num_place'];
					//echo $place[$i]."</br>";
					$i++;
				}


//--------------------------------------------
// SELECTION DE TOUTES LES PALCES DE PARKING |
//--------------------------------------------
				
				$tsajd = strtotime($aujourdhui);
				
				$places = $bdd->prepare("SELECT num_place FROM PLACE");
				$places->execute();
				
				$j = 0;
				while ($donneeDispo = $places->fetch()) 
				{
					$placeDispo[$j] = $donneeDispo['num_place'];
					//echo $placeDispo[$j]."</br>";
					$j++;
				}

//----------------------------------------------------------------
//MAGNIPULATION DES TABLEAUX POUR RESORTIR LES PLACES DISPONIBLES |
//----------------------------------------------------------------
				// $place[0] = 0;
				// $placeDispo[0]=0;
				// $k=1;
				// $l=1;
				// $trieur = 1;
				// for($k=1;$k<=$i;$k++)
				// {
				// 	for($l=1;$l<=$j;$l++)
				// 	{
				// 		if($place[$l] == $placeDispo[$k])
				// 		{
				// 			$placeDispo[$l] = null;
				// 			for($trieur=$l;$trieur<$l;$trieur++)
				// 			{
				// 				$placeDispo[$trieur]=$placeDispo[$trieur+1];
				// 			}
				// 		}	

				// 	}
				// }

				//La fonction que tu cherchais
				if(empty($place)){
					echo "VIIIIIIIIIIIIIIIIDE";
				}


				for ($k=0; $k <=count($place)-1 ; $k++) 
				{ 
					for ($l=0; $l <=count($placeDispo)-1 ; $l++) 
					{ 
						if ($place[$k] == $placeDispo[$l]) 
						{
							$placeDispo[$l]=null;
							for($increment = $l ; $increment<count($placeDispo)-1 ; $increment++) 
							{ 
								$placeDispo[$increment] = $placeDispo[$increment+1];
							}
							
						}
					}
				}


				for($k=0;$k<$j;$k++)
				{
					echo $placeDispo[$k]."</br>";
				}
			?>
		</center>
		</p>
	</div>
</div>

<?php include("includes/pages/footer.php"); ?>
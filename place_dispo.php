<?php 
$titre = "places disponibles";
include("includes/pages/header.php");
					if (isset($_POST['reserver'])) 
					{
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
							$j++;
						}

//----------------------------------------------------------------
//MAGNIPULATION DES TABLEAUX POUR RESORTIR LES PLACES DISPONIBLES |
//----------------------------------------------------------------

						if(empty($place))
						{
						
						}
						else
						{
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
						}

						for($k=0;$k<$j;$k++)
						{
							echo $placeDispo[$k]."</br>";
						}
					}

?>

<div class="row">
	<div class="col-md-12 black">
		<p><center>PLACES DISPONNIBLES</center></p>
	</div>		


 
<div class="col-md-12 black">
	<p>
	<center>
		<form method="POST">
			DATE DE DEBUT : </br></br>
			<label style="color : #0beee8;">Jour</label><select name="jour_deb" required="" style="color : black;">
   		 <?php
      		for ($i=1;$i<=31;$i++) {
   		 ?>
    	<option>
        	<?php
          		echo $i;
       		 ?>  
    	</option>
   		<?php
      		}
   		?>
    	</select>
    	<label style="color : #0beee8;">Mois</label><select name="mois_deb" required="" style="color : black;">
    	<?php
      		for ($i=1;$i<=12;$i++) {
   		?>
    	<option>
        <?php
          	echo $i;
        ?>    
    	</option>
    	<?php
      		}
    	?>
    	</select>
    	<label style="color : #0beee8;">Année</label><select name="annee_deb" required="" style="color : black;">
    	<?php
      		for ($i=Date("Y");$i<=Date("Y")+3;$i++) {
    	?>
    	<option>
        	<?php
         		echo $i;
        	?>    
    	</option>
    	<?php
      		}
    	?>
    	</select></br>


    	DATE DE FIN : </br></br>
			<label style="color : #0beee8;">Jour</label><select name="jour_fin" required="" style="color : black;">
   		 <?php
      		for ($i=1;$i<=31;$i++) {
   		 ?>
    	<option>
        	<?php
          		echo $i;
       		 ?>  
    	</option>
   		<?php
      		}
   		?>
    	</select>
    	<label style="color : #0beee8;">Mois</label><select name="mois_fin" required="" style="color : black;">
    	<?php
      		for ($i=1;$i<=12;$i++) {
   		?>
    	<option>
        <?php
          	echo $i;
        ?>    
    	</option>
    	<?php
      		}
    	?>
    	</select>
    	<label style="color : #0beee8;">Année</label><select name="annee_fin" required="" style="color : black;">
    	<?php
      		for ($i=Date("Y");$i<=Date("Y")+3;$i++) {
    	?>
    	<option>
        	<?php
         		echo $i;
        	?>    
    	</option>
    	<?php
      		}
    	?>
    	</select></br>
    	<input type="submit" name="reserver" class="btn btn-info">
    	</form>  
	</center>
	</p>
</div>
</div>
<?php include("includes/pages/footer.php"); ?>
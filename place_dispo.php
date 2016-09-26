<?php 
$titre = "places disponibles";
include("includes/pages/header.php");
?>

		<div class="row">
			<div class="col-md-12 black">
				<p>PLACES DISPONNIBLES</p>
				<?php
					$checkPlaces = $bdd->query("SELECT id_place,civilite_membre,nom_membre,prenom_membre FROM MEMBRE,RESERVER,WHERE 'RESERVER.id_membre' = 'MEMBRES.id_membre'");
					while ($donnees = $checkPlaces->fetch()) 
					{
						?>
						<td name="Num. place">
							<tr>
								<?php echo $donnees['id_membre'] ?>
							</tr>
						</td>
						<?php	
					}
				?>
			</div>
		</div>

<?php include("includes/pages/footer.php"); ?>
<?php 
$titre = "Historique";
include("includes/pages/header.php");
?>


<div class="row">
	<div class="col-md-12 black">
		<p><center>HISTORIQUE</center></p>
	</div>
	<div class="col-md-12 black">
	<p>
	<center>
		<?php
			$aujourdhui = date("y-m-d");
			$tsajd = strtotime($aujourdhui);
			$historique = $bdd->prepare("SELECT RESERVER.id_membre,RESERVER.id_place,num_place,date_debut_periode,date_fin_periode FROM MEMBRE, PLACE, RESERVER WHERE MEMBRE.id_membre = RESERVER.id_membre AND PLACE.id_place=RESERVER.id_place AND RESERVER.id_membre=? ORDER BY date_fin_periode DESC");
			$historique->execute(array($user['id_membre']));
			?>
			<table class="table table-bordered">
				<tr>
					<th>NUMERO DE PLACE</th>
					<th>DATE D'ATTRIBUTION</th>
					<th>DATE D'EXPIRATION</th>
					<th>Etat Actuel</th>
				</tr>
			<?php
			while ($donnee = $historique->fetch()) 
			{
				$debut = strtotime($donnee['date_debut_periode']);
				$fin = strtotime($donnee['date_fin_periode']);
				?>
					<tr>
						<td><?php echo $donnee['num_place'];?></td>
						<td><?php echo date("d/m/Y",$debut);?></td>
						<td><?php echo date("d/m/Y",$fin);?></td>
						<td><?php echo ($debut <= $tsajd && $fin >= $tsajd)?"<span style='color:green;'>Actuelle</span>":"<span style='color:red;'>Expirée</span>";?></td>
					</tr>
				
				<?php
			}
				?>
			</table>
	</center>
	</p>
	</div>
</div>
<?php include("includes/pages/footer.php");?>
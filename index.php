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
	<div class="col-md-12 black">
	<p>
	<center>
		<?php
			$aujourdhui = date("Y-m-d");
			$tsajd = strtotime($aujourdhui);
			$historique = $bdd->prepare("SELECT RESERVER.id_membre,RESERVER.id_place,num_place,date_debut_periode,date_fin_periode FROM MEMBRE, PLACE, RESERVER WHERE MEMBRE.id_membre = RESERVER.id_membre AND PLACE.id_place=RESERVER.id_place AND RESERVER.id_membre=? AND RESERVER.date_debut_periode <= ? ORDER BY date_fin_periode DESC LIMIT 0,2");
			$historique->execute(array($user['id_membre'],$aujourdhui));
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

<?php include("includes/pages/footer.php"); ?>
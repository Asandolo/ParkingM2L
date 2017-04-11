<?php
$titre = "Historique admin";
include('includes/pages/header.php');
if ($user["admin_membre"]!=1) {
	header('Location: index.php');
}

?>
<div class="row">
	<div class="col-md-12 black">
		<?php
		$aujourdhui = date("Y-m-d");
		$tsajd = strtotime($aujourdhui);
		if (isset($_GET["user"]) || !empty($_GET["user"])) {
			
			$histusers = $bdd->prepare("SELECT * FROM `reserver` AS `r`, `membre` as `m`, `place` As `p` WHERE `r`.`id_membre` = `m`.`id_membre` AND `p`.`id_place` = `r`.`id_place` AND `r`.`id_membre` = ? AND `r`.`date_debut_periode` <= ? ORDER BY `r`.`date_fin_periode` DESC;");
			$histusers->execute(array($_GET["user"],$aujourdhui));
			$hucount=$histusers->rowCount();
			?>	
			<h3 id="thistuser"></h3>

			<table class="table table-bordered">
				<tr>
					<th>NUMERO DE PLACE</th>
					<th>DATE D'ATTRIBUTION</th>
					<th>DATE D'EXPIRATION</th>
					<th>Etat Actuel</th>
				</tr>
				<?php

				if ($hucount == 0) {
					?>
					<tr>
						<td colspan="4">Aucun historique pour ce membre</td>
					</tr>
					<?php
				}
				$username = "";
				while ($histuser=$histusers->fetch()) 
				{
					$username = strtoupper($histuser["nom_membre"])." ".$histuser["prenom_membre"];
					$debut = strtotime($histuser['date_debut_periode']);
					$fin = strtotime($histuser['date_fin_periode']);
					?>
					<tr>
						<td><?php echo $histuser['num_place'];?></td>
						<td><?php echo date("d/m/Y",$debut);?></td>
						<td><?php echo date("d/m/Y",$fin);?></td>
						<td><?php echo ($debut <= $tsajd && $fin >= $tsajd)?"<span style='color:green;'>Actuelle</span>":"<span style='color:red;'>Expirée</span>";?></td>
					</tr>
					<?php
				}
				?>
			</table>
			<script type="text/javascript">
				$("#thistuser").text("Place de <?php echo $username; ?>");
			</script>
			<?php
			//$histusers->closeCursor();
		}elseif(isset($_GET["place"]) || !empty($_GET["place"])){
			$histplaces = $bdd->prepare("SELECT * FROM `reserver` AS `r`, `membre` as `m`, `place` As `p` WHERE `r`.`id_membre` = `m`.`id_membre` AND `p`.`id_place` = `r`.`id_place` AND `r`.`id_place` = ?;");
			$histplaces->execute(array($_GET["place"]));
			$hpcount=$histplaces->rowCount();
			//$histpl->closeCursor();
			?>
			<h3 id="thistplace"></h3>

			<table class="table table-bordered">
				<tr>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Date d'atribution</th>
					<th>Date d'expiration</th>
					<th>Etat Actuel</th>
				</tr>
				<?php 
				$place = "";
				while ($histplace=$histplaces->fetch()) {
					$place = $histplace["num_place"];
					$debut = strtotime($histplace['date_debut_periode']);
					$fin = strtotime($histplace['date_fin_periode']);
					?>
					<tr>
						<td><?php echo strtoupper($histplace["nom_membre"]); ?></td>
						<td><?php echo $histplace["prenom_membre"]; ?></td>
						<td><?php echo date("d/m/Y",$debut);?></td>
						<td><?php echo date("d/m/Y",$fin);?></td>
						<td><?php echo ($debut <= $tsajd && $fin >= $tsajd)?"<span style='color:green;'>Actuelle</span>":"<span style='color:red;'>Expirée</span>";?></td>
					</tr>
					<?php
				}


				?>
			</table>
			<script type="text/javascript">
				$("#thistplace").text("Historique de la place : <?php echo $place; ?>");
			</script>
			<?php
		}else{
			header('Locoation: index.php');
		}
		?>

	</div>
</div>


<?php
include('includes/pages/footer.php');
?>
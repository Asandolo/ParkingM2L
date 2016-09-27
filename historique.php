<?php 
$titre = "Historique";
include("includes/pages/header.php");
?>


<div class="row">
	<div class="col-md-12 black">
		<p><center>HISTORIQUE</center></p>
		<?php
			$historique = $bdd->prepare("SELECT id_membre,id_place,num_place,date_debut_periode,date_fin_periode FROM MEMBRE, PLACE, RESERVER INNER JOIN id_membre ON MEMBRE.id_membre = RESERVER.id_membre, INNER JOIN id_place ON PLACE.id_place=RESERVER.id_place WHERE id_membre=? ORDER BY date_fin_periode");
			$historique->execute(array($user['id_membre']));
			while ($donnee = $historique->fetch()) 
			{
				echo $donnee['num_place'];
				echo $donnee['id_membre'];
				echo $donnee['date_debut_periode'];
				echo $donnee['date_fin_periode'];
			}
		?>
	</div>
</div>
<?php include("includes/pages/footer.php");?>
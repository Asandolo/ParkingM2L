<?php 
$titre = "Acceuil";
include("includes/pages/header.php");



?>

<div class="row">

	<div class="col-md-12 black">
		<center>
			<?php
			$ajd = date("Y-m-d");
			$tsajd = strtotime($ajd);   


			$places = $bdd->prepare("SELECT* FROM place,reserver WHERE place.id_place = reserver.id_place AND id_membre= ? AND date_fin_periode>?");
			$places->execute(array($user["id_membre"],$ajd));
			$place = $places->fetch();


			$count = $places->rowCount();

			if ($count<=0 && $user["rang"]<=0) {
				echo "<p style='font-size:20px'>Vous n'avez aucune place et n'etes pas dans la file d'atente</p>";
				echo "<form><a class='btn btn-danger' value='Reserver une place' href='place_dispo.php' />Reserver une place</a></form>";
			}elseif($user["rang"]<=0){
				if(($place['date_debut_periode']<=$ajd) && ($place['date_fin_periode']>=$ajd))
				{
					echo "<p style='font-size:20px'>Vous avez la place : <br /><strong>".$place["num_place"]."</strong></p>";
				}
				elseif($ajd<=$place['date_fin_periode']) 
				{
					$deb_resa_fr=date("d/m/Y", strtotime($place['date_debut_periode'])) ;
					$fin_resa_fr=date("d/m/Y", strtotime($place['date_fin_periode'])) ;
					echo "<h2>Vous avez la place : "."<br />".$place["num_place"]."</br> du ".$deb_resa_fr." au ".$fin_resa_fr."</h2>" ;
				}
			}else{
				echo "<p style='font-size:20px'>Vous avez le rang : <br /><strong>".$user["rang"]."</strong></p>";
				echo "<form><a class='btn btn-danger' value='Reserver une place' href='place_dispo.php' />Reserver une place</a></form>";
			}


			?>
		</center>
	</div>
	<div class="col-md-12 black">
		<p>
			<center>
				<h2>Historique</h2>
				<?php
				$aujourdhui = date("Y-m-d");
				$tsajd = strtotime($aujourdhui);
				$historique = $bdd->prepare("SELECT reserver.id_membre,reserver.id_place,num_place,date_debut_periode,date_fin_periode FROM membre, place, reserver WHERE membre.id_membre = reserver.id_membre AND place.id_place=reserver.id_place AND reserver.id_membre=? AND reserver.date_debut_periode <= ? ORDER BY date_fin_periode DESC LIMIT 0,2");
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
		<a href="historique.php"><button class="btn btn-info">Voir tout l'historique</button></a>
	</div>
</div>

<?php include("includes/pages/footer.php"); ?>
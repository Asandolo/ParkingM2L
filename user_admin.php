<?php
$titre = "Utilisateurs Admin";
include("includes/pages/header.php");
if ($user["admin_membre"]!=1) {
	header('Location: index.php');
}

if (isset($_POST["degrade"])) {
	
	$deladm = $bdd->prepare("UPDATE `membre` SET `admin_membre` = 0 WHERE `id_membre` = ?");
	$deladm->execute(array($_POST["id"]));
}

if (isset($_POST["admin"])) {
	
	$deladm = $bdd->prepare("UPDATE `membre` SET `admin_membre` = 1 WHERE `id_membre` = ?");
	$deladm->execute(array($_POST["id"]));
}

if (isset($_POST["deac"])) {
	
	$deladm = $bdd->prepare("UPDATE `membre` SET `valide_membre` = 0 WHERE `id_membre` = ?");
	$deladm->execute(array($_POST["id"]));
}

if (isset($_POST["activate"])) {
	
	$deladm = $bdd->prepare("UPDATE `membre` SET `valide_membre` = 1 WHERE `id_membre` = ?");
	$deladm->execute(array($_POST["id"]));
}

if (isset($_POST["sup"]) || isset($_POST["refu"])) {
	
	$deladm = $bdd->prepare("DELETE FROM `membre` WHERE `id_membre` = ?");
	$deladm->execute(array($_POST["id"]));
}
?>
<div class="row">
	<div class="col-md-12 black" style="overflow: auto;">
		<center>
			<h2>Gestion des membres</h2>
			<h3>Administrateurs</h3>
			<table class="table table-bordered">
				<tr>
					<th>#</th>
					<th>Civilite</th>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Place/rang</th>
					<th>Actions</th>
				</tr>
				<?php

				$admins = $bdd->query("SELECT * FROM `membre` WHERE `admin_membre` = 1;");
				$cadmins=$admins->rowCount();

				if ($cadmins == 0) {
					?>
					<td colspan="12">Il n'y as pas de membre dans cette section</td>
					<?php
				}else{


					while ($admin=$admins->fetch()) {
						$ajd = date("Y-m-d"); 
						$tsajd = strtotime($ajd);
						$placesadmin = $bdd->prepare("SELECT * FROM `reserver`, `place` WHERE `id_membre` = ? AND date_debut_periode <= ? AND date_fin_periode >= ? AND `reserver`.`id_place` = `place`.`id_place`");
						$placesadmin->execute(array($admin["id_membre"],$ajd,$ajd));
						$placeadmin = $placesadmin->fetch();

						$countadmin = $placesadmin->rowCount();

						?>
						<tr>
							<td><?php echo $admin["id_membre"]; ?></td>
							<td><?php echo $admin["civilite_membre"]; ?></td>
							<td><?php echo $admin["nom_membre"]; ?></td>
							<td><?php echo $admin["prenom_membre"]; ?></td>
							<td><?php

								if ($countadmin<=0 && $admin["rang"]<=0) {
									echo "/";
								}elseif($admin["rang"]<=0){
									echo "Place :".$placeadmin["num_place"];
								}else{
									echo "Rang : ".$admin["rang"];
								}

								?></td>
								<td>
									<form method="POST">
										<input type="hidden" name="id" value="<?php echo $admin["id_membre"]; ?>">
										<input type="submit" value="Dégrader" class="btn btn-danger" name="degrade" <?php echo ($cadmins == 1 || $admin["id_membre"] == $user["id_membre"])?"disabled=''":"" ?>>
									</form>
									<a href="modif_admin.php?id=<?php echo $admin["id_membre"]; ?>"><button class="btn btn-success">Mofifier</button></a>
								</td>
							</tr>

							<?php
						}}

						?>
					</table>
				</center>
			</div>
			<div class="col-md-12 black" style="overflow: auto;">
				<center>

					<h3>Non vérifié</h3>
					<table class="table table-bordered">
						<tr>
							<th>#</th>
							<th>Civilite</th>
							<th>Nom</th>
							<th>Prenom</th>
							<th>Actions</th>
						</tr>
						<?php

						$nonverifs = $bdd->query("SELECT * FROM `membre` WHERE `valide_membre` = 0;");
						$cnonverifs=$nonverifs->rowCount();

						if ($cnonverifs == 0) {
							?>
							<td colspan="12">Il n'y as pas de membre dans cette section</td>
							<?php
						}else{


							while ($nonverif=$nonverifs->fetch()) {
								$ajd = date("Y-m-d"); 
								$tsajd = strtotime($ajd);
								$placesnonverif = $bdd->prepare("SELECT * FROM `reserver`, `place` WHERE `id_membre` = ? AND date_debut_periode <= ? AND date_fin_periode >= ? AND `reserver`.`id_place` = `place`.`id_place`");
								$placesnonverif->execute(array($nonverif["id_membre"],$ajd,$ajd));
								$placenonverif = $placesnonverif->fetch();

								$countnonverif = $placesnonverif->rowCount();
								?>
								<tr>
									<td><?php echo $nonverif["id_membre"]; ?></td>
									<td><?php echo $nonverif["civilite_membre"]; ?></td>
									<td><?php echo $nonverif["nom_membre"]; ?></td>
									<td><?php echo $nonverif["prenom_membre"]; ?></td>
									<td><?php echo date("d/m/Y", strtotime($nonverif["date_naiss_membre"])); ?></td>
									<td><?php echo $nonverif["adRue_membre"]; ?></td>
									<td><?php echo $nonverif["adCP_membre"]; ?></td>
									<td><?php echo $nonverif["adVille_membre"]; ?></td>
									<td><?php 


										if ($countnonverif<=0 && $nonverif["rang"]<=0) {
											echo "/";
										}elseif($nonverif["rang"]<=0){
											echo "Place :".$placenonverif["num_place"];
										}else{
											echo "Rang : ".$nonverif["rang"];
										}



										?></td>
										<td><?php echo ($nonverif["valide_membre"] == 1)?"<span style='color:green;'>Oui</span>":"<span style='color:red;'>Non</span>"; ?></td>
										<td><?php echo ($nonverif["admin_membre"] == 1)?"<span style='color:green;'>Oui</span>":"<span style='color:red;'>Non</span>"; ?></td>
										<td>
											<form method="POST">
												<input type="hidden" name="id" value="<?php echo $nonverif["id_membre"]; ?>">
												<input type="submit" name="activate" value="Activer" class="btn btn-success">
											</form>
											<form method="POST">
												<input type="hidden" name="id" value="<?php echo $nonverif["id_membre"]; ?>">
												<input type="submit" name="refu" value="Refuser" class="btn btn-danger">
											</form>
											<a href="modif_admin.php?id=<?php echo $nonverif["id_membre"]; ?>"><button class="btn btn-success">Mofifier</button></a>
										</td>
									</tr>

									<?php
								}}

								?>
							</table>
						</center>
					</div>
					<div class="col-md-12 black" style="overflow: auto;">
						<center>
							<h3>Vérifié</h3>
							<table class="table table-bordered">
								<tr>
									<th>#</th>
									<th>Civilite</th>
									<th>Nom</th>
									<th>Prenom</th>
									<th>Place/rang</th>
									<th>Admin</th>
									<th>Actions</th>
								</tr>
								<?php

								$verifs = $bdd->query("SELECT * FROM `membre` WHERE `valide_membre` = 1;");
								$cverifs=$verifs->rowCount();

								if ($cverifs == 0) {
									?>
									<td colspan="12">Il n'y as pas de membre dans cette section</td>
									<?php
								}else{


									while ($verif=$verifs->fetch()) {

										$histcount = $bdd->prepare("SELECT cOUNT(`id_membre`) As `hcount` FROM `reserver` WHERE `id_membre` = ?");
										$histcount->execute(array($verif["id_membre"]));
										$hc=$histcount->fetch();

										$ajd = date("Y-m-d"); 
										$tsajd = strtotime($ajd);
										$placesverif = $bdd->prepare("SELECT * FROM `reserver`, `place` WHERE `id_membre` = ? AND date_debut_periode <= ? AND date_fin_periode >= ? AND `reserver`.`id_place` = `place`.`id_place`");
										$placesverif->execute(array($verif["id_membre"],$ajd,$ajd));
										$placeverif = $placesverif->fetch();

										$countverif = $placesverif->rowCount();
										?>
										<tr>
											<td><?php echo $verif["id_membre"]; ?></td>
											<td><?php echo $verif["civilite_membre"]; ?></td>
											<td><?php echo $verif["nom_membre"]; ?></td>
											<td><?php echo $verif["prenom_membre"]; ?></td>
											<td><?php 

												if ($countverif<=0 && $verif["rang"]<=0) {
													echo "/";
												}elseif($verif["rang"]<=0){
													echo "Place :".$placeverif["num_place"];
												}else{
													echo "Rang : ".$verif["rang"];
												}


												?></td>
												<td><?php echo ($verif["admin_membre"] == 1)?"<span style='color:green;'>Oui</span>":"<span style='color:red;'>Non</span>"; ?></td>
												<td>
													<form method="POST">
														<input type="hidden" name="id" value="<?php echo $verif["id_membre"]; ?>">
														<input type="submit" name="deac" class="btn btn-warning" value="Déactiver" <?php echo ($verif["admin_membre"] == 1 || $admin["id_membre"] == $user["id_membre"])?"disabled=''":"" ?>>
													</form>
													<form method="POST">
														<input type="hidden" name="id" value="<?php echo $verif["id_membre"]; ?>">
														<input type="submit" name="admin" class="btn btn-info" value="Gradé admin" <?php echo ($verif["admin_membre"] == 1)?"disabled=''":"" ?>>
													</form>
													<form method="POST">
														<input type="hidden" name="id" value="<?php echo $verif["id_membre"]; ?>">
														<input type="submit" name="sup" class="btn btn-danger" value="Supprimé" <?php echo ($verif["admin_membre"] == 1)?"disabled=''":"" ?>>
													</form>
													<a href="modif_admin.php?id=<?php echo $verif["id_membre"]; ?>"><button class="btn btn-success">Mofifier</button></a>
													<a href="historique_admin.php?user=<?php echo $verif['id_membre']; ?>"><button class="btn btn-info" <?php echo($hc["hcount"]<1)?"disabled=''":""; ?>>Historique place</button></a>
												</td>
											</tr>

											<?php
										}}

										?>
									</table>
								</center>
							</div>
						</div>
						<?php
						include("includes/pages/footer.php");

						?>
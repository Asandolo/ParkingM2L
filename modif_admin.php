<?php 
$titre = "Modification profil";
include("includes/pages/header.php");

$select = $bdd->prepare("SELECT * FROM `membre` WHERE `id_membre` = ?");
$select->execute(array($_GET["id"]));
$data=$select->fetch();
$count=$select->rowCount();

if (isset($_POST["updateprofil"])) {
	
	$date_naiss = htmlspecialchars($_POST["annee"])."-".htmlspecialchars($_POST["mois"])."-".htmlspecialchars($_POST["jour"]);

	$civilite = htmlspecialchars($_POST["civilite"]);
	$nom = htmlspecialchars($_POST["nom"]);
	$prenom = htmlspecialchars($_POST["prenom"]);
	$mail = htmlspecialchars($_POST["mail"]);
	$rue = htmlspecialchars($_POST["rue"]);
	$cp = htmlspecialchars($_POST["cp"]);
	$ville = htmlspecialchars($_POST["ville"]);

	$update = $bdd->prepare("UPDATE membre SET civilite_membre = ?, nom_membre = ?, prenom_membre = ?, date_naiss_membre = ?, adRue_membre = ?, adCP_membre = ?, adVille_membre = ? WHERE id_membre =  ?");
	$update->execute(array($civilite,$nom,$prenom,$date_naiss,$rue,$cp,$ville,$_GET["id"]));

	header('location: modif_admin.php?id='.$data['id_membre']);



}




?>
<div class="row">
	<div class="col-md-12 black">
		<h2>Modification du profil de <?php echo strtoupper($data["nom_membre"])." ".$data["prenom_membre"]; ?></h2>

		<form method="POST">
			<table class="table table-bordered">
				<tr>
					<th>Civilite</th>
					<td><select name="civilite" style="color: black;">
						<option <?php echo ($data["civilite_membre"]=="mr." || $data["civilite_membre"]=="Mr.")?"selected=''":""; ?>>
							Mr.
						</option>
						<option style="color: black;" <?php echo ($data["civilite_membre"]=="Mme.")?"selected=''":""; ?>>
							Mme.
						</option>
					</select></td>
				</tr>
				<tr>
					<th>Nom</th>
					<td><input style="color: black;" type="text" name="nom" value="<?php echo $data["nom_membre"]; ?>" required="" ></td>
				</tr>					
				<tr>
					<th>Prenom</th>
					<td><input style="color: black;" type="text" name="prenom" value="<?php echo $data["prenom_membre"]; ?>" required="" ></td>
				</tr>
				<tr>
					<th>Mail</th>
					<td><input style="color: black;" type="mail" name="mail" value="<?php echo $data["mail_membre"]; ?>" required="" ></td>
				</tr>
				<tr>
					<th>Adresse</th>
					<td><input style="color: black;" type="text" name="rue" value="<?php echo $data["adRue_membre"]; ?>" required="" ></td>
				</tr>
				<tr>
					<th>Code Postal</th>
					<td><input style="color: black;" type="text" name="cp" value="<?php echo $data["adCP_membre"]; ?>" required="" ></td>
				</tr>
				<tr>
					<th>Ville</th>
					<td><input style="color: black;" type="text" name="ville" value="<?php echo $data["adVille_membre"]; ?>" required="" ></td>
				</tr>
				<?php

				$datenaiss = explode("-", $data["date_naiss_membre"]);

				?>
				<tr>
					<th>Date de naissance</th>
					<td><select style="color: black;" name="jour">
						<?php
						for ($i=1;$i<=31;$i++) {
							?>
							<option <?php echo ($datenaiss[2]==$i)?"selected=''":""; ?>>
								<?php
								echo $i;
								?>    
							</option>
							<?php
						}
						?>
					</select>
					<select style="color: black;" name="mois">
						<?php
						for ($i=1;$i<=31;$i++) {
							?>
							<option <?php echo ($datenaiss[1]==$i)?"selected=''":""; ?>>
								<?php
								echo $i;
								?>    
							</option>
							<?php
						}
						?>
					</select>
					<select style="color: black;" name="annee">
						<?php
						for ($i=Date("Y");$i>=1920;$i--) {
							?>
							<option <?php echo ($datenaiss[0]==$i)?"selected=''":""; ?>>
								<?php
								echo $i;
								?>    
							</option>
							<?php
						}
						?>
					</select></td>
				</tr>
			</table>
			<input type="submit" name="updateprofil" class="btn btn-success">
		</form>
	</div>
</div>

<?php include("includes/pages/footer.php"); ?>
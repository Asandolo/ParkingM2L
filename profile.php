<?php 
$titre = "Profile";
include("includes/pages/header.php");

if (isset($_POST["repsw"])) {
	
	$oldpsw = htmlspecialchars($_POST["oldpsw"]);
	$newpsw = htmlspecialchars($_POST["newpsw"]);
	$cknewpsw = htmlspecialchars($_POST["cknewpsw"]);

	$verif =$bdd->prepare("SELECT psw_membre FROM MEMBRE WHERE mail_membre = ?");
	$verif->execute(array($user["mail_membre"]));
	$v=$verif->fetch();

	$oldpsw = hashMdp($oldpsw);


	if ($oldpsw == $v["psw_membre"]) {
		if ($newpsw==$cknewpsw) {
			
			$newpsw = hashMdp($newpsw);

			$updatepsw = $bdd->prepare("UPDATE MEMBRE SET psw_membre = ?");
			$updatepsw->execute(array($newpsw));

		}else{
			$error = "Les mots de pass sont différent";
		}
	}else{
		$error = "Ancien mot de passe faux";
	}

}

?>
<script type="text/javascript" src="js/edit.js"></script>
		<div class="row">
			<div class="col-md-12 black">
				<h2>Votre profil</h2>


				<table class="table table-bordered">
					<tr>
						<th>Civilite</th>
						<td rel='{"name":"civilite_membre","type":"select","id":<?php echo $user['id_membre']; ?>}'><?php echo $user["civilite_membre"]; ?></td>
					</tr>
					<tr>
						<th>Nom</th>
						<td rel='{"name":"nom_membre","type":"input","id":<?php echo $user['id_membre']; ?>}'><?php echo $user["nom_membre"]; ?></td>
					</tr>					
					<tr>
						<th>Prenom</th>
						<td rel='{"name":"prenom_membre","type":"input","id":<?php echo $user['id_membre']; ?>}'><?php echo $user["prenom_membre"]; ?></td>
					</tr>
					<tr>
						<th>Mail</th>
						<td rel='{"name":"mail_membre","type":"input","id":<?php echo $user['id_membre']; ?>}'><?php echo $user["mail_membre"]; ?></td>
					</tr>
					<tr>
						<th>Adresse</th>
						<td rel='{"name":"adRue_membre","type":"input","id":<?php echo $user['id_membre']; ?>}'><?php echo $user["adRue_membre"]; ?></td>
					</tr>
					<tr>
						<th>Code Postal</th>
						<td rel='{"name":"adCP_membre","type":"input","id":<?php echo $user['id_membre']; ?>}'><?php echo $user["adCP_membre"]; ?></td>
					</tr>
					<tr>
						<th>Ville</th>
						<td rel='{"name":"adVille_membre","type":"input","id":<?php echo $user['id_membre']; ?>}'><?php echo $user["adVille_membre"]; ?></td>
					</tr>
				</table>

				<hr />
				<h3>Modification du mot de passe</h3>

				<form method="POST">
					<div class="form-group">
						<input class="form-control" type="password" name="oldpsw" placeholder="Ancien mot de pass" required=""><br />
						<input class="form-control" type="password" name="newpsw" placeholder="Nouveau mot de pass" required=""><br />
						<input class="form-control" type="password" name="cknewpsw" placeholder="Valider le nouveau mot de passe"  required=""><br />
					</div>
					<input type="submit" name="repsw" value="Changer le mot de passe" class="btn btn-success form-control">
				</form>
			</div>
		</div>

<?php include("includes/pages/footer.php"); ?>
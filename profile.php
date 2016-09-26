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

		<div class="row">
			<div class="col-md-12 black">
				<h2>Votre profil</h2>

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
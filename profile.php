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
<script type="text/javascript">
	 $(document).ready(function() {
     $('.edit').editable('ajax.php', {
         indicator : 'Saving...',
         tooltip   : 'Click to edit...',
         submit    : 'ok'
     });
 });
</script>
		<div class="row">
			<div class="col-md-12 black">
				<h2>Votre profil</h2>


				<table class="table table-bordered">
					<tr>
						<th>Nom</th>
						<td class="edit" id="<?php echo $user['id_membre'].'/'."nom_membre" ?>"><?php echo $user["nom_membre"]; ?></td>
					</tr>					
					<tr>
						<th>Prenom</th>
						<td class="edit" id="<?php echo $user['id_membre'].'/'."prenom_membre" ?>"><?php echo $user["prenom_membre"]; ?></td>
					</tr>
					<tr>
						<th>Mail</th>
						<td class="edit" id="<?php echo $user['id_membre'].'/'."mail_membre" ?>"><?php echo $user["mail_membre"]; ?></td>
					</tr>
					<tr>
						<th>Adresse</th>
						<td class="edit" id="<?php echo $user['id_membre'].'/'."adRue_membre" ?>"><?php echo $user["adRue_membre"]; ?></td>
					</tr>
					<tr>
						<th>Code Postal</th>
						<td class="edit" id="<?php echo $user['id_membre'].'/'."adCP_membre" ?>"><?php echo $user["adCP_membre"]; ?></td>
					</tr>
					<tr>
						<th>Ville</th>
						<td class="edit" id="<?php echo $user['id_membre'].'/'."adVille_membre" ?>"><?php echo $user["adVille_membre"]; ?></td>
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
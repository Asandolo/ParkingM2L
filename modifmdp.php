<?php
$titre = "Modif Mot de passe";
include("includes/pages/header.php");

if (!isset($_GET["id"]) || empty($_GET["id"])) {
	header('Location: index.php');	
}else{

	$newpass = stringRand(10);

	$hnewwpass = hashMdp($newpass);

	$update = $bdd->prepare("UPDATE `membre` SET `psw_membre` = ? WHERE `id_membre` = ?");
	$update->execute(array($hnewwpass,$_GET["id"]));
}

?>
<div class="row">
	<div class="col-md-12 black">
		<p>On supose l'envois du mail suivant à l'utilisateur :</p>
		<br />
		<br />
		<p>suite a votre demande votre mot de passe a été regénéré<br />
			votre noiuveau mot de passe est : <?php echo $newpass ?> <br />
			Merci de le changer au plus vite</p>
			<br />
			<a href="index.php">retour</a>
		</div>
	</div>
	<?php
	include("includes/pages/footer.php");
	?>
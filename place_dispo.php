<?php 
$titre = "places disponibles";
include("includes/pages/header.php");
?>

		<div class="row">
			<div class="col-md-12 black">
				<p>PLACES DISPONNIBLES</p>
				<?php
					$aujourdhui = date("y-m-d");
					$CheckPlace = $bdd->prepare("SELECT * FROM RESERVER WHERE ?")

				?>
			</div>
		</div>

<?php include("includes/pages/footer.php"); ?>
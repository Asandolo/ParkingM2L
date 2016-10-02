<?php
$titre = "Places";
include("includes/pages/header.php");
if ($user["admin_membre"]!=1) {
	header('Location: index.php');
}

if (isset($_POST["desac"])) {

	$desac = $bdd->prepare("UPDATE `place` SET `active_place` = 0 WHERE `id_place` = ?");
	$desac->execute(array($_POST["id"]));
}


if (isset($_POST["ac"])) {
	$ac = $bdd->prepare("UPDATE `place` SET `active_place` = 1 WHERE `id_place` = ?");
	$ac->execute(array($_POST["id"]));
}
?>
	<div class="row">
		<div class="col-md-12 black">
			<?php

			$nbplaceparpage = 10;

			$cplace = $bdd->query("SELECT COUNT(*) as `total` FROM `place`");
			$count=$cplace->fetch();

			$totalpage=ceil($count["total"]/$nbplaceparpage);

			if (!isset($_GET["p"])) {
				header('Location: place_admin.php?p=1');
			}elseif ($_GET["p"]<1) {
				$pagea = 1;
			}else{
				$pagea = $_GET["p"];
			}
			$prems = ($pagea-1)*$nbplaceparpage;

			$splace=$bdd->query("SELECT * FROM `place` ORDER BY `num_place` LIMIT ".$prems.",".$nbplaceparpage."");
			?>

			<ul class="pagination">
			<?php
				for ($i=1; $i <=$totalpage ; $i++) { 
								?>
			  <li <?php echo ($_GET["p"]==$i)?"class='active'":""; ?>><a href="?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			  <?php } ?>
			</ul>
			<table class="table table-bordered">
				<tr>
					<th>#</th><th>Numero</th><th>Actions</th>
				</tr>
					<?php
					while ($place=$splace->fetch()) {
					?>
				<tr>
					<td><?php echo $place["id_place"]; ?></td><td><?php echo $place["num_place"]; ?></td><td>
						<form method="POST">
							<input type='hidden' name='id' value='<?php echo $place['id_place']; ?>'>
							<?php echo ($place["active_place"]==1)?"<input type='submit' name='desac' value='Desactiver' class='btn btn-warning'>":"<input type='submit' name='ac' value='Activer' class='btn btn-success'>";?>
						</form>
					</td>
				</tr>
					<?php
					}
					?>
			</table>

			<ul class="pagination">
			<?php
				for ($i=1; $i <=$totalpage ; $i++) { 
								?>
			  <li <?php echo ($pagea==$i)?"class='active'":""; ?>><a href="?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			  <?php } ?>
			</ul>
		</div>	
	</div>
<?php

include("includes/pages/footer.php");


?>
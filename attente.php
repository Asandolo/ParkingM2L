<?php 
$titre = "Gestion rang";
include('includes/pages/header.php'); 

if (isset($_POST["plus"])) {

	$sm = $bdd->query("SELECT MAX(`rang`) as `max` FROM `membre`");
	$dm=$sm->fetch();

	if ($_POST["r"] == $dm["max"]) {
		echo "Deja au rang max";
	}else {
	
	$sp = $bdd->prepare("SELECT * FROM `membre` WHERE `rang` = ?");
	$sp->execute(array($_POST["r"]+1));
	$dsp=$sp->fetch();

	$r1=$bdd->prepare("UPDATE `membre` SET `rang` = ? WHERE `id_membre` = ?");
	$r1->execute(array($_POST["r"]+1,$_POST["id"]));

	$r2=$bdd->prepare("UPDATE `membre` SET `rang` = ? WHERE `id_membre` = ?");
	$r2->execute(array($dsp["rang"]-1,$dsp["id_membre"]));
}
}

if (isset($_POST["moins"])) {

	if ($_POST["r"] == 1) {

		echo "la fonctione ne marche pas";

// 	$select = $bdd->prepare("SELECT * FROM `membre` WHERE `id_membre`= ?");
// 	$select->execute(array($_POST["id"]));
// 	$data=$select->fetch();

// $aujourdhui = date("Y-m-d");
// $checkHavePlace = $bdd->prepare("SELECT* FROM PLACE,RESERVER WHERE PLACE.id_place = RESERVER.id_place AND id_membre= ? AND date_fin_periode>?");
// $checkHavePlace->execute(array($data['id_membre'],$aujourdhui));
// $countHavePlace = $checkHavePlace->rowcount();

// $havePlace=0;
// if($countHavePlace>0)
// {
//   while ($donneCheckHavePlace = $checkHavePlace->fetch()) 
//   {
//   	$havePlace=1;
//   	$placeUser = $donneCheckHavePlace['num_place'];
//     if(($donneCheckHavePlace['date_debut_periode']<=$aujourdhui) && ($donneCheckHavePlace['date_fin_periode']>=$aujourdhui))
//     {   
//       ?>
<!-- //             <p><center><h2><?php //echo "Il a deja la place  ".$placeUser; ?></h2></center></p> -->
//       <?php
//     }
//     elseif($aujourdhui<=$donneCheckHavePlace['date_fin_periode'])
//    	{
//    		$dateDebutResa=date("d/m/Y", strtotime($donneCheckHavePlace['date_debut_periode']));
//       	?>
<!-- //             <p><center><h2><?php// echo "Il a la place ".$placeUser." à partir du ".$dateDebutResa; ?></h2></center></p> -->
//       	<?php
//    	}
//   }  
// }

// if ($user['rang']>0) 
// {
//   ?>
<!-- //     <p><center><h2><?php // echo "Il a le rang le rang numéro ".$data['rang']; ?></h2></center></p> -->
//   <?php
// }

// if ($havePlace == 0) 
// {
//   $now   = new DateTime;
//   $clone = clone $now;    
//   $clone->modify( '+1 week' );

//   $debut_resa = $now->format("Y-m-d");
//   $fin_resa = $clone->format("Y-m-d");



//   if($debut_resa>$fin_resa || $debut_resa<$aujourdhui)
// 		{
// 			echo "La date de début doits être avant la date de fin et doit se situer après la date d'aujourdhui"; 
// 		}
// 		else
// 		{
// //----------------------------------
// //SELECTION DES PLACES DEJA RESERVE |
// //----------------------------------	

//       		echo"yolo"; 
//       		$CheckPlace = $bdd->prepare("SELECT num_place,date_debut_periode,date_fin_periode FROM PLACE,RESERVER WHERE PLACE.id_place = RESERVER.id_place");
//       		$CheckPlace->execute(array($fin_resa,$fin_resa,$debut_resa,$debut_resa,$debut_resa,$fin_resa));
//       		$i = 0;
//       		while($donnee = $CheckPlace->fetch())
//       		{
//       		  $place[$i]=null;
//       		  if (($donnee['date_debut_periode']<=$fin_resa && $donnee['date_fin_periode']>=$fin_resa)&&($donnee['date_debut_periode']<=$debut_resa && $donnee['date_fin_periode']>=$debut_resa)) 
//       		  {
//       		    $place[$i]=$donnee['num_place'];
//       		  }
//       		  elseif ($donnee['date_debut_periode']<=$fin_resa && $donnee['date_fin_periode'] >= $fin_resa) 
//       		  {
//       		    $place[$i]=$donnee['num_place'];
//       		  }
//       		  elseif ($donnee['date_debut_periode']<=$debut_resa && $donnee['date_fin_periode'] >= $debut_resa) 
//       		  {
//       		    $place[$i]=$donnee['num_place'];
//       		  }
//       		  elseif ($donnee['date_debut_periode']>=$debut_resa && $donnee['date_fin_periode'] <= $fin_resa) 
//       		  {
//       		    $place[$i]=$donnee['num_place'];
//       		  }
//       		  $i++;
//       		}
// //--------------------------------------------
// // SELECTION DE TOUTES LES PALCES DE PARKING |
// //--------------------------------------------
      		
//       		$tsajd = strtotime($aujourdhui);
		
//       		$places = $bdd->prepare("SELECT num_place FROM PLACE");
//       		$places->execute();
//       		$j=0;
//       		while ($donneePlaceDisp = $places->fetch()) 
//       		{
//       		  $placeDispo[$j]=$donneePlaceDisp['num_place'];
//       		  $j++;
//       		}

// //----------------------------------------------------------------
// //MAGNIPULATION DES TABLEAUX POUR RESORTIR LES PLACES DISPONIBLES |
// //----------------------------------------------------------------
//       		if(empty($place))
//       		{
//       		  $checkPeriode = $bdd->prepare("SELECT* FROM PERIODE");
//       		  $checkPeriode ->execute();
//       		  $isPeriode= 0;
//       		  while ($donneeCheckPer = $checkPeriode->fetch()) 
//       		  {
//       		    if($donneeCheckPer['date_debut_periode'] == $debut_resa)
//       		    {
//       		      $isPeriode=1;
//       		    }
//       		  }
//       		  if($isPeriode!=1)
//       		  {
//       		    $insertPer = $bdd->prepare("INSERT INTO PERIODE VALUES (?)");
//       		    $insertPer->execute(array($debut_resa));
//       		  }
//       		  $insertResa = $bdd->prepare("INSERT INTO RESERVER VALUES (?,?,?,?)");
//       		  $insertResa->execute(array($fin_resa,$data['id_membre'],$placeDispo[0],$debut_resa));
//       		}
//       		else
//       		{
//       			for ($k=0; $k <=count($place)-1 ; $k++) 
//       		  	{ 
//       		    	for ($l=0; $l <=count($placeDispo)-1 ; $l++) 
//       		    	{ 
//       		      		if ($place[$k] == $placeDispo[$l]) 
//       		      		{
//       		        	for($increment = $l ; $increment<count($placeDispo)-1 ; $increment++) 
//       		        	{ 
//       		           		$placeDispo[$increment] = $placeDispo[$increment+1];
//       		        	}	
//       		         	array_pop($placeDispo);
//       		      		}
//       		   		}
//       			}
//       		}
// //-----------------------------------------------------------
// // SI IL N'Y A PAS DE PLACE DISPONNIBLE ON MET DANS LE RANG  |
// //-----------------------------------------------------------
//       		if (empty($placeDispo)) 
//       		{
//       			$countRang=$bdd->prepare("SELECT rang FROM MEMBRE ORDER BY rang");
//       			$countRang->execute();
//       			$attribution=0;
//       			while ($donneeCRang = $countRang->fetch()) 
//       			{
//           			$attribution = $donneeCRang['rang']+1;
//       			}
//         		echo $attribution;
      		
//         		$attribRang = $bdd->prepare("UPDATE MEMBRE SET rang = ? WHERE id_membre= ?");
//         		$attribRang -> execute(array($attribution,$data['id_membre']));
//       		}
//       		else
//       		{
//       		  	$checkPeriode = $bdd->prepare("SELECT* FROM PERIODE");
//       		  	$checkPeriode ->execute();
//       		  	$isPeriode= 0;
//       		  	while ($donneeCheckPer = $checkPeriode->fetch()) 
//       		  	{
//       		  	  	if($donneeCheckPer['date_debut_periode'] == $debut_resa)
//       		  	  	{
//       		  	    	$isPeriode=1;
//       		  	  	}
//       		  	}
//       		  	if($isPeriode!=1)
//       		  	{
//       		  	  $insertPer = $bdd->prepare("INSERT INTO PERIODE VALUES (?)");
//       		  	  $insertPer->execute(array($debut_resa));
//       		  	}
//       		  	$insertResa = $bdd->prepare("INSERT INTO RESERVER VALUES (?,?,?,?)");
//       		  	$insertResa->execute(array($fin_resa,$data['id_membre'],$placeDispo[0],$debut_resa));
//       		}
// 		}

// 		$zero = $bdd->prepare("UPDATE `membre`SET `rang`= 0 WHERE `id_membre = ?");
// 		$zero->execute(array($data["id_membre"]));

// 		$down = $bdd->query("UPDATE `membre` SET `rang` = `rang`-1 WHERE `rang`>1;");
// }

	}else {

	$sp = $bdd->prepare("SELECT * FROM `membre` WHERE `rang` = ?");
	$sp->execute(array($_POST["r"]-1));
	$dsp=$sp->fetch();

	$r1=$bdd->prepare("UPDATE `membre` SET `rang` = ? WHERE `id_membre` = ?");
	$r1->execute(array($_POST["r"]-1,$_POST["id"]));

	$r2=$bdd->prepare("UPDATE `membre` SET `rang` = ? WHERE `id_membre` = ?");
	$r2->execute(array($dsp["rang"]+1,$dsp["id_membre"]));
}}


?>
	<div class="row">
		<div class="col-md-12 black">
			<table class="table table-bordered">
				<tr>
					<td>NOM</td>
					<td>PRENOM</td>
					<td>RANG</td>
					<td>ACTIONS</td>
				</tr>
				<?php 
				$srang = $bdd->query("SELECT * FROM `membre` WHERE `rang` > 0 ORDER BY `rang` ASC;");
				$crang=$srang->rowCount();

				if ($crang<1) {
					?>
					<tr>
						<td colspan="4">Pas de membre en fil d'attente</td>
					</tr>
					<?php
				}

				while ($drang=$srang->fetch()) {
					?>
					<tr>
						<td><?php echo $drang["nom_membre"]; ?></td>
						<td><?php echo $drang["prenom_membre"]; ?></td>
						<td><?php echo $drang["rang"]; ?></td>
						<td>
							<form method="POST">
								<input type="hidden" name="id" value="<?php echo $drang['id_membre']; ?>">
								<input type="hidden" name="r" value="<?php echo $drang['rang']; ?>">
								<input type="submit" name="plus" value="+" class="btn btn-success">
								<input type="submit" name="moins" value="-" class="btn btn-danger">
							</form>
						</td>
					</tr>
					<?php
				}

				?>
			</table>
		</div>
	</div>
<?php include('includes/pages/footer.php'); ?>
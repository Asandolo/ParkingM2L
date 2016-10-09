<?php 
$titre = "places disponibles";
include("includes/pages/header.php");

$aujourdhui = date("Y-m-d");

//--------------------------------------------------------
// VERIFIER QUE L'UTILISATEUR N'A PAS DE PLACE OU DE RANG |
//--------------------------------------------------------

$checkHavePlace = $bdd->prepare("SELECT* FROM PLACE,RESERVER WHERE PLACE.id_place = RESERVER.id_place AND id_membre= ?");
$checkHavePlace->execute(array($user['id_membre']));
$countHavePlace = $checkHavePlace->rowcount();

$checkHaveRang = $bdd->prepare("SELECT rang FROM MEMBRE WHERE id_membre= ?");
$checkHaveRang->execute(array($user['id_membre']));
while ($donneCheckHaveRang = $checkHaveRang->fetch()) 
{
  $rangUser = $donneCheckHaveRang['rang'];
}

if($countHavePlace>0)
{
  while ($donneCheckHavePlace = $checkHavePlace->fetch()) 
  {
    if(($donneCheckHavePlace['date_debut_periode']<=$aujourdhui) && ($donneCheckHavePlace['date_fin_periode']>=$aujourdhui))
    {
      $placeUser = $donneCheckHavePlace['num_place'];    
      ?>
        <div class="row">
          <div class="col-md-12 black">
            <p><center><h2><?php echo "Vous avez la place numéro ".$placeUser; ?></h2></center></p>
          </div>
        </div> 
      <?php
    }
  }  
}
elseif ($rangUser>0) 
{

  ?>
  <div class="row">
    <div class="col-md-12 black">
    <p><center><h2><?php echo "Vous avez le rang numéro ".$rangUser; ?></h2></center></p>
    </div>
  </div> 
  <?php
}
elseif ($countHavePlace == 0 && $rangUser == 0) 
{
  if (isset($_POST['reserver'])) 
  {

      $j_deb = $_POST['jour_deb'];
      $m_deb = $_POST['mois_deb'];
      $a_deb = $_POST['annee_deb'];
      $debut_resa = $a_deb."-".$m_deb."-".$j_deb;
      $j_fin = $_POST['jour_fin'];
      $m_fin = $_POST['mois_fin'];
      $a_fin = $_POST['annee_fin'];
      $fin_resa = $a_fin."-".$m_fin."-".$j_fin;

    if ($debut_resa<=$fin_resa && $debut_resa>=$aujourdhui) 
    {
//-----------------------------
//SELECTION DES PLACES RESERVE |
//-----------------------------	

      $CheckPlace = $bdd->prepare("SELECT num_place,date_debut_periode,date_fin_periode FROM PLACE,RESERVER WHERE PLACE.id_place = RESERVER.id_place");
      $CheckPlace->execute(array($fin_resa,$fin_resa,$debut_resa,$debut_resa,$debut_resa,$fin_resa));
      $i = 0;
      while($donnee = $CheckPlace->fetch())
      {
        $place[$i]=null;
        if (($donnee['date_debut_periode']<=$fin_resa && $donnee['date_fin_periode']>=$fin_resa)&&($donnee['date_debut_periode']<=$debut_resa && $donnee['date_fin_periode']>=$debut_resa)) 
        {
          $place[$i]=$donnee['num_place'];
        }
        elseif ($donnee['date_debut_periode']<=$fin_resa && $donnee['date_fin_periode']>=$fin_resa) 
        {
          $place[$i]=$donnee['num_place'];
        }
        elseif ($donnee['date_debut_periode']<=$debut_resa && $donnee['date_fin_periode']>=$debut_resa) 
        {
          $place[$i]=$donnee['num_place'];
        }
        elseif ($donnee['date_debut_periode']>=$debut_resa && $donnee['date_fin_periode']<= $fin_resa) 
        {
          $place[$i]=$donnee['num_place'];
        }
        else
        {
        }
        $i++;
      }

//--------------------------------------------
// SELECTION DE TOUTES LES PALCES DE PARKING |
//--------------------------------------------

      $tsajd = strtotime($aujourdhui);

      $places = $bdd->prepare("SELECT num_place FROM PLACE");
      $places->execute();
      $j=0;
      while ($donneePlaceDisp = $places->fetch()) 
      {
        $placeDispo[$j]=$donneePlaceDisp['num_place'];
        $j++;
      }

//----------------------------------------------------------------
//MAGNIPULATION DES TABLEAUX POUR RESORTIR LES PLACES DISPONIBLES |
//----------------------------------------------------------------

      if(empty($place))
      {

      }
      else
      {
        for ($k=0; $k <=count($place)-1 ; $k++) 
        { 
          for ($l=0; $l <=count($placeDispo)-1 ; $l++) 
          { 
            if ($place[$k] == $placeDispo[$l]) 
            {
              $placeDispo[$l]=null;
              for($increment = $l ; $increment<count($placeDispo)-1 ; $increment++) 
              { 
                 $placeDispo[$increment] = $placeDispo[$increment+1];
              }	
               array_pop($placeDispo);
            }
          }
        }
       }

      for($k=0;$k<count($placeDispo);$k++)
      {
        echo $placeDispo[$k]."</br>";
      }
    }
//-----------------------------------------------------------
// SI IL N'Y A PAS DE PLACE DISPONNIBLE ON MET DANS LE RANG  |
//-----------------------------------------------------------

      if (empty($placeDispo)) 
      {
        $countRang = $bdd->prepare("SELECT rang FROM MEMBRE ORDER BY rang");
        $countRang->execute();
        $attribution=0;
        while ($donneeCRang = $countRang->fetch()) 
        {
          $attribution = $donneeCRang['rang']+1;
        }
        echo $attribution;
      
        $attribRang = $bdd->prepare("UPDATE MEMBRE SET rang = ? WHERE id_membre= ?")  ;
        $attribRang -> execute(array($attribution,$user['id_membre']));
      }

//--------------------------
// 
//--------------------------

    else
    {
      $checkPeriode = $bdd->prepare("SELECT* FROM PERIODE");
      $checkPeriode ->execute();
      $isPeriode= 0;
      while ($donneeCheckPer = $checkPeriode->fetch()) 
      {
        if($donneeCheckPer['date_debut_periode'] == $debut_resa)
        {
          $isPeriode=1;
        }
      }
      if($isPeriode=1)
      {
        $insertPer = $bdd->prepare("INSERT INTO PERIODE VALUES (?)");
        $insertPer->execute(array($debut_resa));
      }
      $insertResa = $bdd->prepare("INSERT INTO RESERVER VALUES (?,?,?,?)");
      $insertResa->execute(array($fin_resa,$user['id_membre'],$placeDispo[0],$debut_resa));
    }
  }
  else
  {
    echo "Erreur selections des dates, la date de début doits être avant la date de   fin et doit se situer après la date d'aujourdhui"; 
  }
?>

<div class="row">
	<div class="col-md-12 black">
		<p><center>PLACES DISPONNIBLES</center></p>
	</div>		



  <div class="col-md-12 black">
   <p>
     <center>
      <form method="POST">
       DATE DE DEBUT : </br></br>
       <label style="color : #0beee8;">Jour</label><select name="jour_deb" required="" style="color : black;">
       <?php
       for ($i=1;$i<=31;$i++) {
        ?>
        <option>
        	<?php
          echo $i;
          ?>  
        </option>
        <?php
      }
      ?>
    </select>
    <label style="color : #0beee8;">Mois</label><select name="mois_deb" required="" style="color : black;">
    <?php
    for ($i=1;$i<=12;$i++) {
     ?>
     <option>
      <?php
      echo $i;
      ?>    
    </option>
    <?php
  }
  ?>
</select>
<label style="color : #0beee8;">Année</label><select name="annee_deb" required="" style="color : black;">
<?php
for ($i=Date("Y");$i<=Date("Y")+3;$i++) 
{
 ?>
 <option>
   <?php
   echo $i;
   ?>    
 </option>
 <?php
}
?>
</select></br>


DATE DE FIN : </br></br>
<label style="color : #0beee8;">Jour</label><select name="jour_fin" required="" style="color : black;">
<?php
for ($i=1;$i<=31;$i++) 
{
  ?>
  <option>
   <?php
   echo $i;
   ?>  
 </option>
 <?php
}
?>
</select>
<label style="color : #0beee8;">Mois</label><select name="mois_fin" required="" style="color : black;">
<?php
for ($i=1;$i<=12;$i++) 
{
 ?>
 <option>
  <?php
  echo $i;
  ?>    
</option>
<?php
}
?>
</select>
<label style="color : #0beee8;">Année</label><select name="annee_fin" required="" style="color : black;">
<?php
for ($i=Date("Y");$i<=Date("Y")+3;$i++) 
{
 ?>
 <option>
   <?php
   echo $i;
   ?>    
 </option>
 <?php
}
?>
</select></br>
<input type="submit" name="reserver" class="btn btn-info">
</form>  
</center>
</p>
</div>
</div>
<?php  
}
?>
<?php include("includes/pages/footer.php"); ?>
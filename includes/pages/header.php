<?php
session_start();
if (!isset($_SESSION["mail"]) ) {
	header('Location: login.php');
}
include("includes/function.php");


$req_user = $bdd->prepare("SELECT * FROM `membre` WHERE `mail_membre` = ?");
$req_user->execute(array($_SESSION["mail"]));
$user = $req_user->fetch();

if ($user["valide_membre"] == 0) {
  header('Location: logout.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Parking M2L -- <?php echo (isset($titre))?$titre:"Parking"; ?></title>

	<link rel="stylesheet" type="text/css" href="includes/css/main.css">
  <link rel="stylesheet" type="text/css" href="includes/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="includes/css/font-awesome.css">

  <script type="text/javascript" src="includes/js/jq.js"></script>
  <script type="text/javascript" src="includes/js/bootstrap.js"></script>
  <!-- <script type="text/javascript" src="includes/js/jquery.jeditable.mini.js"></script> -->
</head>
<body style="color:#eee">
  <div class="container">
    <div class="row">
     <div class="col-sm-3">		
     </div>
     <div class="col-sm-9" style="height:100px; margin-top:10px" >
      <p class="info"><?php echo $user["civilite_membre"]." ".strtoupper($user["nom_membre"])." ".$user["prenom_membre"]; ?></p>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3">
      <div class="sidebar-nav">
        <div class="navbar navbar-inverse" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
              <span class="sr-only">Parking M2L</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <span class="visible-xs navbar-brand">Parking M2L</span>
          </div>
          <div class="navbar-collapse collapse sidebar-navbar-collapse">
            <ul class="nav navbar-nav">
              <strong><p style="color: #0131B4;">Menu Utilisateur</p></strong>
              <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i>
                Accueil</a></li>
                <li><a href="profil.php"><i class="fa fa-user" aria-hidden="true"></i>
                  Profil</a></li>
                  <li><a href="historique.php"><i class="fa fa-history" aria-hidden="true"></i>
                    Historique de places</a></li>
                    <li><a href="doc.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>
                      Documentation</a></li>
                      <?php 

                      if ($user["admin_membre"] == 1) {
                        ?>
                        <br />
                        <strong><p style="color: #0131B4;">Menu Administrateur</p></strong>
                        <li><a href="user_admin.php"><i class="fa fa-users" aria-hidden="true"></i>
                          Utilisateurs</a></li>
                          <li><a href="place_admin.php"><i class="fa fa-car" aria-hidden="true"></i>
                            Places</a></li>
                            <li><a href="attente.php"><i class="fa fa-pause" aria-hidden="true"></i>
                              Liste d'attente</a></li>
                              <?php } ?>
                              <li><a style="color:red;" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Déconnexion</a></li>
                            </ul>
                          </div><!--/.nav-collapse -->
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-9">

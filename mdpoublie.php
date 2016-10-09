<?php
session_start();
if (isset($_SESSION["mail"])) {
  header('Location: index.php');
}
include("includes/function.php");
$o = 0;
$error = NULL;
if (isset($_POST["mdp"])) {
  
  $mail = htmlspecialchars($_POST["mail"]);

$s = $bdd->prepare("SELECT * FROM `membre` WHERE `mail_membre` = ?");
$s->execute(array($mail));
$c = $s->rowCount();

if ($c>0) {
  
  $newpass = stringRand(10);
  $hnewwpass = hashMdp($newpass);

  $u=$bdd->prepare("UPDATE `membre` SET `psw_membre` = ? WHERE `mail_membre` = ?");
  $u->execute(array($hnewwpass,$mail));

  $o = 1;


}else{
  $error = "Le compte n'existe pas";
}


}


?>



<!DOCTYPE html>
<html>
<head>
  <title>LOGIN</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="includes/css/bootstrap.css">
  <style type="text/css">
    body {
      padding-top: 120px;
      padding-bottom: 40px;
      background-color: #eee;
      
    }
    .btn 
    {
     outline:0;
     border:none;
     border-top:none;
     border-bottom:none;
     border-left:none;
     border-right:none;
     box-shadow:inset 2px -3px rgba(0,0,0,0.15);
   }
   .btn:focus
   {
     outline:0;
     -webkit-outline:0;
     -moz-outline:0;
   }
   .fullscreen_bg {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-size: cover;
    background-position: 50% 50%;
    background-image: url('http://cleancanvas.herokuapp.com/img/backgrounds/color-splash.jpg');
    background-repeat:repeat;
  }
  .form-signin {
    max-width: 280px;
    padding: 15px;
    margin: 0 auto;
    margin-top:50px;
  }
  .form-signin .form-signin-heading, .form-signin {
    margin-bottom: 10px;
  }
  .form-signin .form-control {
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
  .form-signin .form-control:focus {
    z-index: 2;
  }
  .form-signin input[type="text"] {
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    border-top-style: solid;
    border-right-style: solid;
    border-bottom-style: none;
    border-left-style: solid;
    border-color: #000;
  }
  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-top-style: none;
    border-right-style: solid;
    border-bottom-style: solid;
    border-left-style: solid;
    border-color: rgb(0,0,0);
    border-top:1px solid rgba(0,0,0,0.08);
  }
  .form-signin-heading {
    color: #fff;
    text-align: center;
    text-shadow: 0 2px 2px rgba(0,0,0,0.5);
  }
</style>
<script type="text/javascript" src="includes/js/jq.js"></script>
<script type="text/javascript" src="includes/js/bootstrap.js"></script>
</head>
<body>
  <div id="fullscreen_bg" class="fullscreen_bg"/>

  <div class="container">
    <center>
      <?php
      if ($o==1) {
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
      }

      ?>
      <span style="color : red;">
        <?php
        echo $error;
        ?>
      </span>
    </center>
    <form class="form-signin" method="POST">
      <h1 class="form-signin-heading text-muted">Mot de passe oublié</h1>
      <input type="mail" name="mail" class="form-control" placeholder="Adresse e-mail" required="" autofocus="">
      <input type="submit"  class="btn btn-success" name="mdp" value="Renvoyez moi mon mot de passe">
    </form>
    <p align="center" >
      <a href="login.php" style="color : #0beee8;">Connexion</a>
    </p>    
  </div>
</body>
</html>
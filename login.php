<?php
session_start();
if (isset($_SESSION["mail"])) {
  header('Location: index.php');
}
include("includes/function.php");
$error= NULL ;
if(isset($_POST["conect"]))
{
  $mail= $_POST["mail"];
  $psw= hashMdp($_POST["psw"]);

  $request = $bdd->prepare("SELECT * FROM membre WHERE mail_membre = ?");
  $request->execute(array($mail));
  $data = $request->fetch();

  if ($data["valide_membre"] == 1) {
      # code...
    if($psw==$data["psw_membre"])
    {
      $_SESSION["mail"] = $data["mail_membre"];
      header('Location: index.php');
    }
    else
    {
      $error = "Le mail ou le mot de passe est éroné";
    }

  }else{
    $error = "Votre compte n'est pas activé";
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
      <span style="color : red;">
        <?php
        echo $error;
        ?>
      </span>
    </center>
    <form class="form-signin" method="POST">
      <h1 class="form-signin-heading text-muted">Connection</h1>
      <input type="text" name="mail" class="form-control" placeholder="Adresse e-mail" required="" autofocus="">
      <input type="password" name="psw" class="form-control" placeholder="Mot de Passe" required="">
      <input class="btn btn-lg btn-primary btn-block" type="submit" value="Se connecter" name="conect">
    </form>
    <p align="center" >
      <a href="register.php" style="color : #0beee8;">S'enregistrer</a>
      <a href="mdpoublie.php" style="color : #0beee8;">Mot de passe oublié</a>
    </p>    
  </div>
</body>
</html>
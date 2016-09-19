<?php
  include("includes/function.php");
  $error= NULL ;
  if(isset($_POST["conect"]))
  {
    $mail= $_POST["mail"];
    $psw= hashMdp($_POST["psw"]);

    $request = $bdd->prepare("SELECT mail_membre,psw_membre FROM MEMBRE WHERE mail_membre=?");
    $request->execute(array($mail));
    $data = $request->fetch();

    if($psw==$data["psw_membre"])
    {
        $error= "okfgjnn";
    }
    else
    {
      $error = "Le mail ou le mot de passe est éroné";
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
  body {
    background-image: url('http://cleancanvas.herokuapp.com/img/backgrounds/color-splash.jpg');
    background-repeat:no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
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
  

  <div class="container">
  <center>
    <span style="color : red;">
      <?php
        echo $error;
      ?>
    </span>
  </center>
  <form class="form-signin" method="POST">
    <h1 class="form-signin-heading text-muted">S'enregistrer</h1>
    <input type="mails" name="mail" class="form-control" placeholder="Adresse e-mail" required="" autofocus=""></br>
    <input type="password" name="psw" class="form-control" placeholder="Mot de Passe" required=""></br>
    <input type="text" name="check_psw" class="form-control" placeholder="Confirmer mot de passe" required=""></br>
    <label style="color : #0beee8;"></label><select type="text" name="civilite" class="form-control" placeholder="civilité" required="">
    <option>
      mr.
    </option>
    <option>
      Mme.
    </option>
    </select></br>
    <input type="text" name="nom" class="form-control" placeholder="nom" required=""></br>
    <input type="text" name="prenom" class="form-control" placeholder="Prénom" required=""></br>
    <label style="color : #0beee8;">Jour</label><select name="jour" class="form-control" required="">
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
    <label style="color : #0beee8;">Mois</label><select name="mois" class="form-control" required="">
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
    <label style="color : #0beee8;">Année</label><select name="annee" class="form-control" required="">
    <?php
      for ($i=Date("Y");$i>=1920;$i--) {
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
    <input type="text" name="rue" class="form-control" placeholder="Adresse" required=""></br>
    <input type="text" name="cp" class="form-control" placeholder="Code Postal" required=""></br>
    <input type="text" name="ville" class="form-control" placeholder="Ville" required=""></br>
    <input class="btn btn-lg btn-primary btn-block" type="submit" value="S'enregistrer" name="enregistrer"></br>
  </form>
  <p align="center" >
  <a href="login.php" style="color : #0beee8;">Se connecter</a>
  </p>    

</body>
</html>
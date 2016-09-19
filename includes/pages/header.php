<?php
session_start();
if (!isset($_SESSION["mail"]) ) {
	header('Location: login.php');
}
include("includes/function.php")
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Parking M2L -- <?php echo $titre ?></title>

	<link rel="stylesheet" type="text/css" href="includes/css/main.css">
	<link rel="stylesheet" type="text/css" href="includes/css/bootstrap.css">

	<script type="text/javascript" src="includes/js/jq.js"></script>
	<script type="text/javascript" src="includes/js/bootstrap.js"></script>
</head>
<body style="color:#eee">
<div class="container">
<div class="row">
	<div class="col-sm-3">		
	</div>
	<div class="col-sm-9" style="height:100px; margin-top:10px" >
		<p>Jean Bon</p>
	</div>
</div>
<div class="row">
  <div class="col-sm-3">
    <div class="sidebar-nav">
      <div class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">Sidebar menu</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Menu Item 1</a></li>
            <li><a href="#">Menu Item 2</a></li>
            <li><a href="#">Menu Item 3</a></li>
            <li><a href="#">Menu Item 4</a></li>
            <li><a href="#">Reviews <span class="badge">1,118</span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <div class="col-sm-9">

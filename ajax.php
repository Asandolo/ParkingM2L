<?php

include("includes/function.php");

$iid = $_POST["id"];
$val = $_POST["value"];

$c = explode("/", $iid);

$id = $c[0];
$champs = $c[1];

// echo $id." ".$champs." ".$val;
 
$up = $bdd->prepare("UPDATE `membre` SET ? = ? WHERE `membre`.`id_membre` = ?;");
$up->execute(array($champs,$val,$id));
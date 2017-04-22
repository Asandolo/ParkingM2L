<?php
include ("config/db.php");
function getInfoConnect($mail){
    $info = $bdd->prepare("SELECT * FROM membre WHERE mail_membre = ?");
    $info->execute($mail);
    return $info;
}


?>
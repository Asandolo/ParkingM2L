<?php

include ("../data/login.data.php");
include ("../includes/function.php");

function isValid($mail, $psw){
    $i = getInfoConnect($mail);
    $data = $i->fetch();

    if ($data["psw_membre"] == hashMdp($psw)){
        return true;
    }else{
        return false;
    }
}

?>
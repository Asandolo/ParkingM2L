<?php

include("includes/function.php");


//...add / change fields name here
if (isset($_POST['nom_membre'])) $qString='nom_membre="'.strip_tags($_POST['nom_membre']).'"'; // If field exists...generate query SET part with column name and new cell value
if (isset($_POST['prenom_membre'])) $qString='prenom_membre="'.strip_tags($_POST['prenom_membre']).'"'; // If field exists...generate query SET part with column name and new cell value
if (isset($_POST['mail_membre'])) $qString='mail_membre="'.strip_tags($_POST['mail_membre']).'"'; // If field exists...generate query SET part with column name and new cell value
if (isset($_POST['adRue_membre'])) $qString='adRue_membre="'.strip_tags($_POST['adRue_membre']).'"'; // If field exists...generate query SET part with column name and new cell value
if (isset($_POST['adCP_membre'])) $qString='adCP_membre="'.strip_tags($_POST['adCP_membre']).'"'; // If field exists...generate query SET part with column name and new cell _membre
if (isset($_POST['adVille_membre'])) $qString='adVille_membre="'.strip_tags($_POST['adVille_membre']).'"'; // If field exists...generate query SET part with column name and new cell value
if (isset($_POST['civilite_membre'])) $qString='civilite_membre="'.$_POST['civilite_membre'].'"';
 
$query = $bdd->execute('UPDATE membre SET '.$qString.' WHERE id_membre='.$_POST['id'].''); // Update database with the correct Id (line)
 
echo '<div class="alert alert-success">Grid modified successfully</div>'; // Message sent back to #result <p> node
?>
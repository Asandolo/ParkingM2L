<!DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8"> 
<script type="text/javascript" src="jquery.js"></script> 
<script> 
$(document).ready(function() 
{  
 $("td").click(function()  
  { 
   if( $(this).attr("contenteditable") == "true") 
   {    
    // le"id" du td doit contenir l'id de la BDD 
    // le "name" doit contenir le nom du champ à modifier 
     
    var contenu_avant = $(this).text(); 
                var id_bdd = $(this).attr("id"); 
                var champ_bdd = $(this).attr("name"); 
    //alert("avant =" + contenu_avant); 
                 
    $(this).blur(function() 
        { 
         var contenu_apres = $(this).text(); 
         //alert("contenu apres = " + contenu_apres); 
         
                                 if (contenu_avant != contenu_apres) 
                                     { 
          parametre='id='+id_bdd+'&champ='+champ_bdd+'&contenu='+contenu_apres ; 
          //alert(param) ; 
          $.ajax({ 
            url: "updatedynamique.php",  
            type: "POST",  
            data: parametre,  
            success: function(html) {  
                  //alert(html); 
                  } 
           }); 
          } 
          
        }); 
     
   };     
             
  }); 
});   

   
</script> 

 </head> 

 <body> 
  
  
 <table border="1"> 
  <tr> 
   <td >--   NOM   --</td> <td >--   TELEPHONE   --</td> 
  </tr> 
  <tr> 
   <td contenteditable="true" id="1" name="nom" >Dupont</td> 
   <td  contenteditable="true" id="1" name="telephone" >0102030405</td> 
   </tr> 
   <tr> 
   <td id="2" name="nom" >Larivierre</td> 
   <td id="2" name="telephone" >0504030201</td> 
   </tr> 
 </table>  
  
  
 </body> 

</html>  
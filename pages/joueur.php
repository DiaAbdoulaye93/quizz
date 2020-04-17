<?php
is_connect();

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Interface joueur</title>
</head>
<body>
    

 <form action="Ajouter_User.php" method="POST" enctype="multipart/form-data">
    <div id="div_principla_cr_admin">
<div id=haut>
 <div style="float:left; width:15%" >
    <div>
        <?php 
         echo '<img src="../img/avatar/'.$_SESSION["user"]['image'].'" alt=""   style="width:50% ;height:70px; border-radius:60%;margin-top:0%">';
            ?>
    </div>
    <div id= "div_nom_prenom_joueur" >
    <?php 
  
    echo '<h3 id="prenom_nom_joueur" >'.$_SESSION["user"]['prenom'].' '.$_SESSION["user"]['nom'].'</h3>';
          
         ?>
  </div>       
   </div>
<h2 id="h2_creat_quizz" style="margin-left:10%;margin-top:-0.8%">BIENVENU SUR LA PLATEFORM DE JEU DE QUIZZ <br> <br>  JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERAL</h2>
<a href="index.php?statut=logout"  id="deconnexion" style="text-align:center;margin-left:55%;padding-top:0.8%;margin-top:-5%">Deconnexion</a>
</div>
 
</div> 
 

 </form>
</body>
</html>
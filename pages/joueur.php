<?php
is_connect();
 
 $List_users=getData();

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Interface joueur</title>
</head>
<script type="text/javascript">
window.onload=function()
    {
        
        var top_score = document.getElementById('top_score');
		var affiche_topScores = document.getElementById('affiche_topScores');
		var mon_score = document.getElementById('mon_score');
		var affiche_MonScore = document.getElementById('affiche_MonScore');
        
        document.onclick=function(div)
        {
            if(div.target.id=='top_score')
            {
                mon_score.style.background="rgb(245, 245, 245)";
                top_score.style.background="#f8fdfd";
                affiche_MonScore.style.display="none";   
                affiche_topScores.style.display="block";
           
            }

            if(div.target.id=='mon_score')
            {
                mon_score.style.background="#f8fdfd";
                top_score.style.background="rgb(245, 245, 245)";
                affiche_topScores.style.display="none";
                affiche_MonScore.style.display="block";  
               
            }
        }
    }
             </script>
<body>
    

 <form action="Ajouter_User.php" method="POST" enctype="multipart/form-data">
<div id="div_principal_user">
  <div id='haut'>
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
    <div class="joueur_bas">
       <div class="joueur_bas_gauche">

       </div>
       <div class="joueur_bas_droite">
           <div class="entete_score">
              <div class="top_score" id="top_score">
                  Top scores 
               
               </div>

              <div class="mon_score" id="mon_score">
                  Mon meilleur score
              </div>
           </div>
     
              <div class="afficher_les_Scores">
              <div class="affiche_topScores" id="affiche_topScores">
                  <h1 class="h1_top5_score">Top 5 scores</h1>
                <?php
                rsort($List_users );
        for ($i=0; $i <=5; $i++): 
        if ("joueur"==$List_users[$i]['profil'])
         {
             echo   '<h2 class="h2_top5_scores">'.$List_users[$i]['prenom'].'  '.$List_users[$i]['nom'].'<span style="text-decoration:underline;color:black">'.$List_users[$i]['score'].'   pts  </span> </h2>';
              
         }  
           endfor; ?>
            
              </div>
            
                <div class="affiche_MonScore" id="affiche_MonScore" >
                <?php 
               echo "Votre meilleur Score est actuellement:  ".$_SESSION["user"]['score']." pts" ;         
                  ?> 
           </div>
      </div>
    </div>
      
  </div>
</div> 
 

 </form>
</body>
</html>
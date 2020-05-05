<?php
is_connect();
 
 $List_users=getData();
$nombre_question_jeux=getData('question_jeu');
$nombre=$nombre_question_jeux[0]['question_jeux'];
 
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
    

 <form action="" method="POST" enctype="multipart/form-data">
<div id="div_principal_user">
  <div id='haut'>
     <div style="float:left; width:15%" >
       <div>
            <?php 
                echo '<img src="img/avatar/'.$_SESSION["user"]['image'].'" alt=""   style="width:50% ;height:70px; border-radius:60%;margin-top:0%">';
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
<?php
 
$questions=getData('questions');
if(isset($_GET['page']))
{
     $page= $_GET['page'];
}
else
{
      $page= 1;
}
$i=0;
while(isset($_POST['reponse'.$i]))
 
{
    $_SESSION['reponse']=$_POST['reponse'.$i];
   // $rep= $_SESSION['reponse'];
   $i++;
}
/*****************************Mise en place de mes parametre de pagination************/
$nbrparPage=1;
$total=count($questions);
$nombredepages= ceil($total/$nbrparPage);
$min=($page-1)*$nbrparPage;
$max=$min+$nbrparPage-1;
$Mon_compteur=0;
for ($i=$min; $i <=$max; $i++)
{ 
$j=$i+1;
    echo "<div id='question_i'><h1 id='num_quest'>Question $j/$nombre: </h1>". $questions[$i]['question']." </div>";
    echo "<h1 id='pts_quest'>". $questions[$i]['points']."pts</h1>";
    echo "<div id='reponses_i'>";
    if($questions[$i]["type"]=="texte")
    { 
         
           echo'<input type="text" name="reponse'.$i.'"  value="'.$_SESSION['reponse'].'" />';   
       //  $_SESSION['reponse']=$rep;
     }
     
     else if("choix_simple"==$questions[$i]["type"] )
     {
           
          
           $reponse=$questions[$i]['reponse'];
           for ($j=0; $j < count($reponse); $j++)
           {
                               
              echo"<h1 id='reponse_i'><input type='radio' name='radio.$i' class='radio_rep'  />". $reponse[$j]['valeur']."<h1></br>";
                 
         
           }
      }
      else if("choix_multiple"==$questions[$i]["type"] )
      {
            
           
            $reponse=$questions[$i]['reponse'];
            for ($j=0; $j < count($reponse); $j++)
            {
                                
               echo"<h1 id='reponse_i'><input type='checkbox' name='chek.$i' class='checkbox_rep' />". $reponse[$j]['valeur']."<h1></br>";
                  
          
            }
       }
     
}


if($page>1)
     {
         ?>
                     <br><button type="submit" name="suivant" class="precedent" id="precedent">
                           <a href="index.php?lien=jeux&page=<?= $page-1?>">PRECEDENT</a>
                    </button>
        <?php  }   
        else{
            echo "";
        } 
        if($page==10)
        {
            ?> 
            
               <button type="submit" name="suivant" class="suivant" id="suivant">
        <a href="index.php?lien=jeux&page=<?= $page+1?>">TERMINER</a>
  </button>
  <?php 
        }
     
        else{
            ?>
                       <button type="submit" name="suivant" class="suivant" id="suivant">
                              <a href="index.php?lien=jeux&page=<?= $page+1?>">SUIVANT</a>
                        </button>

            <?php  
            } 
            echo "</div>";
            ?>
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
        for ($i=0; $i <5; $i++): 
        if ("joueur"==$List_users[$i]['profil'])
         {
          
             echo   '<h2 class="h2_top5_scores">'.$List_users[$i]['prenom'].'  '.$List_users[$i]['nom'].'<span style="text-decoration:underline;color:black;text-decoration-color:red;">'.$List_users[$i]['score'].'   pts  </span> </h2>';
              
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
 <?php

   echo'<br /><button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form>
                        </div>'; 
                        ?>
</body>
</html>
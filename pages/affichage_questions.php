<?php 
/*************Recuperation de mes données*******************/
$Liste_questions=getData("questions");

?>
<div class="creat_question">

</div>
<div class="list_questions" id="list_questions">
     <div class="nbr_question">
          <label for="">Nbr de Question/Jeu:</label>
          <input type="text" class="val_question">
          <input type="submit" value="OK" class="button_question">
      </div>
   
      <div class="questions">
<?php
/*****************Declaration et recuperation de ma variables qui me permet de passer a travers les pages *********/
       if(isset($_GET['page']))
       {
            $page= $_GET['page'];
       }
       else
       {
             $page= 1;
       }

/*****************************Mise en place de mes parametre de pagination************/
     $nbrparPage=5;
     $total=count($Liste_questions);
     $nombredepages= ceil($total/$nbrparPage);
     $min=($page-1)*$nbrparPage;
     $max=$min+$nbrparPage-1;
     $Mon_compteur=0;

/************************Parcours de ma base de données (Fichier json)******************/ 
    for ($i=$min; $i <=$max; $i++)
     { 
  
       if($i==$total)
        {
            break;
         }
       else
       {  
           /*****************Pour les question de type texte***************/
            if("texte"==$Liste_questions[$i]["type"])
              {
                    $Mon_compteur++;
                     echo"<h4>".$Mon_compteur.'.'.$Liste_questions[$i]['question']."</h4><input type='text' readonly='readonly' value='".$Liste_questions[$i]['reponse']."'/>";   
               }

               /***************Pour les question a choix simple***************/

             else if("choix_simple"==$Liste_questions[$i]["type"] )
               {
                      $Mon_compteur++;
                      echo"<h4>".$Mon_compteur.'.'.$Liste_questions[$i]['question']."</h4>";
                    
                     $reponse=$Liste_questions[$i]['reponse'];
                     for ($j=0; $j < count($reponse); $j++)
                     {
                         if("oui"==$reponse[$j]['valide'])
                            {
                                      echo"<h5><input type='radio' name='radio.$i' checked='checked' class='checkbox' />". $reponse[$j]['valeur']."<h5>";
                            }
                        else{
                                     echo"<h5><input type='radio' name='radio.$i' class='checkbox' />". $reponse[$j]['valeur']."<h5>";
                            } 
                   
                     }
                }

                /***********Pour les questions a choix multiples*************/

               else if("choix_multiple"==$Liste_questions[$i]["type"])
                {
                      $Mon_compteur++;
                      echo"<h4>".$Mon_compteur.'.'.$Liste_questions[$i]['question']."</h4>";
                     //  $reponse=array();
                    
                       $reponse=$Liste_questions[$i]['reponse'];
                       for ($j=0; $j < count($reponse); $j++)
                       {
                           if("oui"==$reponse[$j]['valide'])
                              {
                                        echo"<h5><input type='checkbox' name='check' checked='checked' class='checkbox' />". $reponse[$j]['valeur']."<h5>";
                              }
                          else{
                                       echo"<h5><input type='checkbox' name='check' class='checkbox' />". $reponse[$j]['valeur']."<h5>";
                              } 
                     
                       }
                 }
        }
      }
      
/******************************Fin de Parcours de ma base de données (Fichier json)******************/ 
 
     /**********Generation des mes bouttons precedent et suivants qui me permettron de passer a travers les pages***/
     if($page>1)
     {
         ?>
                     <br><button type="submit" name="precedent" class="precedent" id="precedent">
                           <a href="index.php?lien=accueil&lien1=questions&page=<?= $page-1?>">PRECEDENT</a>
                    </button>
        <?php  }   
        else{
            echo "";
        } 
        if($Mon_compteur<$nbrparPage)
        echo "";
        else{
            ?>
                       <button type="submit" name="suivant" class="suivant" id="suivant">
                              <a href="index.php?lien=accueil&lien1=questions&page=<?= $page+1?>">SUIVANT</a>
                        </button>

            <?php  
            } 
       
            ?>
</div>
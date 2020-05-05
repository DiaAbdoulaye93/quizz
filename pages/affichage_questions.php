<?php 
/*************Recuperation de mes données*******************/
$Liste_questions=getData("questions");
$message_question="";
$nombre_question_jeux=getData('question_jeu');
$quest_jeux=$nombre_question_jeux[0]['question_jeux'];
if(isset($_POST["sub_question"]))
{
    $quest_jeux=$_POST["nombre_question_jeu"];
    if(empty($quest_jeux))
    {
        $message_question="Veuillez fixer les nombre de question par jeux";
        
    }
    else{
        if(!is_entier($quest_jeux)){
            $message_question="Veuillez saisir un entier";
        }
        else {
            if($quest_jeux<5)
            {
              $message_question="Le nombre de questions par jeux doit etre sup ou égal à 5 ";
            }
            else{
              $question=array();
              $question['question_jeux']= $quest_jeux;
              $js[]=$question;
              $js=json_encode($js);
              file_put_contents('data/question_jeu.json',$js);     
              echo "<script> alert('Nombre de question fixé par jeu: $quest_jeux')</script>"; 
              $message_question="Le nombre de questions par jeux est fixé a ".$quest_jeux;
            }
        }
     
    }
}
 
    $nombre=$nombre_question_jeux[0]['question_jeux'];
 
?>
<div class="creat_question">

</div>
<div class="list_questions" id="list_questions">
     <div class="nbr_question">
          <label for="">Nbr de Question/Jeu:</label>
          <input type="text" name='nombre_question_jeu' error="error-1" class="val_question" value="<?php echo $quest_jeux ?>">
           <input type="submit" name="sub_question" value="OK" class="button_question"><br>
           <span class="error-form" id="error-1"></span><span style="color:red"><?php echo $message_question ?></span>
      </div>
   
      <div class="questions">
<?php
/*****************Declaration et recuperation de ma variable qui me permet de passer a travers les pages *********/
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
            if($Liste_questions[$i]["type"]=="texte")
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
        if($i==$total)
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

<script>

   const inputs=document.getElementsByTagName("input");
for(input of inputs){
    input.addEventListener("keyup",function(e){
        if(e.target.hasAttribute('error')){
            var idDivError=e.target.getAttribute("error");
            document.getElementById(idDivError).innerText=""
        }
     
    })
}
 document.getElementById("form1").addEventListener("submit",function(e)
 {
     /*Debut validation des inputs de types text*/
    const inputs=document.getElementsByTagName("input");
    var error=false;
    for(input of inputs){
        if(input.hasAttribute("error")){
            var idDivError=input.getAttribute("error");
            if(!input.value){
                document.getElementById(idDivError).innerText="Veuillez fixer le nombre de question par jeu";
                error=true
            } 
            else if(input.value<5){
                document.getElementById(idDivError).innerText="Le nombre de question par jeu doit étre sup ou égal à 5";
                error=true
            } 
         
        }
       }
       /*Fin validation des inputs de types text*/
       if(error){
        e.preventDefault();
        return false;
    }
}) 
</script>
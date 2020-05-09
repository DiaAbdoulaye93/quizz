<?php
$scrore_total=0;
$joueur = getData();

    $_SESSION['nombre']=$nombre;
$questions=getData('questions');
$questionParPage = 1;
$nombrePages = ceil($nombre / $questionParPage);
if(isset($_POST['suivant']))
{
  
    if(isset($_POST['position']))
    {
        
        $position=intval($_POST['position']);
        $_SESSION['questions'][$position]['answer']=answerPlayer($position);
        $_SESSION['tab'][]=$_SESSION['questions'][$position]['answer'];
        $position++;
       
        if($position==$_SESSION['nombre'])
        {
            $position= $_SESSION['nombre']-1;
            foreach ($joueur as $key => $value) {
               if($value['login'] === $_SESSION['user']['login'])
               {
                if($joueur[$key]['score'] < score($_SESSION['questions']))
                {
                  $joueur[$key]['score']=score($_SESSION['questions']);
                }
               }
            }
          saveData($joueur);
         //    var_dump($joueur);
       header('location: index.php?lien=jeux&lien1=recap');
     
        }
    }
 
}
else {
    $position = 0;
}

if(isset($_POST['quitter']))
{
    $position= $_SESSION['nombre']-2;
    foreach ($joueur as $key => $value) {
       if($value['login'] === $_SESSION['user']['login'])
       {
        if($joueur[$key]['score'] < score($_SESSION['questions']))
        {
          $joueur[$key]['score']=score($_SESSION['questions']);
        }
       }
    }
  saveData($joueur);
 //    var_dump($joueur);
header('location: index.php?lien=jeux&lien1=recap');  
}
$nbrpts=0;

 
$min = ($position - 1) * $questionParPage;
 
    if(isset($_POST['precedent']))
    {
        $position=intval($_POST['position']);
        unset($_SESSION['tab'][ $position-1]);
        if($position)
        {
            $position--;
         
            if($position<0)
            {
                $position=0;
                $prev="none";
            }
        }
    }
    function answerPlayer($position)
    {
        $answerPlayer = array();

        if (!empty($_POST['result'])) {
            
                $answerPlayer = $_POST['result'];
            
        }
       
        return $answerPlayer;
    }
$num_quest=$position+1;
    echo "<div id='question_i'><h1 id='num_quest'>Question    $num_quest/$nombre: </h1>". $_SESSION['questions'][$position]['question']."
    
    </div>";
    echo "<h1 id='pts_quest'>".$_SESSION['questions'][$position]['points']."pts</h1>";
     
    ?>
     <input type="hidden" name="" value="<?php echo $nombre; ?>" id="limit">
    <input type="hidden" value="<?php echo $_SESSION['questions'][$position]['type'] ?>" id="type">
    <input type="hidden" name="position" value="<?php echo $position; ?>" id="position">
   
    <div id='reponses_i'>
    <input type='submit' name='quitter' class='precedent' value='Quitter' id='quit' style='width:20%'> 

       
                        <?php
                        for ($i = $min; $i < ($min + $questionParPage); $i++) {
                            if ($_SESSION['questions'][$position]['type'] == 'choix_multiple') {
                                for ($j = 0; $j < (count($_SESSION['questions'][$position]['reponse'])); $j++) {
                                    if (!empty($_SESSION['questions'][$position]['answer']) && in_array($_SESSION['questions'][$position]['reponse'][$j]['valeur'], $_SESSION['questions'][$position]['answer'])) { ?>
                                        
                                        <br>
                                     
                                            <input type="checkbox" class="checkbox_rep" checked name="result[]" value="<?= $_SESSION['questions'][$position]['reponse'][$j]['valeur'] ?>">
                                            <?php echo $_SESSION['questions'][$position]['reponse'][$j]['valeur']; ?>
                                        <?php
                                         
                                            } else { ?>

                                        <br>
                                        
                                            <input type="checkbox"  class="checkbox_rep"  name="result[]" value="<?=$_SESSION['questions'][$position]['reponse'][$j]['valeur']?>">
                                            <?php echo $_SESSION['questions'][$position]['reponse'][$j]['valeur']; ?>
                                        <?php
                                   
                                            }
                                        }
                                    } else if ($_SESSION['questions'][$position]['type'] == 'choix_simple') {
                                        for ($j = 0; $j < (count($_SESSION['questions'][$position]['reponse'])); $j++) {
                                            if (!empty($_SESSION['questions'][$position]['answer']) && in_array($_SESSION['questions'][$position]['reponse'][$j]['valeur'], $_SESSION['questions'][$position]['answer'])) { ?>
                                            
                                        <br>
                                            <input type="radio" class="radio_rep" checked name="result[]" value="<?= $_SESSION['questions'][$position]['reponse'][$j]['valeur'] ?>">
                                            <?php echo $_SESSION['questions'][$position]['reponse'][$j]['valeur']; ?>
                                        <?php
                                 
                                            } else { ?>

                                        <br>
                                            <input type="radio" class="radio_rep" name="result[]" value="<?= $_SESSION['questions'][$position]['reponse'][$j]['valeur'] ?>">
                                            <?php echo $_SESSION['questions'][$position]['reponse'][$j]['valeur']; ?>
                                       <?php
                                            }
                                        }
                                    } else {
                                       
                                            if (!empty($_SESSION['questions'][$position]['answer'])) {
                                                ?>
                                        <br>
                                            <input type="text"  style="border:1px solid grey;border-radius:4px;background-color:gainsboro;margin-left:15%;width:60%"  name="result" value="<?php echo $_SESSION['questions'][$position]['answer']; ?>">
                                       <?php
                                            } else {
                                                ?>
                                        <br>
                                            <input type="text" name="result" style="border:1px solid grey;border-radius:4px;background-color:gainsboro;margin-left:15%;width:60%" placeholder="saisir votre reponse">
                                            <span id="error"></span>
                                        <?php
                                        
                                            }
                                      
                                    }
                                }
                           //     var_dump($_SESSION['questions']);
                          
                            ?>
            
                      </div>     
       
                     <div style="background-color:red; margin-top:10%">
                      <input type="submit" name="suivant" class="suivant" value="suivant" id="next" style="margin-top:2%;width:20%">
                      <input type="submit" name="suivant" class="suivant" value="terminer" id="end" style="margin-top:2%;width:20%">
                      <input type="submit" name="precedent" value="precedent" class="precedent" id="prev" style="float:left;width:20%">
                      </div> 
        <?php
      
        ?>  
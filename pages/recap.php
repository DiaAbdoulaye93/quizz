<?php
//var_dump($_SESSION['questions']);
$scr=score($_SESSION['questions']);
$scrore_total= $_SESSION['ptstotal'];

?>
<div id='reponses_i'>
<?php

for($position=0;$position<count($_SESSION['questions']);$position++)
{
    $num_quest=$position+1;
    echo "<div class='recapitualion' id='divrecap'>";
   echo  $num_quest.".". $_SESSION['questions'][$position]['question'];
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
                    if (!empty($_SESSION['questions'][$position]['answer']) && in_array($_SESSION['questions'][$position]['reponse'][$j]['valeur'], $_SESSION['questions'][$position]['answer'])) 
                    {
                              echo"<br><input type='radio' name='radio.$position' checked='checked' class='radio_rep' />". $_SESSION['questions'][$position]['reponse'][$j]['valeur'];
                    }
                else{
                             echo"<br><input type='radio' name='radio.$position' class='radio_rep' />".$_SESSION['questions'][$position]['reponse'][$j]['valeur'] ;
                    } 
                }
            } else {
               
                    if (!empty($_SESSION['questions'][$position]['answer'])) {
                        ?>
                <br>
                    <input type="text" class="form-rep" name="resul[]" value="<?php echo $_SESSION['questions'][$position]['answer'];  ?>" style="border:1px solid grey;border-radius:4px;background-color:gainsboro;margin-left:15%;width:60%">
               <?php
                    } else {
                        ?>
                <br>
                    <input type="text" name="result" error="error" style="border:1px solid grey;border-radius:4px;background-color:gainsboro;margin-left:15%;width:60%">
                    <span id="error"></span>
                <?php
                
                    }
              
            }
            
            echo "</div>";
  
}
echo '<h1 style="color:black;margin-left:30%;margin-top:1% ;border:4%;background-color:gainsboro; text-align:center;height:100px;padding-top:3%">Score final:'.$scr.'pts/'.$scrore_total.'</h1>'; 

?>
</div>
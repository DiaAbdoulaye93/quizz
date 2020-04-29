 <?php
 $question=getData("questions");
 $message_question=$message_select=$message_point=$QESTION=$points= $type_reponse=$error="";
  
if(isset($_POST['enreg'])){
    $QESTION=$_POST["champ_question"];
    $points=$_POST["points"];
    $type_reponse=$_POST["liste"];
    $i=1;
   if(isset($QESTION) &&  $QESTION!=""){
      if(isset($points) &&  $points>1){
           if(isset($type_reponse) &&   $type_reponse !=""){
             
              $js=file_get_contents('data/questions.json');
                    $js= json_decode($js,true);
                    $question=array();
                    $question['question']=$_POST["champ_question"];
                    if($type_reponse=="choix1"){
                        $question['type']="texte";
                        $question['reponse']=$_POST["texte1"];
                        $question['points']= $_POST["points"]; 
                        $js[]=$question;
                        $js=json_encode($js);
                        file_put_contents('data/questions.json',$js);     
                        echo "<script> alert('Question ajouté')</script>";  
                        echo "<meta http-equiv='refresh' content='0.5;url=index.php?lien=accueil&lien1=creer_questions'/>";
                       } 
                       else if($type_reponse=="choix2"){
                        $question['type']="choix_simple";
                      $compteur=0;
                        while(isset($_POST['texte'.$i]))
                          { 
                              if(isset($_POST['radio'.$i])){
                           $compteur++ ;
                                $question['bonne_reponse'][]=$_POST['texte'.$i];
                              }
                              else{
                                $question['Mauvaise_reponse'][]=$_POST['texte'.$i];
                              }
                              $i++;
                          }  
                         if($compteur !=1)
                         {
                             $error="Cocher une seule reponse pour valider votre question";
                         }
                         else{
                            $question['points']= $_POST["points"]; 
                            $js[]=$question;
                            $js=json_encode($js);
                            file_put_contents('data/questions.json',$js);     
                            echo "<script> alert('Question ajouté')</script>";  
                            echo "<meta http-equiv='refresh' content='0.5;url=index.php?lien=accueil&lien1=creer_questions'/>";
                        
                         }
                            

                       } 
                       else if($type_reponse=="choix3"){
                        $question['type']="choix_multiple";
                        $compteur1=0;
                        while(isset($_POST['texte'.$i]))
                          {

                              if(isset($_POST['check'.$i])){
                               $compteur1++;
                                $question['bonne_reponse'][]=$_POST['texte'.$i];
                              }
                              else{
                                $question['Mauvaise_reponse'][]=$_POST['texte'.$i];
                              }
                              $i++;

                          }
                          if($compteur1 <2)
                          {
                            $error="Choisissez au minimun deux reposes valides";
                          }
                        else{
                            $question['points']= $_POST["points"]; 
                            $js[]=$question;
                            $js=json_encode($js);
                            file_put_contents('data/questions.json',$js);     
                            echo "<script> alert('Question ajouté')</script>";  
                            echo "<meta http-equiv='refresh' content='0.5;url=index.php?lien=accueil&lien1=creer_questions'/>";
                         
                        }
                            
                       } 
     
            }else{
                $message_select="Choisir un type de reponse";
            }

      }else{
          $message_point="verifier ce champs";
      }
   } else{
    $message_question="Rensigner votre question";
   }
  
}
 ?>

 <form method="post" id="form1" name="myform" onsubmit="return validate()">
<div class="principal_creat_question" id="principal_creat_question"  >
    <div class="titre_creat_question">PARAMETRER VOTRE QUESTION</div>
    <div class="cr_questions"  id="cr_questions">
         <div class="champ_question">
              Questions
             <input type="text" class="espace_question" name="champ_question" error="error-1" value="<?php echo $QESTION ?>"> 
             <span style="color:red"><?php echo $message_question ?></span>
             <br><span class="error-form" id="error-1"></span>
         </div>
         <br>
         <div class="nombre_de_points">
           Nbr de points
           <input type="number"  min="1" class="pts" placeholder="1" name="points" error="error-2" value="<?php echo $points ?>">
           <span style="color:red"><?php echo $message_point ?></span>
           <br><span class="error-form" id="error-2"></span>
        </div>
        <br>
        <div class="type_de_reponse">
            Type de réponse
            <select name="liste" id="liste_type_reponses" class="liste_type_reponses" error="error-3"  value="<?php echo $type_reponse ?>" >
                <option value="">Donnez le type de reponse</option>
                <option value="choix1" id="choix1" >Reponse type text</option>
                <option value="choix2" id="choix2">Reponse choix simple</option>
                <option value="choix3" id="choix3">Reponse choix multiple</option>
            </select><span style="color:red"><?php echo $message_select ?></span>
            <br><span class="error-form" id="error-3"></span>

           <div id="supprimer" >
           <input id="ic_supprimer" type="button"  >
            
            </div>
       </div>
       <div class="affiche_question" id="affiche_question">

       </div>
    <br><br>   <span style="color:red" class="error-form"><?php echo $error ?></span> 
  </div>
  
      <input type="submit" class="enregistrer" value="Enregistrer" name="enreg" id="enreg" onclick="return val();">
</div>

<script>
     var Ajouter_champ=document.getElementById("ic_supprimer");
     var Select_reponse=document.getElementById("liste_type_reponses");
     var Affiche_question=document.getElementById("affiche_question");
     /*declaration du compteur i*/
     var i = 1;
    Ajouter_champ.addEventListener('click',Ajout);

    /*Fonction qui permet de generer des champs */
    function Ajout() 
    {
       
        var selecteur=document.getElementById("liste_type_reponses").value;
var t1=document.getElementById("choix1");
var t2=document.getElementById("choix2");
var t3=document.getElementById("choix3");

 var form = document.getElementById("affiche_question");
        var div = document.createElement("div");
        var divError=document.createElement("div");
        divError.setAttribute('class','error-form');
        divError.id='error'+i; 
        var ident = 'div-'+i;
        div.setAttribute('id', ident);
        var label = document.createElement("input");
        var valuelabel = 'Reponse'+i;
        label.setAttribute('name',valuelabel);
        label.setAttribute('type','button');
        label.setAttribute('value',valuelabel);
        label.setAttribute('id',valuelabel);
        label.setAttribute('style', 'float:left; font-weight:bold;background-color:white;border:none;margin-top:3%;width:17%;font-size:20px;text-align:left');            
       /*Cration champ de texte*/
        var texte = document.createElement("input");
        var valuetexte = 'texte'+i;
        texte.setAttribute('name',valuetexte);
        texte.setAttribute('type','text');
        texte.setAttribute('id',valuetexte);
        texte.setAttribute('error',"error"+i);
        texte.setAttribute('style', 'margin-left:0%;width:50%;margin-top:3%;');
        /*Creation button radio*/
        var radio = document.createElement("input");
        var valuetexte = 'radio'+i;
       
        radio.setAttribute('type','radio');
       // radio.setAttribute('name',radios);
       radio.setAttribute('name',valuetexte);
       
       radio.setAttribute('id',valuetexte);  
        radio.setAttribute('error',"error"+i);
        radio.setAttribute('style', 'margin-left:1%;width:2%;margin-top:2.5%;position:absolute;background-color:white');
        /* Creation Du Check Box*/
        var check = document.createElement("input");
        var valuetexte = 'check'+i;
        check.setAttribute('type','checkbox');
        check.setAttribute('name',valuetexte);
        check.setAttribute('id',valuetexte);  
        check.setAttribute('error',"error"+i);
        check.setAttribute('style', 'margin-left:1%;width:2%;margin-top:3.2%;position:absolute;height:30px;');
         /* Creation boutton de suppression*/
        var bouton = document.createElement("input");
        var value = 'Reponse'+i;
        bouton.setAttribute('name',value);
        bouton.setAttribute('type','button');
        bouton.setAttribute('id',value);
        bouton.setAttribute('onclick','Supp("' + ident + '");');
        bouton.setAttribute('style', 'margin-left:4%;width:1.5%;margin-top:3.5%;position:absolute;background-image:url("img/Icônes/ic-supprimer.png");background-repeat:no-repeat;height:24px;background-color:white;border:none');
       
        /*Debut de la generation des champs en fonction des conditions*/
        if(selecteur=="choix1"){ 
           div.appendChild(label);
           div.appendChild(texte);
           div.appendChild(bouton);
           div.appendChild(divError);
           form.appendChild(div); 
           if(i==1){
            Ajouter_champ.disabled=true;
           } 
        }
       else if(selecteur=="choix2"){ 
           div.appendChild(label);
           div.appendChild(texte);
           div.appendChild(radio);
           div.appendChild(bouton);
           div.appendChild(divError);
           form.appendChild(div);  
        }
        else if(selecteur=="choix3"){
           div.appendChild(label);
           div.appendChild(texte);
           div.appendChild(check);
           div.appendChild(bouton);
           div.appendChild(divError);
           form.appendChild(div);  
        }
        i++;
    }

 /*Fonction qui permet de supprimer un champ*/
    function Supp(ident)
    {
        var elt = document.getElementById(ident);
        var form = elt.parentNode;
        form.removeChild(elt);
        i=i-1;
        Ajouter_champ.disabled=false;
    }
    
  
/*Liaison du selecteur de type de  reponse et de l'evenement change*/
     Select_reponse.addEventListener("change",reinitialiser_div)

/*Fonction qui permet de reinitialiser la div apres changement d'option select*/
    function reinitialiser_div()
{
    Affiche_question.innerHTML = "";
   i=1
   Ajouter_champ.disabled=false;
}

/*Validation coté client du Formulaire */
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
                document.getElementById(idDivError).innerText="Ce Champ est obligatoire";
                error=true
            } 
         
        }
       }
       /*Fin validation des inputs de types text*/

       /************ Debut Validation du select *********/
       const select=document.getElementById("liste_type_reponses");
       var error1=false;
       if(select.hasAttribute("error"))
       {
            var idDivError1=select.getAttribute("error");
            if(!select.value)
            {
                document.getElementById(idDivError1).innerText="Selectionner un type de reponse";
                error1=true
            } 
         
        }
         /************ Fin Validation du select *********/

        /************ Validation des inputs de type  radio *********/
        
       const Radio_valide = document.querySelectorAll('input[type="radio"]');
        var error2=false;
        var compteur=0;
        for (const Radio_buton of Radio_valide) {
           
            if (Radio_buton.checked ) {
              error2=false;
                compteur++;
            }

      }
      if(compteur !=1)
      {
      
        for (const Radio_buton of Radio_valide)
        {
          
            if(Radio_buton.hasAttribute("error"))
            {
                {
                    var idDivError2=Radio_buton.getAttribute("error");
                    document.getElementById(idDivError2).innerText="Cocher la bonne reponse";
                    error2=true;
                }

            }     
        }
     }
         /************ Validation des inputs de type  radio *********/

       /*********** Debut Validation des inputs de type Checkbox ************/
     const Check_buttons=document.querySelectorAll('input[type="checkbox"]');
     var error3=false;
     var compteur1=0;
     for (const check_i of Check_buttons)
     { 
            if (check_i.checked) 
            {
                 compteur1++;
                     
            }
      }
      if(compteur1<=1)
        {
         
            for (const check_i of Check_buttons)
            {
                if(check_i.hasAttribute("error"))
                {
                    var idDivError3=check_i.getAttribute("error"); 
                    document.getElementById(idDivError3).innerText="Veuillez cocher au minimum deux reponses valides";
                    error3=true;
                }
                else
                {
                 
                    document.getElementById(idDivError3).innerText="";
                }
            }  
           
        }
        /*********** Fin Validation des inputs de type Checkbox ************/
 
    

    if(error || error1||   error2 || error3){
        e.preventDefault();
        return false;
    }
})

  

    
  
</script>
</form>
 
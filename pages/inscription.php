<?php
 $validation=$echec=$message=$prenom=$nom=$login=$pass=
 $validation_pass=$passconfirm=$image=$validation_pseudo="";
 $compteur=0;
 if(isset($_POST['button']))
 {
    if(isset($_POST['prenom'])){$prenom = $_POST['prenom'];}
    if(isset($_POST['nom'])){$nom = $_POST['nom'];}
    if(isset($_POST['login'])){$login = $_POST['login'];}
    if(isset($_POST['pass'])){$pass = $_POST['pass'];}
    if(isset($_POST['passconfirm'])){$passconfirm =$_POST['passconfirm'];}
           if(empty($prenom)||empty($nom)|| empty($login) ||
            empty($pass) || empty($passconfirm))
                {
                    $echec="Remplire le/les champs restantes";
                }
            else
                { 
                    if($pass==$passconfirm)
                    {
                        $target_dir ='img/avatar/';
                        $fch = $target_dir.basename($_FILES['imag']["name"]);
                        $image= $_FILES['imag']["name"];
                        $extension = new SplFileInfo($image);
                         if($extension->getExtension()=='png' || $extension->getExtension()=='PNG' ||
                         $extension->getExtension()=='JPEG' || $extension->getExtension()=='jpeg')
                         {
                            
                            if(move_uploaded_file($_FILES["imag"]["tmp_name"], $fch))
                              {           
                                 $informations=array();
                                 $informations['score']=100000;
                                 $informations['prenom']=$prenom;
                                 $informations['nom']=$nom;
                                 $informations['login']=$login;
                                 $informations['pass']=$pass;
                                 $informations['passconfirm']=$passconfirm;
                                 $informations['image']= $image;
                              

                                 if(!isset($_SESSION['statut']))
                                     {
                                       
                                          $informations['profil']="joueur";
                                          $js=file_get_contents('data/creation_user.json');
                                          $js= json_decode($js,true);
                                          for ($i=0; $i <count( $js) ; $i++) { 
                                            if($login==$js[$i]['login'])
                                            {
                                                
                                             $compteur++;
                                         }
                                   }
                                   if($compteur>0){
                                       $validation_pseudo="Ce loggin existe deja";
                                   }
                                        else
                                        {
    
                                            $js[]=$informations;
                                            $js=json_encode($js);
                                            file_put_contents('data/creation_user.json',$js);     
                                            echo "<script> alert('Inscription reussie')</script>";  
                                         echo "<meta http-equiv='refresh' content='0.5;url=index.php'/>";
                                        }
                                          
                                            
                                          
                                     }
                                 else
                                     {
                                          $informations['profil']="admin";
                                          $js=file_get_contents('data/creation_user.json');
                                          $js= json_decode($js,true);
                                        for ($i=0; $i <count( $js) ; $i++) { 
                                           if($login==$js[$i]['login'])
                                           {
                                            $compteur++;
                                        }
                                  }
                                  if($compteur>0){
                                      $validation_pseudo="Ce loggin existe deja";
                                  }
                                  else{
                                    $js[]=$informations;
                                    $js=json_encode($js);
                                    file_put_contents('data/creation_user.json',$js);     
                                    echo "<script> alert('Inscription reussie')</script>";  
                                 
                                   require_once("pages/accueil.php");
                                   }
                                  }
                                    
                               }           
                              else
                               {
                                        $validation="Echec inscription, upload image incompléte";
                                }
                        }
                        else{
                            $validation="Extension du fichier invalide: seuls format jpeg et png sont acceptés";
                        }
                        
                    }
                    else{
                        $validation_pass="Confirmation du mot de passe incorrecte";
                    }
                    
                }
               
}
?>

<script>
    function previewImage(event)
    {
        var reader=new FileReader();
        var imageField=document.getElementById("im")
        reader.onload=function()
        {
            if(reader.readyState==2)
            {
                imageField.src=reader.result;
            }
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<form action="" method="post" id="form1" enctype="multipart/form-data">
 <div id="Principal_incription">
  <div id='inscription'>
    <h2 id='h2_inscription'>S'INSCRIRE</h2> 
      <h5>
        <?php
      
          if(!isset($_SESSION['statut']))
            {
             echo " <h3 style='margin-top:-2%;color:grey'>Pour tester votre Culture Général </h3>";
            }
          else
            {
        echo "Pour proposer des quizz";
            }

        ?>
     </h5>
  </div>

 <div id="bas_inscription">
   <div id="prev">
        <img  alt="" src="img/avatar/avatar.jpg"  id="im" > 
        <h3>
          <?php
      
             if(!isset($_SESSION['statut']))
             {
                   echo'<span style="color:black;margin-left:15%">Avatar du Joueur</span>';
              }
            else
              {
                   echo'<span style="color:black;margin-left:10%">Avatar du Admin</span> ';
               }

            ?>
        </h3>    
        </div>
       <div id="coordonnees">
             
           <br> <span>Prénom</span> <br>
           <input type="text" name="prenom" id="prenom"  error="error-1" placeholder="Joooo" value="<?php echo $prenom ?>">
           <br><span class="error-form" id="error-1"></span>
           <span style='color:red'><?php  echo $message ?></span>
           <br><span>Nom</span> <br>
           <input type="text" name="nom" id="nom" error="error-2" placeholder="wwww" value="<?php echo $nom ?>">
           <br><span class="error-form" id="error-2"></span>
           <span style='color:red'><?php  echo $message ?></span>
           <br> <span>Login</span> <br>
           <input type="text" name="login" id="login" error="error-3" placeholder="Jow" value="<?php echo $login ?>">
           <span style="margin-left:0%" class="error-form" ><?php  echo $validation_pseudo ?></span>
           <br><span class="error-form" id="error-3"></span>
           <span style='color:red'><?php  echo $message ?></span>
           <br><span>Password</span> <br>  
           <input type="password" name="pass" id="pass" error="error-4" placeholder="*********" value="<?php echo $pass ?>"> 
           <br><span class="error-form" id="error-4"></span>
           <span style='color:red'><?php  echo $message ?></span>
           <br><span>Confirmer Password</span> <br>
           <input type="password" name="passconfirm" id="passconfirm" error="error-5" placeholder="*********" value="<?php echo $passconfirm ?>"><span style="margin-left:0%" class="error-form" id="erreur7"></span>
           <span style="margin-left:0%" class="error-form" ><?php  echo $validation_pass ?></span>
           <br><span class="error-form" id="error-5"></span>
           <span style='color:red'><?php  echo $message ?></span>
           
            <br><span style="color:black">Avatar</span>  
           <input type='file' name="imag" id="imag"   onchange="previewImage(event)"/ > 
           <span style="margin-left:0%" class="error-form" ><?php  echo $validation ?></span>
       </div>
       <br><span style='color:red;font-weight:bold;margin-left:10%'><?php echo $echec ?></span>
          <br> <br>
       <div id="Inscription">
           <input type="submit" name="button" value="Créer compte" id="button_inscription">
            
       </div>

   </div >
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
document.getElementById("form1").addEventListener("submit",function(e){
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
    if(error){
        e.preventDefault();
        return false;
    }
})

/*
document.getElementById("pass").addEventListener("input",function(){
	
	if(this.value.length <=4){
        erreur6 = document.getElementById("erreur6");
		erreur6.innerHTML="Securité faible";
    }
    else if(5<=this.value.length<=8){
        erreur6_1 = document.getElementById("erreur6_1");
		erreur6_1.innerHTML="Sécurite moyenne";
    }
	else if(this.value.length>8){
        erreur6_2 = document.getElementById("erreur6_2");
		erreur6_2.innerHTML="Sécurite élévé";
	}
});
*/
document.getElementById("passconfirm").addEventListener("input",function(){
	erreur = document.getElementById("erreur7");
	if(this.value != document.getElementById("pass").value){
		erreur.innerHTML="Confirmation invalide";
	}
	else{
		erreur.innerHTML="Confirmation valide";
	}
});


</script>
</form>

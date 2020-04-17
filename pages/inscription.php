<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>Page d'inscription</title>
</head>
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
 
<form action="Ajouter_User.php" method="POST" enctype="multipart/form-data">
   <div id="Principal_incription">
   <div id="inscription">
   <h2 id="h2_inscription">S'INSCRIRE</h2> 
 <h3 style="margin-top:-2%;color:grey">Pour tester votre Culture Général</h3>
</div>
   <div id="bas_inscription">
   <div id="prev">
               <img src="../img/avatar/avatar.jpg" alt=""   id="im" > 
             <h3><span style="color:black;margin-left:20%">Avatar du Joueur</span></h3>
           </div>

       <div id="coordonnees">
             
           <br> <span>Prénom</span> <br>
          <input type="text" name="prenom" id="prenom" placeholder="Joooo">
   <br><span>Nom</span> <br>
           
      
           <input type="text" name="nom" id="nom" placeholder="wwww">
   <br> <span>Login</span> <br>
          <input type="text" name="login" id="login" placeholder="Jow">
   <br><span>Password</span> <br>
           <input type="password" name="pass" id="pass" placeholder="*********">
           <br><span>Confirmer Password</span> <br>
           <input type="password" name="passconfirm" id="passconfirm" placeholder="*********"><br>
           
           <br><span style="color:black">Avatar</span>  
           <input type='file' name="imag" id="imag" onchange="previewImage(event)"/ > 
         
       </div>
  <br>
       <div id="Inscription">
           <input type="submit" name="button" value="Créer compte" id="button_inscription">
            
       </div>

   </div >
</div> 
</form>

</body>
</html>
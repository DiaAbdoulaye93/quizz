 
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
<div id="Principal_incription_creat_user" style="margin-left:-30%">
<div id="inscription">
   <h2 id="h2_inscription">S'INSCRIRE</h2>
    <h5>Pour proposer des quizz</h5>
</div>
   <div id="bas_inscription">
   <div id="prev" style="width:40%;">
               <img src="../img/avatar/avatar.jpg" alt=""   id="im" style="width:80%;height:200px" > 
             <h3><span style="color:black;margin-left:10%;">Avatar Admin</span></h3>
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
           <input type='file' name="imag" id="imag" onchange="previewImage(event)" /> 
       </div>
  <br>
       <div id="Inscription">
           <input type="submit" name="button" value="Créer compte" id="button_inscription" style="width:30%">
            
       </div>

   </div >
</div> 
</div>
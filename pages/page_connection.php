<?php 

 $message=$message1=$pseudo=$pass=$echec="";
 
if(isset($_POST["connection"]))
{
    $pass=$_POST["pwd"];
    $pseudo=$_POST["user"]; 
    $result=connexion($pseudo,$pass);
    if($result=="error")
    {
        $echec="login ou mot de pass incorrecte";
    }
    else
    {
        $_SESSION["login"]=$pseudo;
        
        header("location:index.php?lien=".$result); 
    }

  /*  if(empty($_POST["user"]) && !empty($_POST["pwd"]))
        {  
            $pass=$_POST["pwd"];   
            $message="champ obligatoire";
        }
    else if (empty($_POST["pwd"]) && !empty($_POST["user"]))      
        {   
            $pseudo=$_POST["user"];    
            $message1="champ obligatoire";
        }
    else if (empty($_POST["pwd"]) && empty($_POST["user"]))  
        {
            $message=$message1="champ obligatoire";
        }
    else
       {
           $pseudo=$_POST["user"];
           $pass=$_POST["pwd"];
           $file="../creation_user.json";
           $js=file_get_contents($file);
           $js=json_decode($js);
           for ($i=0; $i <count($js) ; $i++)
              {
                 if(($pseudo==$js[$i]->login) && ($pass==$js[$i]->pass))
                     {
                         if("admin"==$js[$i]->type_user)
                            {
                                 $_SESSION['login'] = $pseudo;
                                 $prenom=$js[$i]->prenom;
                                 $nom=$js[$i]->nom;
                                 $image=$js[$i]->image;
                                 $_SESSION['prenom']=$prenom ;
                                 $_SESSION['nom']=$nom;
                                 $_SESSION['image']=$image;
                                  header('Location:../creation_admin.php');
                             }
                         else
                            {
                                  $_SESSION['login'] = $pseudo;
                                  $prenom=$js[$i]->prenom;
                                  $nom=$js[$i]->nom;
                                  $image=$js[$i]->image;
                                  $_SESSION['prenom']=$prenom ;
                                  $_SESSION['nom']=$nom;
                                  $_SESSION['image']=$image;
                                  header('Location:../interface_joueur.php');
                             }
        
         
                     }
                  else
                     {
                        $echec= "<h4 style='color:red; margin-top:-2%;margin-left:40%;'>Loggin ou mot de pass invalide<h4>";
                     }
                }
   
        }*/

}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Page Connection</title>
</head>
<body >
<?php //include("entete.php");
?>
<form   action="" method="post"  id="form-connexion">
   <div id="Principal">
   <div id="haut">
   <h3>Login Form</h3>
   
</div>
   <div id="bas">
       <div id="username">
           <input type="text" name="user" id="user" error="error-1"  placeholder="Login" value="<?php echo $pseudo ?>">
           <img src="../img/icônes/ic-login.png" alt="" id="usericone">
           <span style='color:red' ><?php //echo $message ?></span>
         <div class="error-form" id="error-1"></div>
       </div>
       <div id="passeword">
           <input type="text" name="pwd" id="pwd" error="error-2"  placeholder="Password"  value="<?php echo $pass ?>">
           <img src="../img/icônes/ic-password.png" alt="">
          <div class="error-form" id="error-2"></div> 
          <span style='color:red'><?php //echo $message1 ?></span>
        
       </div>
<span style='color:red;font-weight:bold;margin-left:30%'><?php echo $echec ?></span>
       <div id="connection">
           <input type="submit" value="Connexion" name="connection" id="button">
           <h2><a href="index.php?lien=inscription">S'inscrire pour Jouer ?</a></h2>
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
document.getElementById("form-connexion").addEventListener("submit",function(e){
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
   
 


</script>
</form>
</body>
</html>
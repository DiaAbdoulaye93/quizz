<?php
session_start();
function getData($file="creation_user"){
    $data=file_get_contents("../data/".$file.".json");
    $data=json_decode($data,true);
    return $data;
}
 
 
function connexion($pseudo,$pass){
$users=getData();
 
   foreach ($users as $key => $user) {
    if($user["login"]===$pseudo && $user["pass"]===$pass)
    {

        $_SESSION["user"]=$user;  
         $_SESSION["statut"]="login";
         if($user["profil"]==="admin")
         {
             return "accueil";
         }
         else {
             return "jeux";
         }
    }
        
      
    }
    return "error"; 
 
}
function deconnexion()
{
    unset( $_SESSION["user"]);
    unset( $_SESSION["statut"]);
    session_destroy();
}
function is_connect()
{
    if(!isset($_SESSION['statut']))
    {
        header("location:index.php");
    }

}


?>
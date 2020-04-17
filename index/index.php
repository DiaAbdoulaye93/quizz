<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=div, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quizz</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
<div class="content" style="">
  <div id="entete">
       <img src="../img/logo-QuizzSA.png" alt="" style="margin-left: width:10%; height:100px">
       <h1 id="text-entete">Le plaisir de jouer</h1> 

   </div> 
  
    <?php 
    require_once("../fonctions/fonctions.php");
    if(isset($_GET['lien']))
    {
        switch($_GET['lien'])
        {
            case "accueil":
            require_once("../pages/accueil.php");
            
            break;
            case "jeux":
            require_once("../pages/joueur.php");
            break;
            case "inscription":
            require_once("../pages/inscription.php");
            break;
            default:
            require_once("../pages/page_connection.php");
        }
    }
    else{
        if(isset($_GET['statut']) && $_GET['statut']=="logout")
        {
            deconnexion();
        }
        require_once("../pages/page_connection.php");
    }
     
    ?>
    </div>
</body>
</html>
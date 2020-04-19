<?php
 is_connect();
 
?>
 <title>Page Administrateur</title>
  

</head>
<body>
  
<form action="" method="POST" enctype="multipart/form-data">
    <div id="div_principal_cr_admin" style="background-color:#f8fdfd">
<div id=haut>
<h2 id="h2_creat_quizz">CREER ET PARAMETRER VOS QUIZZ</h2>
<a href="index.php?statut=logout" id="deconnexion">Deconnexion</a>
</div>
<div id="div_gauche_create_user">
<div id="h_gauch_cr_user">
<div id="div_img_cr_user">
    <div style="border:1px solid rgb(112, 108, 57); width:30% ;height:150px; border-radius:50%;padding-top:1%;padding-left:3%">
        <?php 
         echo '<img src="../img/avatar/'.$_SESSION["user"]['image'].'" alt=""   style="width:90% ;height:130px; border-radius:50%;margin-top:5%">';
            ?>
    </div>
    <div id= "nom_prenom">
    <?php 
  
    echo '<h3 id="prenom_avatar">'.$_SESSION["user"]['prenom'].'</h3>';
         echo '<h3 id="nom_avatar">'.$_SESSION["user"]['nom'].'</h3>';
         ?>
           </div>
</div>
</div>
<div id="gauch_cr_user_bas">
<div id="d1" name="d1">
    <span>
Liste des Questions
    </span>
    <a href="index.php?lien=accueil&lien1=questions"> <img id="icon_gauch1" src="../img/icônes/ic-liste.png" alt="" ></a>
</div>

<div id="d2">
    <span>
Creer un Admin
    </span>
    <a href="index.php?lien=accueil&lien1=inscription1"><img id="icon_gauch2" src="../img/icônes/ic-ajout-active.png" alt=""></a>
</div>

<div id="d3">
    <span>
Liste des joueurs
    </span>
    <a href="index.php?lien=accueil&lien1=joueurs"><img id="icon_gauch3" src="../img/icônes/ic-liste.png" alt=""></a>
</div>
<div id="d4">
    <span>
Creer Questions
    </span>
    <a href=""> <img id="icon_gauch4" src="../img/icônes/ic-ajout.png" alt=""></a>
</div>

</div>
</div>
<div id="partie_droite_admin">


  <?php 
    
    if(isset($_GET['lien1']))
    {
        switch($_GET['lien1'])
        {
            case "questions":
           require_once("questions.php");
            break;
            case "joueurs":
            require_once("../pages/joueurs.php");
            break;
            case "inscription1":
            require_once("../pages/inscription.php");
            break;
            
        }
    }
    else{
        include("../pages/joueurs.php");
  
    }
   
             ?>
     

  
</div>


    </div>
   

 </form>
</body>
</html>
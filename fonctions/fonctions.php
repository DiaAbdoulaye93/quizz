<?php
session_start();
function getData($file="creation_user"){
    $data=file_get_contents("data/".$file.".json");
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
             $question=getData('questions');
           //  $points=scoreTotal($question['points']);
             $_SESSION['questions']=quest_jeu($question);
            $_SESSION['ptstotal']= scoreTotal($_SESSION['questions']);
             return "jeux";
         }
    }
        
      
    }
    return "error"; 
 
}
function is_entier($char)
{
   return (preg_match("/[0-9]/", $char));
   

}

function saveData($data,$file ="creation_user"){
    $data = json_encode($data);
    file_put_contents('data'.'/'.$file.'.json', $data);
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
function quest_jeu($questions)
{
    $nombre_question_jeu=getData('question_jeu');
    $nombre=$nombre_question_jeu[0]['question_jeux'];
    $tabquestion=array();
    while (count($tabquestion)<$nombre) {
       $randquestion=rand(0,(count($questions)-1));
       if(!in_array($questions[$randquestion],$tabquestion))
       {
           $tabquestion[]=$questions[$randquestion];
       }
    }
    return $tabquestion;
}


function scoreTotal($tableau){
    $total = 0;
    for ($i=0; $i < count($tableau) ; $i++) { 
      $total = $total + $tableau[$i]['points'];
    }
    return $total;
  }

  function score($question){
    $score = 0;
    
    for ($i=0; $i < count($question); $i++) { 

        if ($question[$i]['type'] == 'texte') {
            if ((!empty($question[$i]['answer'])) && $question[$i]['answer'] === $question[$i]['reponse']) 
            {
                $score = $score + $question[$i]['points'];
            } 
        }
      else  if ($question[$i]['type'] == 'choix_simple') {
            if ((!empty($question[$i]['answer'])) ){
                for ($k=0; $k <count(($question[$i]['answer'])) ; $k++) { 
            for ($j=0; $j < count($question[$i]['reponse']); $j++) { 
                 {
                     if($question[$i]['answer'][$k]===$question[$i]['reponse'][$j]['valeur'] && $question[$i]['reponse'][$j]['valide']=="oui")
                     {
                     $score = $score + $question[$i]['points'];
                    }  
                }
            }
            }
        }
        }
       
        else if($question[$i]['type'] == 'choix_multiple'){
           $compt=0;
           $repverai=0;
                if (!empty($question[$i]['answer'])) {
                    for ($j=0; $j < count($question[$i]['reponse']); $j++) {
                        if($question[$i]['reponse'][$j]['valide']=="oui")
                      {
                        $repverai++;
                      }  
                    }
                    if(count(($question[$i]['answer']))== $repverai)
                    {
                       for ($k=0; $k <count(($question[$i]['answer'])) ; $k++) { 
                            for ($j=0; $j < count($question[$i]['reponse']); $j++) { 
                            if($question[$i]['answer'][$k]===$question[$i]['reponse'][$j]['valeur'] && $question[$i]['reponse'][$j]['valide']=="non")
                            {
                                $compt++;
                            }
                    }
                
                }
                if($compt==0)
                {
                    $score = $score + $question[$i]['points'];
                }
            }
               
            }
           
        }
    }        
    return $score;
}
 
?>
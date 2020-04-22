<?php   
 $List_users=getData();

?>
<div class="listusers" id="listusers">
    <div class="titre">LISTE DES JOUEURS PAR SCORE</div>
    <div class="affichage_joueurs">
   
   
     <table>
         <thead>
        
                <th>Nom</th>
                <th>Prénom</th>
                <th>Score</th>
         </thead>
         <tbody>  

        <?php   

if(isset($_GET['page']))
{
       $page= $_GET['page'];
}
else{
 $page= 1;
 }
        $nbrparPage=15;
        $total=count($List_users);
        $nombredepages= ceil($total/$nbrparPage);
        $_SESSION['users'] =$List_users;
       $min=($page-1)*$nbrparPage;
        $max=$min+$nbrparPage-1;
        
          rsort($List_users);
       
        for ($i=$min; $i<=$max; $i++): 
        if ("joueur"==$List_users[$i]['profil']) {
           
           ?>
            <tr> 
            <td><?php echo $List_users[$i]['nom']?> </td>
            <td><?php  echo $List_users[$i]['prenom']?></td>
            <td><?php  echo $List_users[$i]['score']?> pts</td>
        </tr>
      
         <?php }  endfor; ?>
         </tbody>
     </table>
     <div class="paginate-liste-zone">
        <button type="submit" name="suivant" class="suivant" id="suivant"><a href="index.php?lien=accueil&lien1=joueurs&page=<?= $page+1?>">SUIVANT</a></button>
        </div>
    
    </div>
</div>

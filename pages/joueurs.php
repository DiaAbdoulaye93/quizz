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
        
        
          rsort($List_users );
        for ($i=0; $i <count($List_users); $i++): 
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
      
    </div>
</div>

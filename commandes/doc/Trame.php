<?php

// Trame Applis


# Voir si index de id order detail à bouger
#lire l'index de Presta :
# Si oui voir combien de nouvelles row
#Identifer les raw à updatez
#Lecture de 1 raw x sur id_order_detail  
#Ecriture de 1 raw x sur web_command  (en cours)
# a faire 3 x car les donnéees son sur 3 tables



//Analise resultat requete SQL 


foreach($dbh->query($sql_4) as $row1) {
        
        //print_r($row1);  //affiche toutes les infos
        
        web_command($row1);
}


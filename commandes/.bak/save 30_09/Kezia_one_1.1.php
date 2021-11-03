<!--# Module php de connexion Kezia II avec Prestashop <br />

# 25/09/19 Version 1.0 

# Serveur linux pour Crontab
# BDD Accessible exterieur en écriture et lecture 
# Création Base de Données Tampon MySQL 

# Commandes, Clients, Articles 
# Mise à jour des bases de données tampons créés entre Kezia et Prestashop
# Module Presta Cherche 

# I Recherches de nouvelles commandes sur BD Presta : 
# Synchro :
 Table Kezia T  : web_commande       
 Table Prestashop : ps_orders         

# Si pas de commande : rien 
# Si commande présente : Ecrit sur BD Tampon pour que Kezia puisse la récupérer 
# qui viendra la chercher automatiquement <br /><br />

# II Lecture BD Commandes de Presta et <br />
# Ecriture sur BD Tampon de la commande et des infos associées. <br />
# Presta lit la BD Tampon pour mettre à jour ses articles tous les heures <br />
# SI changement : New articles, recup info et creation article sur prestashop. <br/><br/>
 

# Comparer les index pour voir si nouvelles commandes 
si id_order_detail  >  CODE_WEB de Kezia alors lance recup 

Voir la différence entre les deux pour le nombres de commande à recup    

# Tables Presta traitées :<br/>
# ps_orders : commandes   id_order : Cles P
# ps_address : adresses pour client qui ont commandé id_address  : Cles P<br />
# ps_customer : clients enregistré sans commandes   id_customer  : Cles P<br />
-->

<html>
<head>
    <meta charset="UTF-8">
    <title>PrestaKez</title>
    <link href="style.css" rel="stylesheet" media="all" type="text/css"> 
    <h1>Prestashop Kezia II Connect</h1>
  <script type="text/javascript">
    function afficher()
    {
        alert("Yo ca gaze ?");

    }   
</script> 
    </head>
<body>
    <?php
    #inclusion des fichiers annexes :
    include 'Kezia_one_func.php'; 
    include 'Kezia_select.php';
    include 'Kezia_insert.php';
    
    # bouton Syncro 
    echo '<form><input type="submit" name="valider" value="Syncroniser les bases" onclick="afficher();"></form>';
             
    select_test();
  
    # AFFICHAGE ET ECRITURE DES NOUVELLES DONNEES SUR LA TABLE WEB_COMMAND
    insert_webcommande();
 


?>
<a href="formulaire.html">Entrée de données</a>
</body>
</html>
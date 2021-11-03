<html>
<meta charset="UTF-8">
<head>
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <title>PrestaKez</title>
    <link href="style.css" rel="stylesheet" media="all" type="text/css"> 
     
    </head>
<body>

  
<?php 
include 'menu.php';
?>

<h2>PRÉSENTATION DU MODULE</h2><br />
<p>
Module php de connexion Kezia II avec Prestashop <br /><br />
# 25/09/19 Version 1.0 <br /><br />

# Serveur linux impératif pour Crontab<br /><br />
# BDD Accessible exterieur en écriture et lecture <br /><br />
# Création de Bases de Données Tampon MySQL avec phpMyadmin (script fourni) <br /><br />

# Commandes, Clients, Articles <br />

# Mise à jour des bases de données tampons créés entre Kezia et Prestashop<br />
# Module Presta Cherche <br />

# I Recherches de nouvelles commandes sur BD Presta : <br />
# Synchro :<br />
 Table Kezia T  : web_commande       <br />
 Table Prestashop : ps_orders         <br />

# Si pas de commande : rien <br />
# Si commande présente : Ecrit sur BD Tampon pour que Kezia puisse la récupérer <br />
# qui viendra la chercher automatiquement <br /><br />

# II Lecture BD Commandes de Presta et <br />
# Ecriture sur BD Tampon de la commande et des infos associées. <br />
# Presta lit la BD Tampon pour mettre à jour ses articles tous les heures <br />
# SI changement : New articles, recup info et creation article sur prestashop. <br/><br/>
 

# Comparer les index pour voir si nouvelles commandes <br />
si id_order_detail  >  CODE_WEB de Kezia alors lance recup <br />

Voir la différence entre les deux pour le nombres de commande à recup    <br />

# Tables Presta traitées :<br/>
# ps_orders : commandes   id_order : Cles P<br />
# ps_address : adresses pour client qui ont commandé id_address  : Cles P<br />
# ps_customer : clients enregistré sans commandes   id_customer  : Cles P<br />
</p>

</body>
</html>
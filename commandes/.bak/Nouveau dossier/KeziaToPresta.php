<br/>
# Module php de connexion Kezia II avec Prestashop <br />

# 25/09/19 Version 1.0 <br/><br/>

<!--
# Création Base de Données Tampon MySQL <br />
# Accessible par Internet en écriture et lecture <br />
# Commandes, Clients, Articles # <br />
# Mise à jour des bases de données tampons créés entre Kezia et Prestashop <br />
# Module Presta Cherche <br /><br />

# I Recherches de nouvelles commandes sur BD Presta <br />
# Si pas de commande : Rien <br />
# Si commande présente : Ecrit sur BD Tampon pour annoncer la commande à Kezia 
# qui viendra la chercher automatiquement <br /><br />

# II Lecture BD Commandes de Presta et <br />
# Ecriture sur BD Tampon de la commande et des infos associées. <br />
# Presta lit la BD Tampon pour mettre à jour ses articles tous les heures <br />
# SI changement : New articles, recup info et creation article sur prestashop. <br/><br/>
 
# Tables Presta traitées :<br/>
# ps_address <br />
# ps_customer <br />
-->
<html>
<head>
    <title>Test PHP</title>
</head>

<body>
    <!--    <form action="test2.php" method="GET"><p>
            
            <input type="text" name="nome" />
            <input type="submit" value="Valider" /></p> 
    -->
<?php
  
#connexion bdd avec try catch
try {

    $user = "root";
    $pass = "x6FDJtF5pctooBBy";
    $db_name = "presta_kezia_tampon2";
    $table = "tuto_php";
    $ip_host = "localhost";

    echo 'Nom de la Base traitée : ';
    echo $db_name;
    echo '<br />';
    echo 'Nom de la Table : ';
    echo $table;
    echo '<br />';
    echo '<br />';
    # connexion 
    $dbh = new PDO("mysql:host=$ip_host;dbname=$db_name", $user, $pass);
    echo 'Connexion Base de données OK<br/><br/>';
    

    echo 'Affichage des valeurs : ';
    $requete = 'SELECT * from tuto_php';
    foreach($dbh->query($requete) as $row) {
        //print_r($row);
        affich_line($row);

}

    $dbh = null;

} catch (PDOException $e) 
{
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

function affich_line($row) {

    echo 'Nom :' . $row['Nom'];
    echo '<br />';
    echo 'Prénom :' . $row['Prenom'];
    echo '<br />';
    echo 'Adresse :' . $row['Adresse'];
    echo '<br />';
    echo '<br />';
}

# inclusion fichier ext

include 'fonction_kez.php';     
$vers = ' 1.0.0';
              
$user_os = 'Olivier';
if ($user_os=='Olivier') {
     
echo '<p>Module de connexion Kezia Prestashop Version'.$vers.'</p>'; 

     } else {
         
         echo '<p>Interdiction de connexion</p>'; 
     }
          
# appel fonction 1
# i_fuck_you();
    
# appel fonction 2
# surface(6,4);
     
echo '<br/>';
# affiche info navigateur
#echo $_SERVER['HTTP_USER_AGENT'];
#echo '<br/>';
echo '<br/>';
     
# affichage tableau 
$tableau = [ 'User' , 'Employé' , 'Admin' , 'Direction' ];
echo "Hello {$tableau[2]} !!";
echo '<br/>';
          
?>
</body>
</html>
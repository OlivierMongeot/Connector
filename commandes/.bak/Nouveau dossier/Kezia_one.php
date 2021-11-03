<!--# Module php de connexion Kezia II avec Prestashop <br />

# 25/09/19 Version 1.0 <br/><br/>


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
# ps_orders : commandes   id_order : Cles P
# ps_address : adresses pour client qui ont commandé id_address  : Cles P<br />
# ps_customer : clients enregistré sans commandes   id_customer  : Cles P<br />
-->
<html>
<head>
    <title>Kezia Connect</title>
</head>

<body>
<p>



         <form action="formulaire.php" method="POST">
        <p>
            Nom
            <input type="text" name="nom" required="required"/>
            Prenom
            <input type="text" name="prenom" required="required"/>
            Mail
            <input type="text" name="mail" required="required"/>
            Password
            <input type="text" name="password" required="required"/>

            <input type="submit" value="Valider" />
        </p>
    </form>
    
    <?php
    $user = "root";
    $pass = "x6FDJtF5pctooBBy";
    $db_name = "presta_og_store_2";
    $table = "ps_orders";
    $table_2 = "ps_customer";
    $servername = "localhost";

    echo 'Nom de la Base traitée :' . "$db_name" . '<br />';
    echo 'Nom de la Table : ' . "$table" . '<br />' . '<br />';
    
    $requete = "SELECT * from $table";
    $requete2 = "SELECT * from $table_2";
    
#connexion bdd avec try catch
try {
    
    $dbh = new PDO("mysql:host=$servername;dbname=$db_name", $user, $pass);
    
    echo 'Connexion Base de données OK<br/><br/>';
    echo 'Affichage des commandes :<br/><br/>';
    
    foreach($dbh->query($requete) as $row) {
        //print_r($row);  //affiche toutes les infos
        affich_orders($row);
    }
    $dbh = null;


    $dbh2 = new PDO("mysql:host=$servername;dbname=$db_name", $user, $pass);
    
    echo 'Affichage des données Clients enregistrés :<br/><br/>';
    
    #requete nom du client 
    foreach($dbh2->query($requete2) as $row2) {
       affich_address($row2);
    }
    $dbh2 = null;


   

} catch (PDOException $e) 
{
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

# affiche joliement les données 
function affich_orders($row) {

    echo 'Commande N°: ' . $row['id_order'];
    echo '<br />';
    echo 'Reférence : ' . $row['reference'];
    echo '<br />';
    echo 'Client ID : ' . $row['id_customer'];
    echo '<br />';
    echo 'Date et heure de Commande : ' . $row['date_add'];
    echo '<br />';
    echo 'Adresse ID : ' . $row['id_address_delivery'];
    echo '<br />';
    echo '<br />';
}

function affich_address($row2) {

    echo 'Nom du Client : ' . $row2['lastname'];
    echo '<br />';
    echo 'Prénom du Client : ' . $row2['firstname'];
    echo '<br />';
    echo '<br />';
}

echo '<br/>';
echo '<br/>';
     
          
?>
</body>
</html>
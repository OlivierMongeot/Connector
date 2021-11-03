<?php

function select_test()
{

	$servername = "localhost";
    $user = "root";
    $pass = "x6FDJtF5pctooBBy";
    $db_name = "presta_og_store_2";
    $tbl_1 = "ps_orders";
    $tbl_2 = "ps_customer";
    $tbl_3 = "ps_order_details";

# recup des info commandes 
#connexion bdd avec try catch 

try {
    $sql_3 = "SELECT $tbl_1.id_order, $tbl_2.firstname, $tbl_2.lastname, $tbl_2.email, $tbl_1.payment, $tbl_1.total_paid, $tbl_1.current_state, $tbl_1.reference FROM $tbl_1 INNER JOIN $tbl_2 ON $tbl_1.id_customer = $tbl_2.id_customer";

    $dbh = new PDO("mysql:host=$servername;dbname=$db_name", $user, $pass);
    echo 'Connexion : OK <br/>';
    
    echo '<h2>AFFICHAGE DES COMMANDES :</h2>';
    foreach($dbh->query($sql_3) as $row) {
        //print_r($row);  //affiche toutes les infos
        affich_orders($row);
    }
    $dbh = null;

} catch (PDOException $e) 
{
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
}
?>
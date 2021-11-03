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
    
    
    echo '<h2>AFFICHAGE DES COMMANDES :</h2>';
    #echo 'Connexion : OK <br/>';
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


# affiche joliement les données de virtual web command
function web_command($row1)
	 {
    echo '<p>'.'Commande Détails N°: ' . $row1['id_order_detail'];
    echo '<br />';

    echo 'Transport : ' . $row1['id_carrier'];
    echo '<br />';
    
    echo 'Adresse : ' . $row1['address1'];
    echo ' ' . $row1['address2'];
    echo '<br />';

    echo 'Code Postal : ' . $row1['postcode'];
    echo '<br />';

    echo 'Ville : ' . $row1['city'];
    echo '<br />';

    echo 'Pays : ' . $row1['id_country'];
    echo '<br />';
    
    echo 'Date Commande : ' . $row1['date_add'];
    echo '<br />';

    echo 'Tarif Transport : ' . $row1['total_shipping_tax_incl'];
    echo '<br />';
    
    echo 'Paiement : ' . $row1['payment'];
    echo '<br />';
    
    echo 'EAN13 : ' . $row1['product_ean13'];
    echo '<br />';
    
    echo 'Status de la commande : ';
    #echo  $row1['current_state'];
    state_order($row1);
    echo '<br /></p>';
    }


 # affiche joliement les données 
	function affich_orders($row) 
	{
    echo '<p>'.'Commande N°: ' . $row['id_order'];
    echo '<br />';
    echo 'Reférence : ' . $row['reference'];
    echo '<br />';
    echo 'Client : ' . $row['firstname'];
    echo ' ' . $row['lastname'];
    echo '<br />';
    echo 'Paiement : ' . $row['payment'];
    echo '<br />';
    echo 'Total Payé : ' . $row['total_paid'];
    echo '<br />';
    echo 'Status de la commande : ';
    #echo  $row['current_state'];
    # echo '<br/>';
    state_order($row);
    echo '<br /></p>';
    }


function state_order($row)
{
    $state = $row["current_state"];

    switch($state)
    {
        case "1":
        echo '<b>En attente du paiement par chèque</b>';
        break;
        case "2";
        echo '<b>Paiement accepté</b>';
        break;
        case "3";
        echo '<b>En cours de préparation</b>';
        break;
        case "4";
        echo '<b>Expédié</b>';
        break;
        case "5";
        echo '<b>Livré</b>';
        break;
        case "6";
        echo '<b>Commande annulée</b>';
        break;
        case "7";
        echo '<b>Remboursé</b>';
        break;
        case "8";
        echo '<b>Erreur de paiement</b>';
        break;
        case "9";
        echo '<b>En attente de réapprovisionnement (payé)</b>';
        break;
        case "10";
        echo '<b>En attente du virement bancaire</b>';
        break;
        case "11";
        echo '<b>Paiement à distance accepté</b>';
        break;
        case "12";
        echo '<b>En attente de réapprovisionnement (non payé)</b>';
        break;
        case "13";
        echo '<b>En attente du paiement à la livraison</b>';
        break;
    }
}
   
function server_info()
{
echo '<p><b>Ip & port : </b>';
echo $_SERVER['HTTP_HOST'];
echo ':'.$_SERVER['REMOTE_PORT'];
echo "<br>";
echo "<br>";
echo '<b>Software : </b>';
echo $_SERVER['SERVER_SOFTWARE'];
echo "<br>";
echo "<br>";
echo '<b>Script : </b>';
echo $_SERVER['SCRIPT_NAME'];
echo "<br>";
echo "<br>";
echo '<b>Common Gateway Interface in use : </b>';
echo $_SERVER['GATEWAY_INTERFACE'];
echo "<br>";
echo "<br>";
echo '<b>Méthode de requetes : </b>';
echo $_SERVER['REQUEST_METHOD'];
}


?>
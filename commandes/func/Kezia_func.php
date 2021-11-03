 <?php
include 'Kezia_BDD.php';
    # recup des info commandes sur un mix d'info de 3 tables
function select_test()
{
    
    $t1 = "ps_orders";
    $t2 = "ps_customer";
    $t2_mail = "email";
    $t2_fname = "firstname";
    $t2_lname = "lastname";


    $selected ="$t1.id_order,
    $t2.$t2_fname,
    $t2.$t2_lname,
    $t2.$t2_mail,
    $t1.payment,
    $t1.total_paid,
    $t1.current_state,
    $t1.reference";
    
    $sql_3 = "
    SELECT $selected
    FROM 
    $t1 
    INNER JOIN 
    $t2 
    ON 
    $t1.id_customer = $t2.id_customer
    ORDER BY id_order DESC
    ";
    

        
    echo '<h2>AFFICHAGE DES COMMANDES DE LA BASE PRESTASHOP :</h2>';
    
    $con = ConBdPresta();

    foreach($con->query($sql_3) as $row) {
            #print_r($row);  //affiche toutes les infos en vrac
            affich_orders($row);
    }


    $con = null;

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
    
    echo 'Mail : ' . $row['email'];
    echo '<br />';

    echo 'Paiement : ' . $row['payment'];
    echo '<br />';
    
    echo 'Total Payé : ' . $row['total_paid'];
    echo '<br />';
    
    echo 'Status de la commande : ';
    #echo  $row['current_state'];
    state_order($row);
    echo '<br /></p>';
    }



# affiche joliement les données de virtual web command de presta 
function web_command($row1)
	 {
    echo '<p>'.'Commande Détails N°: ' . $row1['id_order_detail'];
    echo '<br />';

    echo 'Transport : ' . $row1['id_carrier'];
    echo '<br />';
    
echo 'Nomt : ' . $row1['firstname'];
    echo '<br />';

echo 'Prenom : ' . $row1['lastname'];
    echo '<br />';

    echo 'Adresse : ' . $row1['address1'];
    echo 'Adresse CC : ' .ucwords(strtolower( $row1['address1']));
    echo ' ' . $row1['address2'];
    echo '<br />';
    echo 'Code Postal : ' . $row1['postcode'];
    echo '<br />';

    echo 'Ville : ' . $row1['city'];
    echo '<br />';

    echo 'Pays : ' . $row1['id_country'];
    echo '<br />';
    ##### parse de la date en 8 chiffres inverse 
    echo 'Date Commande : ' . $row1['date_add'];
    echo '<br />';
    echo 'Date Commande 2 : ' . substr( $row1['date_add'],0, -9);
    echo '<br />';
    $dte = substr( $row1['date_add'],0, -9);
    echo 'Date Commande 3 : ';
    $newstr = filter_var($dte, FILTER_SANITIZE_STRING);
    $var = str_replace('-', '', $newstr);
    echo $var;
    echo '<br />';
    echo 'Date Commande 4 : ';
    $rest1 = substr($var, -4); 
    $rest2 = substr($var, -8, 4); 
    $dte= $rest1.$rest2;
    echo $dte;

    echo '<br />';
    #substr(string_name, start_pos, length_to_cut) 
    echo 'Tarif Transport : ' . $row1['total_shipping_tax_incl'];
    echo '<br />';
    
    echo 'Paiement : ' . $row1['payment'];
    echo '<br />';
    
    echo 'EAN13 : ' . $row1['product_ean13'];
    echo '<br />';
    
    echo 'Numero Article : ' . $row1['product_id'];
    echo '<br />';

    echo 'Quantité : ' . $row1['product_quantity'];
    echo '<br />';

    echo 'Total TTC : ' . $row1['total_price_tax_incl'];
    echo '<br />';

    echo 'Reduction : ' . $row1['reduction_amount'];
    echo '<br />';

    echo 'TVA : ' . $row1['id_tax_rules_group'];
    echo '<br />';

    echo 'Status de la commande : ';
    #echo  $row1['current_state'];
    state_order($row1);
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
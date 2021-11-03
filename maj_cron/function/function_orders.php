 <?php
//include 'Kezia_BDD.php';
    # recup des info commandes su



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
    WHERE ps_orders.current_state != 6
    ORDER BY id_order DESC LIMIT 7
    ";
    

        
    //echo '<h2>AFFICHAGE DES 7 DERNIERES COMMANDES :</h2>';
    
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
    echo ' | ';
    
    echo 'Reférence : ' . $row['reference'];
    echo '<br />';
    
    echo 'Client : ' . $row['firstname'];
    echo ' ' . $row['lastname'];
    echo ' | ';
    
    echo 'Mail : ' . $row['email'];
    echo '<br />';

    echo 'Paiement : ' . $row['payment'];
    echo ' | ';
    
    echo 'Total Payé : ' . $row['total_paid'];
    echo '<br />';
    
    echo 'Status de la commande : ';
    #echo  $row['current_state'];
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
   





function counter_order()
{
    $con = ConBdPresta();
    $counter = "SELECT COUNT(*) FROM ps_orders WHERE current_state != 6"; 
    $stmt = $con->query($counter);
    $row = $stmt->fetch();
    $number = $row[0];
    return $number;

}



  
   
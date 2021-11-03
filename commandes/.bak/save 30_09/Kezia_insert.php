 <?php
   #Table a remplir pour Les commandes 
    ###### web_commande
   
    # Table : web_commande
    # NO_WEB             auto icremente 
    # CODE_WEB           *id_order_detail                   ps_order_detail 
    # LIV                *id_carrier                        ps_orders
    # ADR1               address1                          ps_adress
    # ADR2               address2                          ps_adress
    # CP                 postcode                          ps_adress
    # VILLE              city                              ps_adress 
    # PAYS               id_country                        ps_adress 
    # DATECDE            *date_add                          ps_orders
    # PORT               *total_shipping_tax_inc            ps_orders
    # MODE_DE_REGLEMENT  *payment                           ps_orders
    # NOTA               *product_ean13                     ps_orders_detail
    # TRAITE             *current_state                     ps_orders  

    # Table : web_li_cde  
    # Table : web_client avec nouveau client à la suite  


# ECRITURE DES NOUVELLES DONNEES SUR LA TABLE WEB_COMMAND
function insert_webcommande() 
{
    $servername = "localhost";
    $user = "root";
    $pass = "x6FDJtF5pctooBBy";
    $db_name = "presta_og_store_2";
    $db_name_2 = "presta_kezia_tampon2";
    $tbl_1 = "web_commande";
    $tbl_2 = "ps_customer";
    $tbl_3 = "ps_order_details";
  
# SELECTION ET LECTURE DES TABLES PRESTA DE ps_order,ps_orders_details,ps_adress :
try {

    $sql_4 = "SELECT ps_order_detail.id_order_detail, ps_orders.id_carrier, ps_address.address1, ps_address.address2, ps_address.postcode, ps_address.city, ps_address.id_country, ps_orders.date_add, ps_orders.total_shipping_tax_incl, ps_orders.payment, ps_order_detail.product_ean13, ps_orders.current_state 

    FROM ps_orders 
    JOIN ps_order_detail 
    ON ps_orders.id_order = ps_order_detail.id_order 
    JOIN ps_address 
    ON ps_orders.id_customer = ps_address.id_customer";

    $dbh = new PDO("mysql:host=$servername;dbname=$db_name", $user, $pass);
      
    echo '<h2>AFFICHAGE DES COMMANDES WEB_COMMAND :</h2>';
    
    foreach($dbh->query($sql_4) as $row1) {
        //print_r($row1);  //affiche toutes les infos
        web_command($row1);
    }

    $dbh = null;
   
} catch (PDOException $e) 
{
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

# ECRITURE DES NOUVELLES DONNEES SUR LA TABLE WEB_COMMAND de Kezia

#insert_webcommande($row1);


    $conn = new PDO("mysql:host=$servername;dbname=$db_name_2", $user, $pass);
    // set the PDO error mode to exception
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
   
    # Mise en var pour lecture ok par sql VALUE (probleme de quote) 
    
    $id_od = $row1['id_order_detail'];
    $id_ca = $row1['id_carrier'];
    $id_a1 = $row1['address1'];
    $id_a2 = $row1['address2'];
    $id_po = $row1['postcode'];
    $id_cy = $row1['city'];
    $id_co =$row1['id_country'];
    $id_da =$row1['date_add'];   //int 8 transfo en int 22
    $id_ts =$row1['total_shipping_tax_incl'];
    $id_pa =$row1['payment'];   // int transfo en string  
    $id_ea =$row1['product_ean13'];
    $id_st =$row1['current_state'];


#    $sql_5 = "INSERT INTO the last web_commande (CODE_WEB) VALUES ('$iod')";
    $sql_5 = "INSERT INTO web_commande (CODE_WEB, LIV, ADR1, ADR2, CP, VILLE, PAYS, DATECDE, PORT, MODE_DE_REGLEMENT, NOTA, TRAITE) VALUES ('$id_od', '$id_ca', '$id_a1', '$id_a2', '$id_po', '$id_cy', '$id_co', '$id_da', '$id_ts', '$id_pa', '$id_ea', '$id_st')"; 
                
    // use exec() because no results are returned
    $conn->exec($sql_5);

}

?>
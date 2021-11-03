 <?php
 
#include 'Kezia_BDD.php';

# ECRITURE DES NOUVELLES DONNEES SUR LA TABLE WEB_COMMAND en 2 ETAPES : 

   #Il faut au final remplir web_commande synchronise avec le me nombre id de ps_order_details :
   
    # Table : web_commande à remplir 

    # NO_WEB             auto icremente 
    # CODE_WEB           id_order_detail   
    # LIV                id_carrier                        ps_orders
    # ADR1               address1                          ps_adress
    # ADR2               address2                          ps_adress
    # CP                 postcode                          ps_adress
    # VILLE              city                              ps_adress 
    # PAYS               id_country                        ps_adress 
    # DATECDE            *date_add                          ps_orders
    # PORT               *total_shipping_tax_inc            ps_orders
    # MODE_DE_REGLEMENT  *payment                           ps_orders
    # NOTA               *product_ean13                     
    # TRAITE             *current_state                     ps_orders  

    # Table : web_li_cde  
    # Table : web_client avec nouveau client à la suite  

# un script qui liste et un script qui update ou qui insert ou delete,


#insert_webcommande($row1);
function select_webcommande() 
{
    echo '<h2>SELECT DES COMMANDES DE LA BASE PRESTASHOP :</h2>';

 # 1 SELECTION ET LECTURE DES 3 TABLES PRESTA DE 
# ps_orders  # ps_order_detail # ps_address 

try {
    $sql = "SELECT
    ps_order_detail.id_order_detail,
    ps_orders.id_carrier,
    ps_customer.firstname,
    ps_customer.lastname,
    ps_address.address1,
    ps_address.address2,
    ps_address.postcode,
    ps_address.city,
    ps_address.id_country,
    ps_orders.date_add,
    ps_orders.total_shipping_tax_incl,
    ps_orders.payment,
    ps_order_detail.product_ean13,
    ps_orders.current_state, 
    ps_order_detail.product_id,
    ps_order_detail.product_quantity,
    ps_order_detail.total_price_tax_incl,
    ps_order_detail.reduction_amount,
    ps_order_detail.id_tax_rules_group,
    ps_orders.current_state  

    FROM ps_orders 
    JOIN ps_order_detail 
    ON ps_orders.id_order = ps_order_detail.id_order 
    JOIN ps_address 
    ON ps_orders.id_customer = ps_address.id_customer
    JOIN ps_customer
    ON ps_customer.id_customer = ps_orders.id_customer
    ORDER BY id_order_detail DESC
    ";
   

    $dbh = ConBdPresta();

    foreach($dbh->query($sql) as $row1) {
        #print_r($row1);  //affiche toutes les infos en vrac
        web_command($row1);  # /func/Kezia_func.php
    }

    

} catch (PDOException $e) 
{
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
}
?>

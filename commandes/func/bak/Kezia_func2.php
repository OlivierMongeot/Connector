<?php


function select_webcommande2($id) 
{
   

   
    #$tbl_1 = "web_commande";
    #$tbl_2 = "ps_customer";
    #$tbl_3 = "ps_order_details";
    #$id = '1';

 # 1 SELECTION ET LECTURE DES 3 TABLES PRESTA DE 
# ps_orders  # ps_order_detail # ps_address 

try {
    $sql = "
    SELECT
    ps_order_detail.id_order_detail,
    ps_orders.id_carrier,
    ps_address.address1,
    ps_address.address2,
    ps_address.postcode,
    ps_address.city,
    ps_address.id_country,
    ps_orders.date_add,
    ps_orders.total_shipping_tax_incl,
    ps_orders.payment,
    ps_order_detail.product_ean13,
    ps_orders.current_state 
    
    FROM ps_orders 
    
    JOIN ps_order_detail 
    ON ps_orders.id_order = ps_order_detail.id_order 
    
    JOIN ps_address 
    ON ps_orders.id_customer = ps_address.id_customer
    
    WHERE id_order_detail = 1
    ";
    
    $con = ConBdPresta();
    
    
    $stmt = $con->query($sql);
    
    $row1 = $stmt->fetchAll();
    print_r($row1);
    #if (!empty($row1)) {
     #   return $row1[0];
    #}



    #foreach($dbh->query($sql) as $row1) {
        #print_r($row1);  //affiche toutes les infos en vrac
        
     #   return $row1[0];
        #web_command($row1);


      #      }


} catch (PDOException $e) 
{
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
}
?>
<?php

include 'check_id.php';

#$id_presta = '1';


function synchro($id_presta) # a verif 
{

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
    
    WHERE id_order_detail = '$id_presta'
    ";
    
    $con = ConBdPresta();
       
    $stmt = $con->query($sql);
    
    $row1 = $stmt->fetchAll();
    
    #print_r($row1);
    #web_command($row1);
    echo '</br>';

    #insert where 
    echo '<div id="container">Insertion de :';
    echo '</br>';
    $id_od = $row1[0]['id_order_detail'];
    echo  $id_od;
    echo '</br>';
    $id_ca = $row1[0]['id_carrier'];
    echo  $id_ca;
    echo '</br>';
    $id_a1 = $row1[0]['address1'];
    echo  $id_a1;
    echo '</br>';
    $id_a2 = $row1[0]['address2'];
    echo  $id_a2;
    echo '</br>';
    $id_po = $row1[0]['postcode'];
    echo  $id_po;
    echo '</br>';
    $id_cy = $row1[0]['city'];
    echo  $id_cy;
    echo '</br>';
    $id_co =$row1[0]['id_country'];
    echo  $id_co;
    echo '</br>';
    $id_da =$row1[0]['date_add'];   //int 8 transfo en int 22
    echo  $id_da;
    echo '</br>';
    $id_ts =$row1[0]['total_shipping_tax_incl'];
    echo  $id_ts;
    echo '</br>';
    $id_pa =$row1[0]['payment'];   // int transfo en string  
    echo  $id_pa;
    echo '</br>';
    $id_ea =$row1[0]['product_ean13'];
    echo  $id_ea;
    echo '</br>';
    $id_st =$row1[0]['current_state'];
    echo  $id_st;
    echo '</br></div>';


   $sql = "
   INSERT INTO
   web_commande (
   CODE_WEB,
   LIV,
   ADR1,
   ADR2,
   CP,
   VILLE,
   PAYS,
   DATECDE,
   PORT,
   MODE_DE_REGLEMENT,
   NOTA, TRAITE
   )
   VALUES (
   '$id_od',
   '$id_ca',
   '$id_a1',
   '$id_a2',
   '$id_po',
   '$id_cy',
   '$id_co',
   '$id_da',
   '$id_ts',
   '$id_pa',
   '$id_ea',
   '$id_st'
    )"; 
       
    $conn = ConBdTampon();        
    // use exec() because no results are returned
    $conn->exec($sql);

    }

                catch (PDOException $e) 

            {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }
}

?>

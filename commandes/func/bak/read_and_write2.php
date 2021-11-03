<?php

include 'check_id2.php';


function synchro2($id_presta) # a verif 
{
#  SELECTION ET LECTURE DES  TABLES PRESTA DE 
# Pour avoir :
# NO_WEB =    ps_order_detail.id_order_detail,
# IDART =     ps_order_detail.id_product,  
# Q_CDE =     ps_order_detail.product_quantity
# PRIX_TTC    ps_order_detail.total_price_tax_incl
# REMISE      ps_order_detail.reduction_amount
# TAUXTVA     ps_order_detail.id_tax_rules_group
#      0 = SANS TVA
#      1 = 20 %
#      2 = 10 % 
#      3 = 5.5 %
#      4 = 2.5 %
#      5 = EU TVA Virtual Product 
# TRAITE   ps_orders.current_state      
# a paster dans web_li_cde

try {
    $sql = "
    SELECT
    ps_order_detail.id_order_detail, # pas bon prendre ID de web_commande
    ps_order_detail.product_id,
    ps_order_detail.product_quantity,
    ps_order_detail.total_price_tax_incl,
    ps_order_detail.reduction_amount,
    ps_order_detail.id_tax_rules_group,
    ps_orders.current_state  
    
    FROM ps_order_detail
    
    JOIN ps_orders
    ON ps_orders.id_order = ps_order_detail.id_order 
        
    WHERE id_order_detail = '$id_presta'
    ";
    
    $con = ConBdPresta();
       
    $stmt = $con->query($sql);
    
    $row1 = $stmt->fetchAll();
    
    #print_r($row1);
    #web_command($row1);
    echo '</br>';


# selection de NO_web de web_commande pour qu'il corrsponde au no_web de web_cl_cmd
 /*   echo $id_presta;

    $sql6 = "
    SELECT NO_WEB
    FROM web_commande
    WHERE CODE_WEB = '$id_presta'
    ";

    $con = ConBdTampon();

    $req = $con->query($sql6);

    $result_Id = $req->fetch();
 
    $id_noweb =  $result_Id[0];  */
#############################################
 
       
##########################################   
      #insert where 
    echo '<div id="container">Insertion de :';
    echo '</br>';
    # insere NO_WEB 
    $id_od = $id_noweb;
    echo  $id_od;

    echo '</br>';
    $id_po = $row1[0]['product_id'];
    echo  $id_po;
    echo '</br>';
    
    $id_qu = $row1[0]['product_quantity'];
    echo  $id_qu;
    echo '</br>';
    
    $id_tp = $row1[0]['total_price_tax_incl'];
    echo  $id_tp;
    echo '</br>';
    
    $id_ra = $row1[0]['reduction_amount'];
    echo  $id_ra;
    echo '</br>';
    
    $id_tx = $row1[0]['id_tax_rules_group'];
    echo  $id_tx;
    echo '</br>';
    
    $id_cs = $row1[0]['current_state'];
    echo  $id_cs;
    echo '</br></div>';

# Pour ecriture sur  Table: web_li_cde
   $sql = "
   INSERT INTO
   web_li_cde 
   (
   NO_WEB,
   IDART,
   Q_CDE,
   PRIX_TTC,
   REMISE,
   TAUXTVA,
   TRAITE
   )
   VALUES (
   '$id_od',
   '$id_po',
   '$id_qu',
   '$id_tp',
   '$id_ra',
   '$id_tx',
   '$id_cs'
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

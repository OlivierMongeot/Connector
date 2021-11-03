
<?php


function update_old_commande($id_kez_check)
{
     echo 'Mise à jour individuelles des infos table';

     #comparaison des tables sur l'id en cours 
  
     # lecture dans un tableau de row_to_update
    $sql_up="
    SELECT 
    #web_commande.NO_WEB,
    web_commande.CODE_WEB,
    web_commande.LIV,
    web_commande.ADR1,
    web_commande.ADR2,
    web_commande.CP,
    web_commande.VILLE,
    web_commande.PAYS,
    web_commande.DATECDE,
    web_commande.PORT,
    web_commande.MODE_DE_REGLEMENT,
    web_commande.NOTA,
    web_commande.TRAITE,
    #web_li_cde.NO_WEB,
    web_li_cde.IDART,
    web_li_cde.Q_CDE,
    web_li_cde.PRIX_TTC,
    web_li_cde.REMISE,
    web_li_cde.TAUXTVA,
    web_li_cde.TRAITE
       FROM web_commande 
       JOIN web_li_cde 
       ON web_commande.NO_WEB = web_li_cde.NO_WEB 
       WHERE CODE_WEB = '$id_kez_check'
";


    $con = ConBdTampon();
    $stmt_tamp = $con->query($sql_up);
    $row2 = $stmt_tamp->fetchAll();

   ##$id_1 = $row1[0]['NO_WEB'];
   # lecture dans un tableau de row de presta 
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
    WHERE id_order_detail = '$id_presta'
    ";


    $con = ConBdPresta();
    $stmt_kez = $con->query($sql);
    $row3 = $stmt_kez->fetchAll();


for ($i=0; $i <19 ; $i++) { 

if ($row3[0] == $row2[0]){
      echo "ROW ".$id_presta." est OK";
    } else {
      echo 'Update à faire';
    }
}
############
}
?>
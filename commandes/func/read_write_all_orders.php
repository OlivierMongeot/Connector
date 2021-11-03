<?php
include 'Kezia_BDD.php';



start_synchro_order();



function start_synchro_order()
{

     # Calcul id_max_presta = nombre d'id a traiter
      $req_id_max_presta = "
          SELECT MAX(id_order_detail)
          FROM ps_order_detail
          ";

          $con3 = ConBdPresta();
          $stmt3 = $con3->query($req_id_max_presta);
          $result3 = $stmt3->fetch();
          $id_max_presta = $result3[0];
          echo '</br>';
          echo 'Nombre ID à vérifier =';
          echo $id_max_presta;
          echo '</br>';



  for ($ii=1; $ii<=($id_max_presta+1); $ii++) 
      {
        check_id_prest($ii);
      }


}






function check_id_prest($id_to_check)
{
     # debut boucle verif 

        $req_id_presta = "
        SELECT id_order_detail
        FROM ps_order_detail
        WHERE id_order_detail ='$id_to_check'
        ";

        $con = ConBdPresta();
        $stmt = $con->query($req_id_presta);
        $result = $stmt->fetch();
        $id_checked = $result[0];
        echo '</br>';

                if ($id_checked == $id_to_check )
                {

                echo "ID ". $id_to_check . " existante sur Presta alors voir si présente sur Kezia -> ";
                echo '</br>';
                check_id_kez($id_to_check);  # fct plus bas 
                }

                if ($id_checked != $id_to_check)
                {
                echo "Non synchro ID ". $id_to_check . " car inexistante "; 
                # suite à un effacement de commandes  des ID peuvent etre effacée et ne sont pas à traiter 
                #echo '</br>';
                }
}

 

function check_id_kez($id_kez_check)
{


        # debut boucle verif 
        $req_id_kez = "
        SELECT CODE_WEB 
        FROM web_commande
        WHERE CODE_WEB ='$id_kez_check'
        ";
        $con = ConBdTampon();

        $stmt = $con->query($req_id_kez);

        $result = $stmt->fetch();

        $id_kez_checked = $result[0];

        echo 'ID KEZIA checké numéro : '. $id_kez_check . ' est egale à : ' ;
        echo $id_kez_checked;
        echo '</br>';

        //$trigger_update = false;

         if ($id_kez_checked == $id_kez_check)

                {
                 echo'<div id="container4">ID tampon '. $id_kez_check . ' dèja existante alors rien, on passe au check suivant </div>';
                 echo '</br>'; 
                         // if ($trigger_update == true )
                         // {
                         //  update_old_commande($id_kez_check);
                         //  echo 'Update a faire';
                         // }
                }
                else 
                {
                echo '<div id="container4">!!!!  ID tampon inexistante !!! Synchro de cette id : </div>';
                echo  $id_kez_check;
                echo '</br>';
                # lancer la syncro de l'id en cours 
                synchro($id_kez_check);
                }

}





function synchro($id_presta) # a verif 
{

    # 1 SELECTION ET LECTURE DES 3 TABLES PRESTA DE 
          # ps_orders  # ps_order_detail # ps_address 


          try {
              $sql = "SELECT
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
          $stmt = $con->query($sql);
          $row1 = $stmt->fetchAll();

          echo '</br>';

          echo '<div id="container">Pré insertion de :';
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
          $id_co = $row1[0]['id_country'];
          echo  $id_co;
          echo '</br>';
          $id_da = $row1[0]['date_add'];   //int 8 transfo en int 22

          # 2019-10-08  00:56:55
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
          echo '</br>';  

          #####  Partie web_li_cde
          echo 'Insertion dans web_li_cde de :';
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

          #### insertion dans 1 ere table KEZIA 
          $sql2 = "
         INSERT INTO
         WEB_COMMANDE (
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
         NOTA,
         TRAITE
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
             
          $con = ConBdTampon();        
          // use exec() because no results are returned
          $con->exec($sql);
          echo "Insertion OK sur web_commande";
          echo '</br>';


      //Recupération de l'id de NO_WEB
          
           $sql_noweb ="
              SELECT NO_WEB 
              FROM web_commande
              where CODE_WEB = $id_presta
              ";
              $con = ConBdTampon();

              $req_id = $con->query($sql_noweb);

              $result_Id = $req_id->fetch();
               
              $id_noweb =  $result_Id[0];
              echo "Recupération de l'id de NO_WEB ";
              echo '</br>';
              # Insertion sur  Table: web_licde



      // 2EME INSERTION 
         $sql2 = "
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
         '$id_noweb', ### a traiter 
         '$id_po',
         '$id_qu',
         '$id_tp',
         '$id_ra',
         '$id_tx',
         '$id_cs'
         )"; 
             
          $con = ConBdTampon();        
          
          // use exec() because no results are returned
          $con->exec($sql2);
          echo "Insertion OK sur  Table: web_li_cde avec NO_WEB = ".$id_noweb;
          echo '</br>';
    }

     catch (PDOException $e) 

        {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();

        }
}






?>
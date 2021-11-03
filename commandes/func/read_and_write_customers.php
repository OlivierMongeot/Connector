<?php


ini_set('display_errors','on');
include '../../../connection/function/Kezia_BDD.php';
start_check_client();



function start_check_client()
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


## boucle de check 
for ($ii=1; $ii<=($id_max_presta+1); $ii++) {
     check_id_prest($ii);
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
            echo 'ID presta checké numéro : '. $id_to_check . ' est égale à : ' ;
            echo $id_checked;
            echo '</br>';

                if ($id_checked == $id_to_check )
                {

                echo "Donc ID commande existante sur Presta alors voir aussi si présente sur web_client de Kezia -> Etape suivante ";
                echo '</br>';
                check_id_kez($id_to_check);  # fct plus bas 
                }

                if ($id_checked != $id_to_check)
                {
                echo "Stop de la pre-synchro des client car id Presta inexistant : STOP synchro de cet id"; 
                # suite à un effacement de commandes  des ID peuvent etre effacée et ne sont pas à traiter 
                echo '</br>';
                }
}

 

function check_id_kez($id_kez_check)
{


        # debut boucle verif 
        $req_id_kez = "
        SELECT CODE_WEB 
        FROM web_client
        WHERE CODE_WEB ='$id_kez_check'
        ";
        $con2 = ConBdTampon();

        $stmt2 = $con2->query($req_id_kez);

        $result2 = $stmt2->fetch();

        $id_kez_checked = $result2[0];

        echo 'ID KEZIA de web_client checké numéro : '. $id_kez_check . ' est egale à : ' ;
        echo $id_kez_checked;
        echo '</br>';

         if ($id_kez_checked == $id_kez_check)

                {
                    echo"ID de web_client  déja existante alors rien, on passe au check suivant";
                    echo '</br>'; 
                    echo '</br>';
                }
                else 
                {
                echo "!!!!  ID tampon inexistante !!! Synchro de cette id : ";
                echo  $id_kez_check;
                echo '</br>';
                # lancer la syncro de l'id en cours 
                synchro_c($id_kez_check);
                }

}



function synchro_c($id_presta) # a verif 
{

# 1 SELECTION ET LECTURE DES TABLES PRESTA DE #ps_address 
 #  ps_customers et ps_orders  
 # CODE_WEB = id_order_detail de ps_order_detail
#  NOMCLI = lastname de ps_address
#  ADR1 = address1  de ps_address
 #  ADR2 = address2  de ps_address
 #  CP =  postcode  de ps_address 
 #  VILLE = city  de ps_address
 #  PAYS =  id_country  de ps_address
 #  TELPERSO = phone  de ps_address
 #  TEL PRO : YA PAS   
 #  GSM = phone_mobile  de ps_address
 #  EMAIL = email de ps_customer
 #  DATECREATION =  date_add de ps_orders
 #  TRAITE =  current_state de ps_orders  

try {
    $sql = "
    SELECT
      ps_order_detail.id_order_detail,  
      ps_address.lastname, 
      ps_address.address1,
      ps_address.address2,
      ps_address.postcode,
      ps_address.city,
      ps_address.id_country,
      ps_address.phone,
      ps_address.phone_mobile,
      ps_customer.email,
      ps_orders.date_add,
      ps_orders.current_state

    FROM ps_address 
           
    JOIN ps_orders 
    ON ps_orders.id_customer = ps_address.id_customer
    
    JOIN ps_customer
    ON ps_customer.id_customer = ps_address.id_customer
    
    JOIN ps_order_detail
    ON ps_order_detail.id_order = ps_orders.id_order

    WHERE id_order_detail = '$id_presta'
    ";
    
    $con = ConBdPresta();
       
    $stmt = $con->query($sql);
    
    $row1 = $stmt->fetchAll();
    
    #print_r($row1);
    #web_command($row1);
    echo '</br>';

    #insert where 
    echo '<div id="container">Insertion dans web_client de :';
    echo '</br>';
    $id_od = $row1[0]['id_order_detail'];
    echo  $id_od; echo '</br>';
    
    $id_ln = $row1[0]['lastname'];
    echo  $id_ln; echo '</br>';
    
    $id_a1 = $row1[0]['address1'];
    echo  $id_a1; echo '</br>';
    
    $id_a2 = $row1[0]['address2'];
    echo  $id_a2; echo '</br>';
    
    $id_po = $row1[0]['postcode'];
    echo  $id_po; echo '</br>';
    
    $id_cy = $row1[0]['city'];
    echo  $id_cy; echo '</br>';
    
    $id_co =$row1[0]['id_country'];
    echo  $id_co; echo '</br>';

    $id_ph =$row1[0]['phone'];   //int 8 transfo en int 22
    echo  $id_ph; echo '</br>';
    
    $id_phm =$row1[0]['phone_mobile'];
    echo  $id_phm;
    echo '</br>';
    $id_mai =$row1[0]['email'];   // int transfo en string  
    echo  $id_mai;
    echo '</br>';
    $id_ea =$row1[0]['date_add'];
    echo  $id_ea;
    echo '</br>';
    $id_st =$row1[0]['current_state'];
    echo  $id_st;
    echo '</br></div>';
   $sql = "
   INSERT INTO
   web_client (
   CODE_WEB, NOMCLI, ADR1, ADR2, CP, VILLE, PAYS, TELPERSO, GSM, EMAIL, DATECREATION, TRAITE
   )
   VALUES (
   '$id_od',
   '$id_ln',
   '$id_a1',
   '$id_a2',
   '$id_po',
   '$id_cy',
   '$id_co',
   '$id_ph',
   '$id_phm',
   '$id_mai',
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
}


<?php

include 'Kezia_BDD.php';

    #Si id de presta = true (id_order_detail) 

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

?>
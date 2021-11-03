
<?php

include 'Kezia_func.php';

  
 # Calcul id_max_presta pour voir jusque ou on synchronise 
$req_id_max_presta = "
        SELECT MAX(id_order_detail)
        FROM ps_order_detail
        ";

        $con4 = ConBdPresta();

        $stmt4 = $con4->query($req_id_max_presta);

        $result4 = $stmt4->fetch();

        $id_max_presta2 = $result4[0];
        echo '</br>';
        echo 'ID PRESTA MAX =';
        echo $id_max_presta2;
        echo '</br>';



for ($ii=1; $ii<=($id_max_presta2+1); $ii++) {
     check_id_prest2($ii);    # fonc plus bas 
    }

#

function check_id_prest2($id_to_check)
{
    #$id_to_check = 7; # debut boucle verif 
        $req_id_presta ="SELECT id_order_detail
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

                echo "Donc ID presta existante alors étape voir si présente sur BDD web_li_cde de Kezia";
                echo '</br>';
                check_id_kez2($id_to_check);
                }

                if ($id_checked != $id_to_check )
                {
                echo 'Stop de la pre-synchro car ID presta inexistant'; 
                echo '</br>';
                }
}

 

function check_id_kez2($id_kez_check)
{
        #$id_kez_to_check = 1; # debut boucle verif 
        $req_id_kez = "
        SELECT NO_WEB 
        FROM web_li_cde
        WHERE NO_WEB ='$id_kez_check'
        ";
        $con2 = ConBdTampon();

        $stmt2 = $con2->query($req_id_kez);

        $result2 = $stmt2->fetch();

        $id_kez_checked = $result2[0];

        echo 'Id de NO_WEB de web_li_cde de KEZIA checké numéro : '. $id_kez_check . ' est egale à : ' ;  ### probleme ici  
        echo $id_kez_checked;
        echo '</br>';

         if ($id_kez_checked == $id_kez_check)

                {
                    echo"ID tampon dèja existante alors rien, on passe au check suivant";
     
                    echo '</br>';
                    echo '</br>';


                }
                else 
                {
                echo "!!!!  ID tampon inexistante !!! Pre - Synchro de cette id OK : ";  
                # mais voir si id NO_WEB deja ex 
                # si non deja existante existante
                #si NO_WEB.web_li_cde = NO_WEB.web_commande




                echo  $id_kez_check;
                echo '</br>';


                synchro2($id_kez_check);
                # lancer la syncro 
                }

}

?>
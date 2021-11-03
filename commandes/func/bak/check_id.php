
<?php

include 'Kezia_BDD.php';


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

?>
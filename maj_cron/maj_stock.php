<html><head><title>MAJ STOCK</title></head><body>
<!-- ultimate -->
<?php
#!/usr/bin/php
ini_set('display_errors','on');


//include '../function/create_full.php';


maj_all_stock();

function maj_all_stock()
{
$parcour_id = 'SELECT IDART FROM WEB_ARTICLE ';
$con = ConBdTampon();

//echo '<h2>LISTE DES ARTICLES KEZIA A SYNCHRO / STOCK:</h2>';
 	foreach($con->query($parcour_id) as $parcour)
 	{
 			echo '</br>';
 			echo '</br>';

 	$id_article = $parcour['IDART'];	
	check_stock ($id_article);
  //echo $id_article; 
		
 	}

}

// rentrer ID ART KEZIA ET PAS ID PRESTA 
//check_stock(169);


function check_stock($id_art_kez)

{
	echo 'ID ART KEZIA A CHECKER: ';
	echo $id_art_kez;
	echo '</br>';
    $con = ConBdTampon();

	$stock_kezia =" SELECT * FROM WEB_ARTICLE WHERE IDART = '$id_art_kez'";

	 $stmt = $con->query($stock_kezia);
	 $row = $stmt->fetch();
	 $stock_kezia = $row['stock'];
	 //echo'STOCK KEZIA DE CET ID : ';
	 //echo $stock_kezia;
	 //echo '</br>';
	 //$id_art_recup = $row['IDART'];
	 //echo 'IDART : ';
	 //echo $id_art_recup;
	 //echo '</br>';
	 

	//echo 'Recuperation de l\'id_prod_attrib associer à cet article sur  Presta  : ';
 	$con2 = ConBdPresta();
 	$id_prod_attr_correspondante = "SELECT id_product_attribute FROM ps_product_attribute WHERE reference = '$id_art_kez'";
 	$stmt2 = $con2->query($id_prod_attr_correspondante);
 	$row2 = $stmt2->fetch();
 	$id_pro_att = $row2[0];
		 	if ($id_pro_att > 0)
		 	{
		 		//echo '</br>';
		 		//echo 'Id_prod_attr du Produit existant presta : ';

		 	}
		 	else 
		 	{
		 		echo '</br>';
		 		echo 'Pas de produit trouvé correspondant sur presta  : STOP ';
		 		return; 
		 	}
		 	//echo $id_pro_att;
		 	//echo '</br>';


 //echo 'Recuperation du Stock Presta de cette référence : ';
 //$con2 = ConBdPresta();
 	$stock_presta = "SELECT * FROM ps_stock_available WHERE id_product_attribute  = $id_pro_att";
 	$stmt3 = $con2->query($stock_presta);
 	$row3 = $stmt3->fetch();
 	$stock_p = $row3['physical_quantity'];
 	//echo $stock_p;

 	//echo '</br>';
 	//echo 'ID_Product concerné : ';
 	$id_prod = $row3['id_product'];
 	//echo $id_prod;
 	//echo '</br>';

 	if ($stock_p == $stock_kezia){
 		echo 'STOCK EGALE, on passe à la reference suivante';
 		return;

 	}
 	else 
 	{
 		echo 'Différence trouvée : ';
 		$dif_stock = $stock_kezia - $stock_p;
 		echo $dif_stock;
 		echo '</br>';

 		if($dif_stock > 0 )
 		{
 			echo'Stock Kezia > Stock Presta';
 				echo '</br>';
 			echo' Ajouter '.$dif_stock.' dans Prestashop';
      echo '</br>';
      echo 'Dans l\'attribut';
			// ecriture du stock sur l'attribut concerné
 			//echo $id_pro_att;

 			echo 'Update du stock Presta';

 			update_stock($id_pro_att, $stock_kezia);


 		}
 		else if($dif_stock < 0)
 		{
 			echo'Stock Presta > Stock Kezia';
 				echo '</br>';
 			echo' Retirer '.$dif_stock.' dans Prestashop';

 			// ecriture du stock sur l'attribut concerné
 			echo $id_pro_att;
 			   echo '</br>';

 			echo 'Stock à ecrire';   
 			echo $stock_kezia;
 			   echo '</br>';

 			update_stock($id_pro_att, $stock_kezia);

 		}
    else  {
      echo 'NE RIEN FAIRE';
    }
 	}
}


function update_stock ( $id_prod_attrib , $stock_kezia)
{

	$con = ConBdPresta();
	$req_upd = "UPDATE ps_stock_available SET physical_quantity = '$stock_kezia' WHERE id_product_attribute = '$id_prod_attrib' AND id_product_attribute != 0 ";

 	$stmt = $con->query($req_upd); 
       echo 'Physical Stock Updated';
       echo '</br>';

    $check_reserve = "SELECT reserved_quantity , id_product FROM ps_stock_available WHERE id_product_attribute  = '$id_prod_attrib'";
 	$stmt4 = $con->query($check_reserve);
 	$row4 = $stmt4->fetch();
 	$reserve = $row4['reserved_quantity'];
 	echo 'Réserve = '; 
 	echo $reserve;
 	echo '</br>';
 	echo 'ID_Product concerné : ';
 	$id_prod = $row4['id_product'];

 	if ($reserve > 0 )
 	{
 		$stock_dispo = $stock_kezia - $reserve;
 		$req_upd_stock_available = "UPDATE ps_stock_available SET quantity = '$stock_dispo' WHERE id_product_attribute = '$id_prod_attrib' AND id_product_attribute != 0 ";
 		$stmt2 = $con->query($req_upd_stock_available); 
       echo 'Stock Available Updated';
       echo '</br>';

 	}
 	else
 	{
 		$stock_dispo = $stock_kezia;
 		$req_upd_stock_available = "UPDATE ps_stock_available SET quantity = '$stock_dispo' WHERE id_product_attribute = '$id_prod_attrib' AND id_product_attribute != 0 ";
 		$stmt2 = $con->query($req_upd_stock_available); 
       echo 'Stock Available Updated';
       echo '</br>';
 	}
 	update_sum_stock( $id_prod );
}


function update_sum_stock( $id_pro )
{
  	

  		// I Somme des stock physique de l'id 
        $con = ConBdPresta();
        $sum = " SELECT SUM( physical_quantity )
                 FROM ps_stock_available
                 WHERE id_product = '$id_pro' AND id_product_attribute != 0 ";
	    $stmt = $con->query($sum);
        $row12 = $stmt->fetch();
        $sum_stock =$row12[0];
        echo '</br>';
        echo 'Total des stocks Physique du produit  = ';
        echo $sum_stock;
        echo '</br>';
        //ecriture du stock total physique 
        $write_sum = " UPDATE ps_stock_available SET physical_quantity = '$sum_stock' WHERE id_product = '$id_pro' AND id_product_attribute = 0 "; 
        $stmt2 = $con->query($write_sum);
      
   

        // II recherche de la somme des stock
        //somme des stock physique de l'id 
        //$con = ConBdPresta();
        $sum_dispo_req = " SELECT SUM( quantity )
                 FROM ps_stock_available
                 WHERE id_product = '$id_pro' AND id_product_attribute != 0 ";
                 
        $stmt3 = $con->query($sum_dispo_req);
        $row13 = $stmt3->fetch();
        
        $sum_stock_dispo =$row13[0];
    		echo 'Total des	stocks disponible du produit  = ';
        echo $sum_stock_dispo;
        echo '</br>';

        //ecriture du stock total 
        $write_sum = " UPDATE ps_stock_available SET quantity = '$sum_stock_dispo' WHERE id_product = '$id_pro' AND id_product_attribute = 0 "; 

        $stmt4 = $con->query($write_sum);

}




function ConBdPresta()
{
  try 
    {
          $servername = "localhost";
          $user1 = "root";
          $pass = "";
          $db_name = "prestashop_og";

        $pdo = new PDO("mysql:host=$servername;dbname=$db_name;charset=utf8", $user1, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      



        return $pdo;
    }   
  catch (PDOException $e) 
    {
      print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}


function ConBdTampon()
{
  try 
    {
          $servername = "localhost";
          #$servername = "91.216.107.164";
          $user1 = "root";
          #$user1 = "custo1230104";
		//   $pass = "AbpH6Mv5F6cQe";
		  $pass = "";
          #$pass = "hp6i6lzgtr";
          $db_name = "tampon3";
          #$db_name = "custo1230104"; 
      
        $pdo = new PDO("mysql:host=$servername;dbname=$db_name;charset=utf8", $user1, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }   

  catch (PDOException $e) 
    {
      print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

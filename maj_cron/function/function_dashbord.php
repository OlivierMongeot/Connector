<?php



function count_img ($id_prod)
{
$con = ConBdPresta();
$sql = "SELECT COUNT(*) FROM ps_image WHERE id_product = '$id_prod'";

        $stmt = $con->query($sql);
                      $row = $stmt->fetch();
                      $tot = $row[0];
//echo 'TOTAL IMAGE :';
//echo $tot;
//echo '<br />';
return $tot;
                  
}

function count_prod_one_image()
{
    $sql = "SELECT * FROM ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product";
    $con = ConBdPresta();
   
  foreach($con->query($sql) as $row)
                 {
                // echo 'ID PROD';
                  $id_prod = $row['id_product'];
                  $name = $row['name'];
                  $counter = count_img ($id_prod);
                  //echo '<br />';
                //echo $counter;
                 
                 if ($counter == 1)
                      {

                    search_google_image($id_prod);  
                    echo ' ID ';
                    echo  $id_prod;
                    echo ' : ';
                    echo $name;
                    echo '<br />';
                    desactive_prod( $id_prod, 0 );

                    
                      }

                 }
               
}

function counter_prod_one_image()
{
    $sql = "SELECT * FROM ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product";
    $con = ConBdPresta();
    $n = 0;
  foreach($con->query($sql) as $row)
                 {
                // echo 'ID PROD';
                  $id_prod = $row['id_product'];
                 $counter = count_img ($id_prod);
                  //echo '<br />';
                //echo $counter;
                 
                 if ($counter == 1)
                      {
                       $n++;
                      }

                 }
                 return $n;
}

function counter_prod_id_two()
{
    $con = ConBdTampon();
    $counter = "SELECT COUNT(*) FROM WEB_ARTICLE WHERE id_synchro = 2 "; 
    $stmt = $con->query($counter);
    $row = $stmt->fetch();
    $number_to_up = $row[0];
    return $number_to_up;

}




function is_there_an_image($id_prod)
{
	
	$nbr = 0;
	$con = ConBdPresta();
	
	$req_image = " SELECT id_image FROM ps_image WHERE id_product = '$id_prod' ";
	$stm = $con->query($req_image);

    $row = $stm->fetch();
    
    $id_image = $row['id_image'];
 
    if ($id_image <= 0 )
    {
 	  echo 'Product Presta ID : ';
 		echo $id_prod;
    	echo '<strong> Image Absente </strong>';
    	echo '</br>';
    	$nbr = $nbr + 1; 
    }
    
	//    echo $nbr;

}



function list_image ()
{


		$con = ConBdPresta();
			$req_photo = "SELECT id_product FROM ps_product ORDER BY id_product ASC";



		 foreach($con->query($req_photo) as $id_prod)
		 {
	
		 	//echo '</br>';
		 	//echo 'ID PRODUIT PRESTASHOP : ';
		 	$id = $id_prod[0];
		 	//echo $id;
		 	//echo '</br>';

		 	is_there_an_image($id);

		 }
}





function num_san_image ()
{

	$con = ConBdPresta();
$tot_avec_image = "SELECT DISTINCT COUNT(*)
FROM ps_product
WHERE EXISTS (
              SELECT *
              FROM ps_image
              WHERE ps_product.id_product = ps_image.id_product
              AND   ps_product.id_product = ps_image.id_product )";  
              $stmt = $con->query($tot_avec_image);
    $row = $stmt->fetch();
    $tot = $row[0];
 	$tot_produit = "SELECT COUNT(*) FROM ps_product";
       $stmt2 = $con->query($tot_produit);
    $row2 = $stmt2->fetch();
    $tot2 = $row2[0];
  	$t = $tot2-$tot ;
	return $t;
}


function count_prod_desactivate()
{
	$con =	ConBdPresta();
	 $counter = " 
    SELECT COUNT(*) FROM ps_product WHERE active = 0
    "; 
    $stmt = $con->query($counter);
    $row = $stmt->fetch();
    $number = $row[0];
    return $number;
}
           

function counter_prod_sans_describ()
{
	$con = ConBdPresta();

    $counter = " 
    SELECT COUNT(*) FROM ps_product_lang WHERE description_short = '' OR description = '' WHERE 
    "; 
    $stmt = $con->query($counter);
    $row = $stmt->fetch();
    $number = $row[0];
    return $number;
}


function counter_prod_ean()
{

	$con = ConBdPresta();
    $counter = " 
    SELECT COUNT(*) FROM ps_product_attribute WHERE ean13 = ' '
    "; 
    $stmt = $con->query($counter);
    $row = $stmt->fetch();
    $number = $row[0];
    return $number;
}

function display_error()
{

	$con = ConBdTampon();
	$req_error = "SELECT * FROM WEB_ARTICLE WHERE id_synchro = '2' ORDER BY IDART";

 foreach($con->query($req_error) as $list_error)
 {
 	echo '</br>';
		echo 'REFERENCE KEZIA : ';
		$id_art = $list_error['IDART'];
		echo $id_art;
		echo '</br>';

		echo '<h4>';
		$id_arti = $list_error['DESIGNATION'];
		echo $id_arti;
		echo '</h4>';
		//var_dump($list_error);
	
		


		$rayon = $list_error['IDRAY'];
		if ($rayon <= 0 )
		{
				echo 'Manque le Rayon';
				echo '</br>';
		}
		else
		{
			//echo 'Rayon OK = ';
			//echo $rayon;
			//echo '</br>';
		}


		$famille = $list_error['IDFAM'];
		if ($famille <= 0 )
		{
				echo 'Manque la famille';
				echo '</br>';
		}
		else
		{
			//echo 'Famille OK : ';
			//echo $famille;
			//echo '</br>';
		}



		$taille = $list_error['IDTAILLE'];
		$rayon = $list_error['IDRAY'];

		if ($rayon == 2)
		{
			if ($taille <= 0 )
		{
			//	echo 'Taille OK car access';
			//	echo '</br>';
		}


		}

		if ($rayon != 2)
		{
			if ($taille <= 0 )
		{
				echo 'Manque la Taille ';
				echo '</br>';
		}

		}
		
		

		
		$id_colors = $list_error['IDCOULEUR'];

		if ($id_colors <= 0 )
		{
			echo 'Manque la Couleur ';
				echo '</br>';

		}
		else 
		{
			//echo 'Couleur OK : ';
			//echo $id_colors;
			//echo '</br>';
			
		}


		if ($id_colors > 0 && $taille > 0 && $famille > 0)
		{
		//echo 'Verifier si le titre est similaire pour les produits déclinés en taille , (ajouter / devant la taille ou ne rien mettre)';
		}


		

}
}




function counter_little_image()
{

	$con = ConBdPresta();

    $counter = " 

       SELECT COUNT(*) FROM ps_product WHERE supplier_reference = '1'
    "; 


    $stmt = $con->query($counter);
    $row = $stmt->fetch();
    $number = $row[0];
    return $number;


}



function get_active_sans_descri ()
{

  $con = ConBdPresta();

  $sql = "SELECT * FROM ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product WHERE description_short = '' OR description_short IS NULL";

    foreach($con->query($sql) as $row)
                 {

	               //var_dump($row);
                 
                  $idart = $row['id_product'];
                  $name = $row['name'];
                  //$desc =  $row['description_short'];
                  search_google($name);
                  echo ' ID ';
                  echo $idart;
                   echo ' : ';
                

                  echo $name;
                  echo'<br />';
                 desactive_prod( $idart, 0 );
                 }




    }



function count_active_sans_descri()
{

  $con = ConBdPresta();
 $sql2 = "SELECT COUNT(*) FROM ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product WHERE description_short = '' OR description_short IS NULL ";

   $stmt2 = $con->query($sql2);
                      $row2 = $stmt2->fetch();
                      $tot2 = $row2[0];
                      return $tot2;
}



function count_active_sans_ean()
{

  $con = ConBdPresta();
 $sql2 = "SELECT COUNT(*) FROM ps_product_attribute INNER JOIN ps_product ON ps_product_attribute.id_product = ps_product.id_product WHERE ps_product_attribute.ean13 = '' AND ps_product.active = 1 ";

   $stmt2 = $con->query($sql2);
                      $row2 = $stmt2->fetch();
                      $tot2 = $row2[0];
                      return $tot2;
}





function get_active_sans_ean()
{

  $con = ConBdPresta();

  $sql = "SELECT * FROM ps_product_attribute INNER JOIN ps_product ON ps_product_attribute.id_product = ps_product.id_product WHERE ps_product_attribute.ean13 = '' AND ps_product.active = 1 OR ps_product_attribute.ean13 IS NULL AND ps_product.active = 1 GROUP BY ps_product.id_product DESC "  ;

    foreach($con->query($sql) as $row)
                 {

	               //var_dump($row);
                 
                  $idart = $row['id_product'];
                  $name = get_name_from_presta($idart);
                  search_google($name);
                  //$desc =  $row['description_short'];
                  echo ' ID ';
                  echo $idart;
                  echo' : ';
                  echo $name;
                  echo'<br />';
                 
                 }




    }


function get_name_from_presta($id_prod)
{
	 $con = ConBdPresta();
	$sql = " SELECT name FROM ps_product_lang WHERE id_product = '$id_prod' ";
	$stm = $con->query($sql);

    $row = $stm->fetch();
    
    $name = $row['name'];
    return $name;

}



function count_new_order()
{

  $con = ConBdPresta();
 $sql = "SELECT COUNT(*) FROM ps_orders  WHERE current_state = '11' ";

   $stmt = $con->query($sql);
                      $row = $stmt->fetch();
                      $tot = $row[0];
                      return $tot;
}

function count_order_to_check()
{

  $con = ConBdPresta();
 $sql = "SELECT COUNT(*) FROM ps_orders  WHERE current_state = '1' OR current_state = '3' OR current_state = '10' OR current_state = '14' OR current_state = '15'
 ";

   $stmt = $con->query($sql);
                      $row = $stmt->fetch();
                      $tot = $row[0];
                      return $tot;
}




?>
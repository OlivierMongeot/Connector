<?php
//header('charset=utf-8');
ini_set('display_errors','on');
header('Content-type: text/html; charset=utf-8');


select_prod_special();

// is_it_new_promo(465);





function is_it_new_promo($id_art){


$selec =  "SELECT id_product FROM ps_specific_price Where id_product = '$id_art' ";
		$con = ConBdPresta();

            $stmt = $con->query($selec);
    $row = $stmt->fetch();
    $tot = $row[0];
   
    if (isset($tot) != true)
    {
    	echo 'Nouvelle promo</br>';
    	return 0;
    }
    else 
    {
    	echo 'Promo déjà trouvée</br>';
    	return 1;
    }

	echo '</br>';

}






function select_prod_special()
{
$selec =  "SELECT DISTINCT DESIGNATION FROM WEB_ARTICLE Where PRIX_PROMO > 0 ";
$con = ConBdTampon();
foreach($con->query($selec) as $row)
				{
		  		$name = $row['DESIGNATION'];  
		  		//echo $name;
				//echo '</br>'; 
				select_id_special($name);
				//return $name;
				echo '</br>'; 
				 }

}



function select_id_special($name)
{

			$selec =  "SELECT MIN(IDART) FROM WEB_ARTICLE Where DESIGNATION = '$name' ";
			$con = ConBdTampon();
			foreach($con->query($selec) as $row)
				{
					$ref = $row[0];  
					//echo 'REF KEZIA : '; 
					//echo $ref;
					//echo '</br>'; 
					
					select_price_special($ref);
					
				 }

}



function select_price_special($ref)
{

			$selec =  "SELECT * FROM WEB_ARTICLE Where IDART = '$ref' ";
			$con = ConBdTampon();
			foreach($con->query($selec) as $row)
				{
					$name = $row['DESIGNATION'];  
					echo 'NOM : '; 
					echo $name;
					echo '</br>'; 
					$id = $row['IDART'];  
					echo 'ID KEZIA : '; 
					echo $id;
					echo '</br>'; 
					$prix = $row['PRIX_TTC'];  
					echo 'PRIX  : '; 
					echo $prix;
					echo '</br>';
					$promo = $row['PRIX_PROMO'];  
					echo 'PRIX PROMO : '; 
					echo $promo;
					echo '</br>';

					echo 'ID PRESTA : ';
					$id_art = select_id_presta_special($ref);
					
					echo $id_art;
					echo '</br>';

					echo '% DE REMISE : ';
					$reduction = (100 - (($promo * 100)/$prix))/100; 
					echo $reduction;
					echo '</br>';
					
					//update_promo_presta_layered($id_art, $promo);

					//check si nouvelle promo 
					$state = is_it_new_promo($id_art);

					//echo $state;

					if ($state == 0 )
					{

						update_promo_presta_layered ($id_art, $promo);
						// insert ps_specific_price
						echo 'INSERTION DE :';
						echo $id_art;
						echo 'Reduction :';
						echo $reduction; 
							echo '</br>';
								echo '</br>';
						insert_spe_price ($id_art ,$reduction );


					}
					else
					{
						update_promo_presta_layered ($id_art, $promo);
						// update ps_specific_price
						upd_spe_price($id_art , $reduction);
					}



				 }

}


function insert_spe_price ($id_art , $reduction )
{
	$con = ConBdPresta();
$sql = "	INSERT INTO
	 	ps_specific_price
	 	( 
`id_specific_price_rule`, 
`id_cart`, 
`id_product`,
`id_shop`,
`id_shop_group`,
`id_currency`,
`id_country`,
`id_group`,
`id_customer`,
`id_product_attribute`, 
`price`,
`from_quantity`,
`reduction`,
`reduction_tax`,
`reduction_type`,
`from`,
`to` 
)
	 	VALUES 
	 	(
	 	0, 
	 	0,
	 	'$id_art',
	 	1, 
	 	0, 
	 	0, 0, 0, 0,
	 	0, 
	 	'-1.0' ,
	 	1 ,
	 	'$reduction' ,
	 	1 , 
	 	'percentage' ,
	 	'0000-00-00 00:00:00' ,
	 	'2070-00-00 00:00:00'
	 	)";

	 	$con->exec($sql); 


}



function upd_spe_price($id_art , $reduction )
{

			$con = ConBdPresta();
			$sql = "UPDATE ps_specific_price SET reduction = '$reduction' where  id_product = '$id_art'";
			$set = $con->query($sql); // 

}







function select_id_presta_special($ref)
{

			$selec =  "SELECT id_product FROM ps_product_attribute Where reference = '$ref' ";
			$con = ConBdPresta();
			foreach($con->query($selec) as $row)
				{
					$id = $row[0];  
					
					return $id;
				 }

}



function update_promo_presta_layered ($id_art, $promo)
		{
			$con = ConBdPresta();
			$sql = "UPDATE ps_layered_price_index SET price_min = '$promo' , price_max = '$promo' where  id_product = '$id_art'";
			$set = $con->query($sql); // 

 		}








function ConBdPresta()
{
  try 
    {
          $servername = "localhost";
          $user1 = "root";
          $pass = "AbpH6Mv5F6cQe";
          $db_name = "prestashop";
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
             $user1 = "root";
               $pass = "AbpH6Mv5F6cQe";
               $db_name = "tampon";
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






				 

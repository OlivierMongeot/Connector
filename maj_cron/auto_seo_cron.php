<?php
//header('charset=utf-8');
ini_set('display_errors','on');
header('Content-type: text/html; charset=utf-8');

//include 'function/Kezia_BDD.php';
//include 'create_full.php';
//include 'function/switcher.php';
//include 'function/function_prepare.php';
//include 'create_simple_product.php';
//include 'create_declinate_product.php';
//include 'brand.php';
//include 'function/function_multi_product.php';

 $date_du_jour = date("Y-m-d H:i:s");  



/*

$select_list =  "SELECT * FROM ps_product_lang INNER JOIN ps_product ON ps_product_lang.id_product = ps_product.id_product Where description_short != '' AND active = 1 AND date_upd >  ";
$con = ConBdPresta();
	foreach($con->query($select_list) as $row)
	{
		  		 //$idart = $row['id_product'];  
		  		 //echo $idart;
				//echo '</br>'; 
				//seo_selected($idart);
				 }
*/





//chercher liste article sans seo image 

$select_seo =  "SELECT * FROM ps_product_shop Where active = 1 AND check_seo = 0 ";
	$con = ConBdPresta();
foreach($con->query($select_seo) as $row)
	{
		  		$idart = $row['id_product'];  
		  		echo $idart;
				echo '</br>'; 
				seo_selected_2($idart);
				 }



//seo_selected_2(526);


function seo_selected_2($idart)
{
		
		format_description($idart);
		format_s_description($idart);
		format_meta_describ($idart);
		get_name_images($idart);
		set_seo_bdd($idart , 1);
}




// function seo_selected($idart)
// {
// 		update_name( $idart );
// 		update_link_rewrite( $idart );
// 		write_meta_title ($idart);
	
// }







function set_seo_bdd($id_prod , $state)
{

	$con = ConBdPresta();
	$sql = "UPDATE ps_product_shop SET check_seo = '$state' WHERE id_product = '$id_prod' ";
	$req = $con->query($sql);


}




function update_name ($id_prod)
{

$req_info = " SELECT * FROM ps_product_lang WHERE id_product = '$id_prod' ";
$con = ConBdPresta();
$req = $con->query($req_info);

		$result = $req->fetch();
		echo '</br>';
		
		//var_dump($result);
		$id = $result["id_product"];
		
		echo 'ID Produit : ';
		echo $id;
		echo '</br>';

		echo 'Name : ';
		$string = $result["name"];
		//$prod_attributte = $result[0]
		echo $string;
	   	 echo '</br>';
		

	    // Filtres mots à completer ou à mettre en bdd 
		
			$string = str_replace ('BLK ' , 'BLACK ' , $string );
			$string = str_replace (' BLK' , ' BLACK' , $string );
			$string = str_replace ('/BLCK/' , '/BLACK/' , $string );
	
			$string = str_replace ('JKT ' , 'JACKET ' , $string );
			$string = str_replace (' JKT' , ' JACKET' , $string );
	
			$string = str_replace ('WHT ' , 'WHITE ' , $string );
			$string = str_replace (' WHT' , ' WHITE' , $string );
			//$string = str_replace (' WHT/' , ' WHITE/' , $string );
			$string = str_replace ('/WHT/' , '/WHITE/' , $string );	
				//$string = str_replace (' WHT/' , ' WHITE/' , $string );
					//$string = str_replace ('/WHT ' , '/WHITE ' , $string );		



	
			$string = str_replace ('TEE ' , 'TEE-SHIRT ' , $string );
			$string = str_replace ('T SHIRT ' , 'TEE-SHIRT ' , $string );
			$string = str_replace ('T-S ' , 'TEE-SHIRT ' , $string );
			$string = str_replace (' T-S' , ' TEE-SHIRT' , $string );
			
	
			$string = str_replace ('HOODI ' , 'HOODIE ' , $string );
			$string = str_replace (' HOODI' , ' HOODIE' , $string );
	
			$string = str_replace ('LONGSLEEVE ' , 'LONG SLEEVE ' , $string );
			$string = str_replace (' LONGSLEEVE' , ' LONG SLEEVE' , $string );

			$string = str_replace ('LS ' , 'L/S ' , $string );
			$string = str_replace (' LS' , ' L/S' , $string );
	
			$string = str_replace ('GRY ' , 'GREY ' , $string );
			$string = str_replace (' GRY' , ' GREY' , $string );
			$string = str_replace ('/GRY/' , '/GREY/' , $string );
			
			$string = str_replace ('CREWNCK ' , 'CREWNECK ' , $string );
			$string = str_replace (' CREWNCK' , ' CREWNECK' , $string );

			$string = str_replace (' BLU' , ' BLUE' , $string );
			$string = str_replace ('BLU ' , 'BLUE ' , $string );
			$string = str_replace ('/BLU/' , '/BLUE/' , $string );


			$string = str_replace ('/NVY/' , '/NAVY/' , $string );
			$string = str_replace (' NVY' , ' NAVY' , $string );
			$string = str_replace ('NVY ' , 'NAVY ' , $string );
	

			$string = str_replace ('/BLC/' , '/BLANC/' , $string );
			$string = str_replace (' BLC' , ' BLANC' , $string );
			$string = str_replace ('BLC ' , 'BLANC ' , $string );

			
		
		echo 'New Name : ';
		echo $string;
	   	echo '</br>';

  
				$current_name = $string;


			 set_name($id_prod , $current_name );

		
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
          #$servername = "91.216.107.164";
          $user1 = "root";
          #$user1 = "custo1230104";
          $pass = "AbpH6Mv5F6cQe";
          #$pass = "hp6i6lzgtr";
          $db_name = "tampon";
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






function set_name($id_prod , $string ){
			$con = ConBdPresta();

	   	$set_name ="UPDATE ps_product_lang SET name = '$string' WHERE id_product = '$id_prod' ";
	   			$set = $con->query($set_name); // a finir
	   			echo 'mise à jour du titre OK';
	   			 echo '</br>';

}


function get_name( $id_prod ){
			$con = ConBdPresta();

	   	$get_name ="SELECT name FROM ps_product_lang WHERE id_product = '$id_prod' ";

	   			 $stmt = $con->query($get_name);
        $row = $stmt->fetch();
        $name = $row[0];
        return $name;
}


function update_link_rewrite($id_prod)


{
	$req_info ="SELECT name FROM ps_product_lang WHERE id_product = '$id_prod' ";

	$con = ConBdPresta();


	$req = $con->query($req_info);
	$result = $req->fetch();
	//echo $result[0];
	$name = $result[0];


		echo 'NOM DE BASE : ';
		echo $name;
		echo '</br>';

		echo 'NOM RECUPERE : ';
		$name = strtolower($name);
		$name = str_replace ('/' , ' ' , $name ); 
	 	$name = str_replace( ' ' , '-' , $name);
		echo $name;
		echo '</br>';
 
	   write_rewrite_name ($id_prod , $name );

	
}




function rewriteName($rewrite)
{
    	

    	$rewrite = str_replace ('/' , ' ' , $rewrite ); 
	 	$rewrite = str_replace( ' ' , '-' , $rewrite);
 		//$rewrite = strtolower($rewrite);
 		return $rewrite;
} 






function write_rewrite_name ($id_prod , $rewrite_name )
{		
		$con = ConBdPresta();
 	$set_rewrite_name ="UPDATE ps_product_lang SET link_rewrite = '$rewrite_name' , meta_title = '$rewrite_name' WHERE id_product = '$id_prod' ";

	   		$set = $con->query($set_rewrite_name); // a finir
	   			 echo '</br>';
	   			echo 'Mise à jour du rewrite name OK';
	   			 echo '</br>';
}



function write_meta_title ($id_prod)
{		
		$con = ConBdPresta();
		//recupere la categorie avecid_prod
		$req_cat = "SELECT id_category_default FROM ps_product WHERE id_product = '$id_prod'";
		$stmt = $con->query($req_cat);
        $row = $stmt->fetch();
        $cat = $row[0];
        echo 'Categorie  :';
	    echo $cat;
       	echo '</br>';
        $name_cat = get_name_category($cat);
		$new_name = get_name( $id_prod );
        $new_meta_name = ucwords(strtolower($new_name));
        // filtre pour meilleur affichage
        $new_meta_name = str_replace ('L/s' , 'L/S' , $new_meta_name );

        $new_meta_name = $new_meta_name.' | Boutique de ' . "$name_cat". ' en ligne ' ;
        echo $new_meta_name; 
		$con = ConBdPresta();
 		$set_rewrite_name ="UPDATE ps_product_lang SET meta_title = '$new_meta_name' WHERE id_product = '$id_prod' ";

   		$set = $con->query($set_rewrite_name); // a finir
   			 echo '</br>';
	   			echo 'Mise à jour du meta title name OK';
	   			 echo '</br>';
	   			
}



function format_meta_describ ($id_prod)
{

	$con = ConBdPresta();
	$get_all ="SELECT description_short FROM ps_product_lang WHERE id_product = '$id_prod' ";

	$stmt = $con->query($get_all);
    $row = $stmt->fetch();
	$string = $row['description_short'];

	$string = preg_replace('!\s+!', ' ', $string); 
	$string = str_replace ('  ' , ' ' , $string );
	$string = str_replace ('   ' , ' ' , $string );
	$string = str_replace ('    ' , ' ' , $string );
	$string = str_replace ('     ' , ' ' , $string );
	$string = str_replace ('|' , '' , $string );

	
	$string = strip_tags($string);
	 $string = ucwords(strtolower($string));

	$long_string = strlen($string);

		if ($long_string >= 160)
		{
			echo '<br />';
			echo 'String coupe à 160 :';
			echo '<br />';
			$str = substr($string, 0 , 180);
			echo $str;
			echo '<br />';
	    }
		else
		{	
			echo '<br />';
			echo 'Pas de coupe';
			$str = $string;
			echo $str;
			echo '<br />';
	    }


	$set_meta_desc ="UPDATE ps_product_lang SET meta_description = '$str' WHERE id_product = '$id_prod' ";

	$set = $con->query($set_meta_desc); // a finir
			echo '</br>';
	        echo 'Mise à jour du meta title name OK';
			echo '</br>';


}


function get_name_images($id_prod)
{
	$con = ConBdPresta();
	$name = get_name($id_prod);

	$req_id_image = "SELECT id_image FROM ps_image WHERE id_product = '$id_prod'";

	foreach($con->query($req_id_image) as $row)
	{

		$id_image = $row['id_image'];
		echo $id_image;

		       echo '</br>';
		       write_legend($id_prod , $id_image);
	}
}

function write_legend($id_prod, $id_image) 
{
	$con = ConBdPresta();
	$name = get_name( $id_prod );
	$name = ucwords(strtolower($name));

	$write_legende = "UPDATE ps_image_lang SET legend = '$name' WHERE id_image = '$id_image' ";

	$stmt = $con->query($write_legende); 
	  echo 'Setup Legend Image OK ';
       echo '</br>';

}


function format_html_css($string)
{
echo 'STRING DE BASE :';
echo '</br>';
echo $string;
echo '</br>';

$string = str_replace ('     ' , ' ' , $string );
$string = str_replace ('    ' , ' ' , $string );
$string = str_replace ('   ' , ' ' , $string );
$string = str_replace ('  ' , ' ' , $string );
$string = str_replace ('<br />' , ' | ' , $string );
$string = str_replace ('</p>' , ' | ' , $string );
$string = str_replace ('<br>' , ' | ' , $string );
$string = str_replace ('</span>' , ' | ' , $string );
$string = strip_tags($string);
$string = preg_replace('!\s+!', ' ', $string); 

echo '</br>';
echo 'NOUVELLE STRING RECUPERE: ';
echo '</br>';
echo $string;
//
echo "Premier CAR : ";
$first_car = substr($string ,  0, 1);
echo  $first_car;
if ($first_car == ' ')
{
$string = substr($string , 0, -1);
}


echo '</br>';
echo 'Longueur : ';
$longsrt = strlen($string);
echo $longsrt;
echo '</br>';

echo 'Position : ';
$findme = '|';
$pos = strrpos($string, $findme);
echo $pos;
echo '</br>';

echo 'Décalage = ';
$decalage = $longsrt - $pos;
echo $decalage; 
echo '</br>';

if ($decalage <= 4 )
	{

	$string = substr($string , -$longsrt , -$decalage );
	echo 'STRING intermediaire : ';
	echo $string;
	echo '</br>';
	echo '</br>';
	}
	else
	{
		$string = $string;
	}

// verif si espace  devant 
	$first_car = substr($string, 0 , 1 );
	 echo '<br />';
	
	echo 'Premier Caractere = ';
	echo $first_car;
 	echo '<br />';

 	if (ctype_alpha ($first_car)) 
 	{
 	echo 'C\'est une lettre';
 	}
 	else
 	{
 		echo 'C\'est pas une lettre';
 		$string = substr( $string , 2 );
 	}
 
 echo '<br />';
	$string = addslashes($string);
    $string = preg_replace('!\s+!', ' ', $string); 
// REPLACE BREAK HTML
$string = str_replace (' | | ' , ' | ' , $string ); 
$string = str_replace (' || ' , ' | ' , $string );
$string = str_replace (' | ' , '<br />' , $string );
$string = str_replace ('<br /><br />' , '<br />' , $string );

echo '</br>';
echo 'STRING FINALE : ';
	echo '</br>';


echo $string;

return $string;

}


function format_s_description($id_prod)

{

	$con = ConBdPresta();
	$get_all ="SELECT description_short FROM ps_product_lang WHERE id_product = '$id_prod' ";
	$stmt = $con->query($get_all);
    $row = $stmt->fetch();
    $string = $row['description_short'];
	$string = format_html_css($string);

	
	$set_desc ="UPDATE ps_product_lang SET description_short = '$string' WHERE id_product = '$id_prod' ";
	$set = $con->query($set_desc);
	echo '</br>'; 
	echo '</br>';
	echo '       Mise à jour Short description OK';
	echo '</br>';

}


function format_description($id_prod)

{

	$con = ConBdPresta();
	$get_all ="SELECT * FROM ps_product_lang WHERE id_product = '$id_prod' ";
	$stmt = $con->query($get_all);
    $row = $stmt->fetch();
    $string = $row['description'];

	$string = format_html_css($string);


	$set_desc ="UPDATE ps_product_lang SET description = '$string' WHERE id_product = '$id_prod' ";
	$set = $con->query($set_desc); 
	echo '</br>';
	echo 'Mise à jour description OK';
	echo '</br>';

}





function get_date_product ($id_prod)
{
	$con = ConBdPresta();
	$sql = " SELECT date_add FROM ps_product WHERE id_product = '$id_prod' ";
	$stmt = $con->query($sql);
    $row = $stmt->fetch();
    $date = $row['date_add'];
    return $date;
}



function get_age_product($id_prod)
{
 //echo 'Date du Jour : ';
 //echo '<br />';
 $day_date = date("Y-m-d H:i:s");
 //echo $day_date;
 //echo '<br />';
 //echo '<br />';
  $date_prod  = get_date_product ($id_prod);
 //echo $date_prod;
 // echo '<br />';
 //echo '<br />';
 $datetime1 = date_create($date_prod);
 $datetime2 = date_create($day_date);
 $interval = date_diff($datetime1, $datetime2);
 //echo 'Age en jour :  '; 
 $age =  $interval->format('%d%a');
 //echo $age;
 return $age;
}
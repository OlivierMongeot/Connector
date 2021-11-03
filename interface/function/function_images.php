
<?php




function check_by_state() 
{
	$con = ConBdPresta();
	$sql = "SELECT * FROM ps_product_shop ";

		foreach($con->query($sql) as $row)
		{
			$id_prod = $row['id_product'];
			check_img ($id_prod);
		}
}



function check_img ($id_prod)
{

	$con = ConBdPresta();
	$sql = "SELECT * FROM ps_image WHERE id_product = '$id_prod' GROUP BY id_image ASC ";
	$n = 1;
	foreach($con->query($sql) as $row)
	{

		//echo 'ID_PRODUCT PRESTA = ';
		//echo $id_prod;
		//echo '<br>';

		//echo 'Image N° '. $n ;
		$id_image = $row[0];
		//echo '<br>';
		$long_id_img = strlen($id_image);

		check_size_img($id_image , $long_id_img , $id_prod );
		//echo '<br>';
		$n++;
			}



}



function check_size_img($id_img , $long_id_img , $id_prod )
{
	
		//echo 'Longueur ID IMAGE : ';
		//echo $long_id_img;
		//echo '<br>';
		$stack = array();
	
		for($i = 0 ; $i <= $long_id_img ; $i++)
		{
			$numero = substr($id_img, $i , 1);
			array_push($stack, $numero);
		}

			switch ($long_id_img)
			{
				case '2':
					$under_path = $stack[0].'/'.$stack[1];
					break;
				case '3':
					$under_path = $stack[0].'/'.$stack[1].'/'.$stack[2];
					break;
				case '4':
					$under_path = $stack[0].'/'.$stack[1].'/'.$stack[2].'/'.$stack[3];
					break;
				case '5':
					$under_path = $stack[0].'/'.$stack[1].'/'.$stack[2].'/'.$stack[3].'/'.$stack[4];
					break;
				default: echo 'PROBLEME DE CHEMIN ';
				break;
			}

	
		$path ='../../img/p/'.$under_path.'/'.$id_img.'.jpg';
		//echo 'Chemin : ';
		//echo $path; 
		//echo '<br>';
		
		$filename = $path;
		$size = getimagesize($filename);
		//echo '<br>';
		//echo 'Largeur =';	
		$larg = $size[0];
		//echo $larg;	
		//echo '<br>';
		$file_weight = filesize ( $filename );

		echo 'Poids =';	
		echo $file_weight;	
		echo '<br>';

		if ($larg < 500 )
		{
			echo 'Image trop petite';
			//echo '<img src=" '.$filename.' " alt="texte alternatif" title="Titre" width="50"  />';
			echo '<br>';
			// inscription dans la bbd de presta sur colone non utilise supplier_reference
			set_little_image($id_img , 1 );
			desactive_prod( $id_prod, 0 );




		}
		else
		{
			//echo 'Taille image OK ';
			set_little_image($id_img , 0);

		} 

		



}





function check_tot_sans_image()
{


  $sd ="
  SELECT SQL_CALC_FOUND_ROWS p.`id_product`  AS `id_product`,
   p.`reference`  AS `reference`,
   pl.`name`  AS `name`,
    sa.`active`  AS `active`,
    image_shop.`id_image`  AS `id_image`
  FROM  `ps_product` p 
  LEFT JOIN `ps_product_lang` pl ON (pl.`id_product` = p.`id_product` AND pl.`id_lang` = 1 AND pl.`id_shop` = 1)
  JOIN `ps_product_shop` sa ON (p.`id_product` = sa.`id_product` AND sa.id_shop = 1) 
  LEFT JOIN `ps_image_shop` image_shop ON (image_shop.`id_product` = p.`id_product` AND image_shop.`cover` = 1 AND image_shop.id_shop = 1)
  LEFT JOIN `ps_image` i ON (i.`id_image` = image_shop.`id_image`) 
  WHERE (1 AND state = 1) 
  AND image_shop.id_image IS NULL
  AND sa.active = 1
 
  ";


    $con = ConBdPresta();
 
    foreach($con->query($sd) as $id_prod)
           {
            //echo 'ID PRODUIT SANS IMAGE : ';
            //$id = $id_prod['id_product'];
            //echo $id;
             //echo '</br>';

           //is_prod_an_image($id);
            }


$qry = "SELECT FOUND_ROWS() AS NbRows";
$stmt = $con->query($qry);
    $res = $stmt->fetch();
//echo '</br>';
//echo 'TOTAL : ';
//echo $res[0];
return $res[0];
}



function list_sans_image()
{


  $sd ="
  SELECT p.`id_product`  AS `id_product`,
   p.`reference`  AS `reference`,
   pl.`name`  AS `name`,
    sa.`active`  AS `active`,
    image_shop.`id_image`  AS `id_image`
  FROM  `ps_product` p 
  LEFT JOIN `ps_product_lang` pl ON (pl.`id_product` = p.`id_product` AND pl.`id_lang` = 1 AND pl.`id_shop` = 1)
  JOIN `ps_product_shop` sa ON (p.`id_product` = sa.`id_product` AND sa.id_shop = 1) 
  LEFT JOIN `ps_image_shop` image_shop ON (image_shop.`id_product` = p.`id_product` AND image_shop.`cover` = 1 AND image_shop.id_shop = 1)
  LEFT JOIN `ps_image` i ON (i.`id_image` = image_shop.`id_image`) 
  WHERE (1 AND state = 1) 
  AND image_shop.id_image IS NULL
  AND sa.active = 1
 
  ";


    $con = ConBdPresta();
 
    foreach($con->query($sd) as $id_prod)
           {
            echo 'ID ';
            $id = $id_prod['id_product'];
            echo $id;
            echo '</br>';
          
            }


}







//check_img (529);	
//et_little_image(94);

function set_little_image($id_img , $state)
{

	$con = ConBdPresta();
	$sql = "SELECT id_product FROM ps_image WHERE id_image = '$id_img' GROUP BY id_image ASC ";

		$req = $con->query($sql);
		$result = $req->fetch();
		$id_prod = $result[0];

	$sql2 = "UPDATE ps_product SET supplier_reference = '$state' WHERE id_product = '$id_prod' ";
	$req2 = $con->query($sql2);


}





function check_base_ss_image()
{

	$con = ConBdPresta();

	$sql = " SELECT ps_product.id_product , ps_product_lang.name FROM ps_product JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product WHERE supplier_reference = 1 GROUP BY id_product ASC ";


		foreach($con->query($sql) as $id_prod)
		           {
		           
		            $id = $id_prod['id_product'];
		            $id2 = $id_prod['name'];
		            search_google_image($id);
		            echo ' ID ';
		            echo $id;
		            echo ' : ';
		            //echo 'NOM  : ';
		            echo $id2;
		            echo '  ';
		           	echo '<br />';
							          	
		            }




}



function search_google($rech)
{

                $rech = str_replace (' ' , '+' , $rech);

                $html = "https://www.google.com/search?q=$rech&roq=$rech&sourceid=chrome&ie=UTF-8";

                //echo $html;
                ?>

                <a onclick="window.open(this.href); return false;"  href=' <?php  echo $html;  ?>   '><img id="image-neon" src="./img/logo.png"/ style ="width: 30px"  ></a>
                
              
                <!-- <br /> -->
                <?php
}


function search_google_image($id_art)

{

				$sql = "SELECT name FROM ps_product_lang WHERE id_product = '$id_art'";
				$con = ConBdPresta();
				$req = $con->query($sql);
				$result = $req->fetch();
				$rech = $result[0];


                $rech = str_replace (' ' , '+' , $rech);

                //$html = "https://www.google.com/search?q=$rech&roq=$rech&sourceid=chrome&ie=UTF-8";

                $html = "https://www.google.com/search?q=$rech&tbm=isch&source=lnt&tbs=isz:l&sa=X&dpr=0.75";

                //echo $html;
                ?>

                <a onclick="window.open(this.href); return false;"  href=' <?php  echo $html;  ?>   '><img id="image-neon" src="./img/logo.png"/ style ="width: 30px"  ></a>
                
              
                <!-- <br /> -->
                <?php
}

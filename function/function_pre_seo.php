<!DOCTYPE html>
<html>

<head>
	<title>SEO</title>
</head>

<body>
	<?php
	//header('charset=utf-8');
	// ini_set('display_errors', 'on');
	// header('Content-type: text/html; charset=utf-8');
	$date_du_jour = date("Y-m-d H:i:s");



	function seo_selected($idart)
	{
		update_name($idart);
		update_link_rewrite($idart);
		write_meta_title($idart);
	}


	function update_name($id_prod)
	{

		$req_info = " SELECT * FROM ps_product_lang WHERE id_product = '$id_prod' ";
		$con = ConBdPresta();
		$req = $con->query($req_info);

		$result = $req->fetch();
		// echo '</br>';

		$id = $result["id_product"];

		// echo 'ID Produit : ';
		// echo $id;
		// echo '</br>';

		// echo 'Name : ';
		$string = $result["name"];
		//$prod_attributte = $result[0]
		// echo $string;
		// echo '</br>';

		// Filtres mots à completer ou à mettre en bdd 

		$string = str_replace('BLK ', 'BLACK ', $string);
		$string = str_replace(' BLK', ' BLACK', $string);
		$string = str_replace('/BLCK/', '/BLACK/', $string);

		$string = str_replace('JKT ', 'JACKET ', $string);
		$string = str_replace(' JKT', ' JACKET', $string);

		$string = str_replace('WHT ', 'WHITE ', $string);
		$string = str_replace(' WHT', ' WHITE', $string);
		$string = str_replace('/WHT/', '/WHITE/', $string);

		$string = str_replace('TEE ', 'TEE-SHIRT ', $string);
		$string = str_replace('T SHIRT ', 'TEE-SHIRT ', $string);
		$string = str_replace('T-S ', 'TEE-SHIRT ', $string);
		$string = str_replace(' T-S', ' TEE-SHIRT', $string);


		$string = str_replace('HOODI ', 'HOODIE ', $string);
		$string = str_replace(' HOODI', ' HOODIE', $string);

		$string = str_replace('LONGSLEEVE ', 'LONG SLEEVE ', $string);
		$string = str_replace(' LONGSLEEVE', ' LONG SLEEVE', $string);

		$string = str_replace('LS ', 'L/S ', $string);
		$string = str_replace(' LS', ' L/S', $string);

		$string = str_replace('GRY ', 'GREY ', $string);
		$string = str_replace(' GRY', ' GREY', $string);
		$string = str_replace('/GRY/', '/GREY/', $string);

		$string = str_replace('CREWNCK ', 'CREWNECK ', $string);
		$string = str_replace(' CREWNCK', ' CREWNECK', $string);

		$string = str_replace(' BLU', ' BLUE', $string);
		$string = str_replace('BLU ', 'BLUE ', $string);
		$string = str_replace('/BLU/', '/BLUE/', $string);


		$string = str_replace('NVY', 'NAVY', $string);
		$string = str_replace(' NVY', ' NAVY', $string);
		$string = str_replace('NVY ', 'NAVY ', $string);


		$string = str_replace("BLC", 'BLANC', $string);
		$string = str_replace(' BLC', ' BLANC', $string);
		$string = str_replace('BLC ', 'BLANC ', $string);


		// echo 'New Name : ';
		// echo $string;
		// echo '</br>';
		$current_name = $string;
		set_name($id_prod, $current_name);
	}



	function set_name($id_prod, $string)
	{
		$con = ConBdPresta();
		$sql = "UPDATE ps_product_lang SET name = :string WHERE id_product = :idprod ";
		$stm = $con->prepare($sql); // a finir
		$stm->execute(['idprod' => $id_prod, 'string' => $string]);
		// echo 'mise à jour du titre OK';
		// echo '</br>';
	}



	//ok

	function update_link_rewrite($id_prod)
	{
		$req_info = "SELECT name FROM ps_product_lang WHERE id_product = '$id_prod' ";

		$con = ConBdPresta();

		$req = $con->query($req_info);
		$result = $req->fetch();
		//echo $result[0];
		$name = $result[0];

		// echo 'NOM DE BASE : ';
		// echo $name;
		// echo '</br>';

		// echo 'NOM RECUPERE : ';
		$name = strtolower($name);
		$name = str_replace('/', ' ', $name);
		$name = str_replace("'", " ", $name);
		$name = str_replace(' ', '-', $name);
		// echo $name;
		// echo '</br>';

		write_rewrite_name($id_prod, $name);
	}





	function write_rewrite_name($id_prod, $rewrite_name)
	{
		$rewrite_name = str_replace("'", " " ,  $rewrite_name );
		$con = ConBdPresta();
		$sql = "UPDATE ps_product_lang SET link_rewrite = :rewrite_name WHERE id_product = :id_prod ";
		$stm = $con->prepare($sql);
		$stm->execute(['rewrite_name' => $rewrite_name, 'id_prod' => $id_prod]);
		// echo '</br>';
		// echo 'Mise à jour du rewrite name OK';
		// echo '</br>';
	}



	function write_meta_title($id_prod)
	{
		$con = ConBdPresta();
		//recupere la categorie avecid_prod
		$req_cat = "SELECT id_category_default FROM ps_product WHERE id_product = '$id_prod'";
		$stmt = $con->query($req_cat);
		$row = $stmt->fetch();
		$cat = $row[0];
		// echo 'Categorie  :';
		// echo $cat;
		// echo '</br>';
		$name_cat = get_name_category($cat);
		$new_name = get_name($id_prod);
		$new_meta_name = ucwords(strtolower($new_name));
		// filtre pour meilleur affichage
		$new_meta_name = str_replace('L/s', 'L/S', $new_meta_name);

		$new_meta_name = $new_meta_name . ' | Boutique de ' . "$name_cat" . ' en ligne ';
		// echo $new_meta_name;
		$con = ConBdPresta();
		$set_rewrite_name = "UPDATE ps_product_lang SET meta_title = :new_meta_name WHERE id_product = '$id_prod' ";
	
		$stm = $con->prepare($set_rewrite_name); // a finir
		$stm->execute(['new_meta_name' => $new_meta_name]);
		
		// echo '</br>';
		// echo 'Mise à jour du meta title name OK';
		// echo '</br>';
	}

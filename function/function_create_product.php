<?php



function create_ps_product($category, $marque, $px_ht, $ref)
{
	$con = Db::PDO_P();
	$date = date('Y-m-d H:i:s');
	$create_ps_product = "INSERT INTO
	 	ps_product 
	 	(id_supplier, id_manufacturer, id_category_default, id_tax_rules_group,
	 	price, reference, redirect_type, available_date, active, indexed, date_upd
	 	     ) 
	 	VALUES 
	 	( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? ) 
	 	";
	$sth = $con->prepare($create_ps_product);
	$values = [ 0 , $marque , $category , 1 , $px_ht , $ref , '301-category' , $date , 0 , 1, '1970-01-01' ];
	$sth->execute($values);
}


function create_ps_product_lang($id_prod, $titre)
{
	$con = Db::PDO_P();
	$link_titre = rewriteNameForLink($titre);
	$link_titre  = strtolower($link_titre);

	$create_ps_product_lang = "	INSERT INTO
	 	ps_product_lang	( id_product , id_shop , id_lang , link_rewrite ,  name )
	 	VALUES 
	 	( ? , ? , ? , ? , ?)
		 ";
	$stm = $con->prepare($create_ps_product_lang);
	$stm->execute([$id_prod , 1 , 1 , $link_titre ,  $titre]);

}


function rewriteNameForLink($rewrite)
{
	$rewrite = str_replace('/', ' ', $rewrite);
	$rewrite = str_replace("'", " ", $rewrite);
	$rewrite = str_replace(' ', '-', $rewrite);
	return $rewrite;
}


function create_simple_product_attribute($id_prod, $ean, $refe)
{
	$con = Db::PDO_P();
	$create = "INSERT INTO ps_product_attribute
	 	( id_product , ean13 , default_on , available_date , reference )
	 	VALUES ( '$id_prod' , '$ean' , '1' , '1970-01-01' , '$refe' )
	 	";
	$con->exec($create);
}



function create_simple_prod_shop($id_prod, $id_famille, $prix_ht, $default_id_attribute)
{
	$con = Db::PDO_P();
	$date = date('Y-m-d H:i:s');
	$create = "	INSERT INTO
	 	ps_product_shop
	 	( id_product , id_shop , id_category_default , id_tax_rules_group ,
		  on_sale , price , active , redirect_type , available_date , indexed , cache_default_attribute , 
		  date_add , date_upd )
	 	VALUES 
	 	( '$id_prod' , '1' , '$id_famille' , '1' , '0' , '$prix_ht' ,
		  '0' ,  '301-category' , '1970-01-01' , '1' , 
		  '$default_id_attribute' , '$date' , '$date' )
	 	";

	$con->exec($create);
}


function create_attribute_combi($id_prod_attribut, $id_attribut)
{
	$con = Db::PDO_P();
	$create = "	INSERT INTO
	 	ps_product_attribute_combination
	 	( id_attribute , id_product_attribute )
	 	VALUES 
	 	( '$id_attribut' , '$id_prod_attribut' )
	 	";

	$con->exec($create);
}

function create_simple_stock($id_product, $id_product_attribute, $stock)
{
	$con = Db::PDO_P();
	$req_stock =
		"INSERT INTO ps_stock_available ( id_product , id_product_attribute , id_shop , id_shop_group ,
	 quantity , physical_quantity  )
	VALUES ( '$id_product' , '$id_product_attribute' , '1' , '0' , '$stock' , '$stock' ) ";
	$con->exec($req_stock);
}


function create_category_prod($id_cat, $id_product, $position)
{
	$con = Db::PDO_P();
	$req_cat = "INSERT INTO ps_category_product ( id_category , id_product , position ) VALUES ( '$id_cat'  , '$id_product' , '$position' ) ";
	$con->exec($req_cat);
}

function create_layered_prod_attr($id_attribute, $id_product, $id_attribute_group)
{
	$con = Db::PDO_P();
	$layered = "INSERT INTO ps_layered_product_attribute (id_attribute , id_product , id_attribute_group , id_shop ) VALUES ('$id_attribute' , '$id_product' , '$id_attribute_group', '1' ) ";
	$con->exec($layered);
}


function getAllColors($rows){
	foreach ($rows as $row){
		$tabAllColorMixed[] = $row['IDCOULEUR']; 
	}
 return array_unique($tabAllColorMixed);

}

function getAllSizes($rows){
	foreach ($rows as $row){
		$tabAllSizesMixed[] = $row['IDTAILLE']; 
	}
 return array_unique($tabAllSizesMixed);

}

function create_multiple_product_attribute($id_prod, $refer, $ean)
{
	$con = Db::PDO_P();
	$create = "	INSERT INTO ps_product_attribute
				 	( id_product , reference , ean13 , available_date )
				 	VALUES ( '$id_prod' , '$refer' , '$ean' , '1970-01-01')	";
	$con->exec($create);
}


function recup_multiple_product_attribute($id_prod)
{
	$con = Db::PDO_P();
	$select = " SELECT MIN(id_product_attribute) FROM ps_product_attribute WHERE id_product = $id_prod ";
	$req = $con->query($select);
	$result = $req->fetch();
	$prod_attributte = $result[0];
	// echo $prod_attributte;
	return $prod_attributte;
}


function recup_multiple_product_attribute_max($id_prod)
{
	$con = Db::PDO_P();
	$select = " SELECT MAX(id_product_attribute) FROM ps_product_attribute WHERE id_product = $id_prod ";
	$req = $con->query($select);
	$result = $req->fetch();
	$prod_attributte = $result[0];
	// echo $prod_attributte;
	return $prod_attributte;
}


function update_product_attribute($id_product_attribute)
{
	$con = Db::PDO_P();
	$update = " UPDATE ps_product_attribute  SET default_on = '1' WHERE id_product_attribute = $id_product_attribute ";
	$con->query($update); // a finir 

}


function create_product_attribute_shop($id_prod_attr_mini, $rows, $id_prod){
	$id_prod_attr =	$id_prod_attr_mini;
	foreach ($rows as $row) {
		 insert_prod_attribute_shop($id_prod, $id_prod_attr);
		$id_prod_attr = $id_prod_attr + 1;
	}

}


function insert_prod_attribute_shop($id_prod, $id_prod_att)
{
	$con = Db::PDO_P();
	$create = "	INSERT INTO ps_product_attribute_shop
	 	( id_product_attribute , id_product , id_shop, available_date )
	 	VALUES 
	 	(  '$id_prod_att' , '$id_prod' , '1' , '1970-01-01' )
	 	";
	$con->exec($create);
}



function update_prod_attribute_shop($id_prod_attr, $id_prod)
{
	$con = Db::PDO_P();
	$up = "UPDATE ps_product_attribute_shop SET default_on = 1 WHERE id_product_attribute = $id_prod_attr";
	$con->exec($up);
}


function update_cache_default_atribute($id_prod_attr_mini, $id_prod)
{
	$con = Db::PDO_P();
	$up = " UPDATE ps_product SET cache_default_attribute = $id_prod_attr_mini WHERE id_product = $id_prod ";
	$con->exec($up);
}


// function update_price($id_prod, $prix_ht)
// {
// 	$con = ConBdPresta();
// 	$up = " UPDATE ps_product_shop SET price = $prix_ht WHERE id_product = $id_prod ";
// 	$con->exec($up);
// }


// //Creation des ps_prod_attribute  
// function add_line($id_product, $ean13, $refer)
// {
	
// 	$con = ConBdPresta();
// 	$newAttrib = "INSERT INTO ps_product_attribute (id_product , reference , ean13 , available_date )
// 	VALUES ('$id_product' , '$refer' , '$ean13' , '0000-00-00') ";
// 	$con->exec($newAttrib);
// }


function update_first_line($id_product, $ean13, $refer)
{
	$con = Db::PDO_P();
	$update_row = "UPDATE ps_product_attribute
     SET ean13 = $ean13 , reference = $refer , available_date = '0000-00-00'
     WHERE id_product = $id_product
     ";
	$con->query($update_row);
}



function id_prod_attrib($id_prod)
{

	//recuperer id_prod_attrib 
	$con = Db::PDO_P();

	$read_id_att = "
        SELECT id_product_attribute
        FROM ps_product_attribute
        WHERE id_product = '$id_prod'
        ";

	$stmt = $con->query($read_id_att);
	$row10 = $stmt->fetch();
	$id_prod_attr = $row10[0];
	//echo $id_prod_attr ;
	return $id_prod_attr;
}

function write_attribute_color($id_prod_attribut, $id_attribut)
{
	//ecriture d'un attribut combi 
	$con = Db::PDO_P();
	$set_Attrib = "INSERT INTO ps_product_attribute_combination (id_attribute , id_product_attribute)
		VALUES (  '$id_attribut' , '$id_prod_attribut' ) ";
	$con->exec($set_Attrib);
}


function write_attribute_size($id_prod_attribut, $id_attribut)
{
	//ecriture d'un attribut combi 
	$con = Db::PDO_P();
	$set_Attrib = "INSERT INTO
		ps_product_attribute_combination (id_attribute , id_product_attribute)
		VALUES (  '$id_attribut' , '$id_prod_attribut' ) ";
	$con->exec($set_Attrib);
}


function write_layered($id_att, $id_prod, $id_group, $id_shop)
{
	$con = Db::PDO_P();
	$layered = "INSERT INTO ps_layered_product_attribute (id_attribute, id_product , id_attribute_group , id_shop )
	VALUES (  '$id_att' , '$id_prod' , '$id_group' , '$id_shop' ) ";
	$con->exec($layered);
}



function write_default_on($idProd)
{
	$con = Db::PDO_P();
	//ecriture default_on
	$write = " UPDATE ps_product_attribute
		SET default_on = 1 WHERE id_product = $idProd ";
	$stmt2 = $con->query($write);
}


function write_att_shop($id, $id_att, $shop)
{
	$con2 = Db::PDO_P();
	$write_attr = "INSERT INTO
                    ps_product_attribute_shop ( id_product_attribute , id_product , id_shop ) 
                    VALUES ( '$id_att' , '$id' , '$shop' )
                    ";

	$con2->exec($write_attr);
	echo "Ecriture sur ps_product_attribute_shop : ";
	echo $id_att;
	echo '</br>';
}



// function delete_default_on($id)
// {
// 	$con = Db::PDO_P();
// 	$read = " SELECT default_on FROM ps_product_attribute WHERE id_product = $id ";

// 	$stmte = $con->query($read);
// 	$row = $stmte->fetch();
// 	$read_default_on  = $row[0];

// 	echo $read_default_on;
// }


// function sum_stock($id_pro)
// {
// 	//somme des stock de l'id 
// 	$con = Db::PDO_P();
// 	$sum = " SELECT SUM(quantity)
//                  FROM ps_stock_available
//                  WHERE id_product = $id_pro AND id_product_attribute != 0 ";

// 	$stmt = $con->query($sum);
// 	$row12 = $stmt->fetch();
// 	$sum_stock = $row12[0];
// 	// echo '</br>';
// 	// echo 'Total des stocks du produit  = ';
// 	// echo $sum_stock;
// 	//return $sum_stock;
// 	//ecriture du stock total 
// 	$write_sum = " UPDATE ps_stock_available SET quantity = $sum_stock , physical_quantity = $sum_stock WHERE id_product = $id_pro AND id_product_attribute = 0 ";

// 	$stmt2 = $con->query($write_sum);
// 	//return $sum_stock;

// }



// function update_sum_stock($id_pro)
// {
// 	// I Somme des stock physique de l'id 
// 	$con = Db::PDO_P();
// 	$sum = " SELECT SUM( physical_quantity )
//                  FROM ps_stock_available
//                  WHERE id_product = '$id_pro' AND id_product_attribute != 0 ";
// 	$stmt = $con->query($sum);
// 	$row12 = $stmt->fetch();
// 	$sum_stock = $row12[0];
// 	// echo '</br>';
// 	// echo 'Total des stocks Physique du produit  = ';
// 	// echo $sum_stock;
// 	// echo '</br>';
// 	//ecriture du stock total physique 
// 	$write_sum =
// 		"UPDATE ps_stock_available SET physical_quantity = '$sum_stock'
// 		 WHERE id_product = '$id_pro' AND id_product_attribute = 0 ";
// 	$con->query($write_sum);



// 	// II recherche de la somme des stock
// 	//somme des stock physique de l'id 
// 	//$con = ConBdPresta();
// 	$sum_dispo_req = " SELECT SUM( quantity )
//                  FROM ps_stock_available
//                  WHERE id_product = '$id_pro' AND id_product_attribute != 0 ";

// 	$stmt3 = $con->query($sum_dispo_req);
// 	$row13 = $stmt3->fetch();

// 	$sum_stock_dispo = $row13[0];
// 	// echo 'Total des	stocks disponible du produit  = ';
// 	// echo $sum_stock_dispo;
// 	// echo '</br>';

// 	//ecriture du stock total 
// 	$write_sum = " UPDATE ps_stock_available
// 		 SET quantity = '$sum_stock_dispo' 
// 		 WHERE id_product = '$id_pro' AND id_product_attribute = 0 ";

// 	$con->query($write_sum);
// }



function write_stock($id_prod_attribute, $stocks, $ps_products_id)
{
	$con = Db::PDO_P();
	$set_Attrib =
		"INSERT INTO
	ps_stock_available (id_product_attribute, quantity , physical_quantity ,
	 id_product , id_shop , id_shop_group ) 
	VALUES (  '$id_prod_attribute' , '$stocks' , '$stocks' , $ps_products_id , 1 , 0 ) ";

	$con->exec($set_Attrib);
}

// function create_simple_prod(int $category, int $marque, int $ean, float $px_ht, int $ref)
// {	
// 	$con = ConBdPresta();
// 	$date = date('Y-m-d H:i:s');
// 	$create_ps_product = "INSERT INTO
// 	 	ps_product 
// 	 	(id_supplier, id_manufacturer, id_category_default, id_tax_rules_group,
// 	 	 ean13, price, reference, redirect_type, available_date, active, indexed, date_upd
// 	 	     ) 
// 	 	VALUES 
// 	 	( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? ) 
// 	 	";
// 	$sth = $con->prepare($create_ps_product);
// 	$values = [ 0 , $marque , $category , 1 , $ean , $px_ht , $ref , '301-category' , $date , 0 , 1, '1970-01-01' ];
// 	$sth->execute($values);
// }


// function write_default_attribute($id_prod)
// {
// 	//lecture
// 	$select = " SELECT MIN(id_product_attribute) FROM ps_product_attribute WHERE id_product = $id_prod ";

// 	$con = ConBdPresta();
// 	$stmt = $con->query($select);
// 	$row11 = $stmt->fetch();
// 	$id_attr = $row11[0];
// 	echo 'Ecriture du cache_default_attribute dans ps_product : ';
// 	echo $id_attr;
// 	echo '</br>';
// 	echo '</br>';

// 	//ecriture cache_default_attribute
// 	$write = " UPDATE ps_product SET cache_default_attribute = $id_attr WHERE id_product = $id_prod ";
// 	$stmt = $con->query($write);
// }
<html><head>
	<title>CREATE DECLINATE</title>
</head>
<body>
	
<?php

	function create_declinate($rows)
	{
 		// echo '<h2>Variable commune à écrire</h2>';
		$name_check = $rows[0]['id_name'];
			$prix = $rows[0]['PRIX_TTC'];
		$prix_ht = $prix * 100 / (100 + 20); // TVA 20%
		// $prix_promo = $rows[0]['PRIX_PROMO'];
		// $reduction = (100 - (($prix_promo * 100)/$prix))/100; 
		$ray_kezia =$rows[0]['IDRAY'];
		$ray_presta = switch_rayon($ray_kezia);
		$famille = $rows[0]['IDFAM'];
		$category_presta = switch_cat($famille);
		$couleur = $rows[0]['IDCOULEUR'];
		$taille = $rows[0]['IDTAILLE'];
		$taille_presta = switch_taille($taille);
		$marque = $rows[0]['ID_FAB'];
		$ean = $rows[0]['MULTI_CODE'];
		$refe = $rows[0]['IDART'];
	
		////////// I /////////////////
		// echo '1. Creation Multi ps_product';
		create_ps_product($category_presta, $marque, $prix_ht, $refe);
		// echo 'ID du nouvel article : ';
		$id_prod = get_id_max();
		
		////////////////////// II II  ///////////////////////////
		// Create Product_lang ';
		create_ps_product_lang($id_prod, $name_check);
		//creation category_product 
		create_category_prod('2', $id_prod, '0');
		create_category_prod($ray_presta, $id_prod, '1');
		create_category_prod($category_presta, $id_prod, '2');
		
		/////////////creation des attributs 
		foreach ($rows as $row) {
			$ean = $row['MULTI_CODE'];
			$refe = $row['IDART'];
			create_multiple_product_attribute($id_prod, $refe, $ean);
		}

		/////////////////////// II VI ////////////////////////////////
		// echo '5   6 .Recuperation de id_product_attribute mini : ';
		$id_prod_attr_mini = recup_multiple_product_attribute($id_prod);
		
		// echo '8. Insert ps_prod_shop ';
		create_simple_prod_shop($id_prod, $category_presta, $prix_ht, $id_prod_attr_mini);
	
		// echo '6   9. Create product_attribute_shop<br>';
		create_product_attribute_shop($id_prod_attr_mini, $rows, $id_prod);
	
		//////////////////////////////II IV/////////////////////// 
		//creation du stock PRINCIPAL à 0  
		// echo '4. Create stock_available ligne 1 avec id_attribute à 0 et stock total à 0 pour l\'instant </br>';
		create_simple_stock($id_prod, '0', '0');  //1 ligne mini sans 

		$id_for_stock = $id_prod_attr_mini;

		foreach ($rows as $row) {
			$stocks = $row['stock'];
			write_stock($id_for_stock, $stocks, $id_prod);
			$id_for_stock = $id_for_stock + 1;
		}
		// Mise à jour du stock total  : à faire à la fin quand tous les autre stocks individuels sont rentrés
		$somme = update_sum_stock($id_prod);
		// echo $somme;
		
		//Mise à jour des attributs : 
		// echo '7. Update product_attribute mini : SET default ON ';
		update_product_attribute($id_prod_attr_mini);
	
		// update ligne davant 
		update_prod_attribute_shop($id_prod_attr_mini, $id_prod);
	
		
		//update cache_default_atribute de ps_product
		update_cache_default_atribute($id_prod_attr_mini, $id_prod);
		//////////////////////////////////////////

		// echo '14. Create ps_attribut_combination<br>';
		$id_prod_attri = $id_prod_attr_mini;
		foreach ($rows as $row) {
			$couleur = $row['IDCOULEUR'];
			$couleur_presta = switch_couleur($couleur);
			$taille = $row['IDTAILLE'];
			$taille_presta = switch_taille($taille);
			create_attribute_combi($id_prod_attri, $couleur_presta);
			create_attribute_combi($id_prod_attri, $taille_presta);
			$id_prod_attri = $id_prod_attri + 1;
			// echo '</br>';
		}


		// echo '15. Create ps_layered_product<br>';
		//inscription de la couleur en boucles si plusieurs couleurs
		// (inscription de chaque couleur une seule fois)
		$id_attribute_group = 2; // couleur pour la 1ere declinaison taille 
		//Tableau des couleurs dispo :
		$tabColors = getAllColors($rows);
		foreach ($tabColors as $color) {
			$color_prest = switch_couleur($color);
			create_layered_prod_attr($color_prest, $id_prod, $id_attribute_group);
			// echo '</br>';
		}
		// selection du bon id_attribute 
		if ($ray_kezia == 8 || $ray_kezia == 2) {
			$id_attribute_group = 1;
		} else {
			$id_attribute_group = 3;
		}
		//inscription des tailles en boucles
		// Recuperatiion des tailles dispo
		$tabSize = getAllSizes($rows);
		foreach ($tabSize as $size) {
			$taille_presta = switch_taille($size);
			// taille = attribute 
			create_layered_prod_attr($taille_presta, $id_prod, $id_attribute_group);
			// echo '</br>';
		}

	
		// Bascule de id_synchro à 1 
		foreach ($rows as $row2) {
			$refe = $row2['IDART'];
			setIdSynchro_stock($refe, 1);
		}

		seo_selected($id_prod);
		
	}

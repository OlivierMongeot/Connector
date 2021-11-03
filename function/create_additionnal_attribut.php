<html>
<head>
	<title>CREATE ADD</title>
</head>
<body>
	<?php
	//////////////////////AJOUT DE TAILLES SUR UN PRODUIT EXISTANT 
	function set_new_declinaison_existant_prod($rows, $id_prodPresta, $nbre_attrib)
	{
		// echo '5. Create ps_product_attribute';
		// echo '</br>';
		foreach ($rows as $row) {
			$ean = $row['MULTI_CODE'];
			$refe = $row['IDART'];
			$ray_kez = $row['IDRAY'];
			// echo 'EAN';
			// echo $ean;
			// echo '</br>';
			// echo 'ID PRODUIT';
			// echo $id_prodPresta;
			// echo '</br>';
			create_multiple_product_attribute($id_prodPresta, $refe, $ean);
		}

		// echo '6 Recuperation de id_product_attribute maxi : </br>';
		$id_prod_attr_maxi = recup_multiple_product_attribute_max($id_prodPresta);

		//recuperation du nouvel attribute minimum pour repartir a partir de celui ci 
		$id_attribute_depart = $id_prod_attr_maxi - ($nbre_attrib - 1);


		// echo '<br>7 Create product_attribute_shop<br>'; // a revoir si il rentr pas les deux fois 
		//recup de l'attribute N° 1 (mini)
		$id_prod_attr =	$id_attribute_depart;

		foreach ($rows as $row2) {
			insert_prod_attribute_shop($id_prodPresta, $id_prod_attr);
			$id_prod_attr = $id_prod_attr + 1;
		}

		// echo 'Gestion du stock';
		$id_for_stock = $id_attribute_depart;
		foreach ($rows as $row2) {
			$stocks = $row2['stock'];
			write_stock($id_for_stock, $stocks, $id_prodPresta);
			$id_for_stock = $id_for_stock + 1;
		}
		
		// Mise à jour du stock total  : 
		update_sum_stock($id_prodPresta);
						
		// ps_product_attribute_combination
		$id_prod_attri = $id_attribute_depart;
		foreach ($rows as $row) {
			$couleur = $row['IDCOULEUR'];
			$couleur_presta = switch_couleur($couleur);
			$taille = $row['IDTAILLE'];
			$taille_presta = switch_taille($taille);
			create_attribute_combi($id_prod_attri, $couleur_presta);
			create_attribute_combi($id_prod_attri, $taille_presta);
			$id_prod_attri = $id_prod_attri + 1;
		}
		
		
		// echo 'Create ps_layered_product';
		// selection du bon id_attribute 
		if ($ray_kez == 8 || $ray_kez == 2) {
			$id_attribute_group = 1;
		} else {
			$id_attribute_group = 3;
		}

		foreach ($rows as $row) {
			$taille = $row['IDTAILLE'];
			$taille_presta = switch_taille($taille);
			$sizeExist = isItNewAttribute($taille_presta, $id_prodPresta);
			if ($sizeExist == false) {
				// echo 'Creation Nouvel Attribut Taille';
				create_layered_prod_attr($taille_presta, $id_prodPresta, $id_attribute_group);
			}

			$color = $row['IDCOULEUR'];
			$couleur_presta = switch_couleur($color);
			$colorExist = isItNewAttribute($couleur_presta, $id_prodPresta);
			if ($colorExist == false) {
				// echo 'Creation Nouvel Attribut Couleur';
				create_layered_prod_attr($couleur_presta, $id_prodPresta, 2);
			}
		}


		// Bascule de id_synchro à 1 
		foreach ($rows as $row) {
			$refe = $row['IDART'];
			setIdSynchro_stock($refe, 1);
		}

		// echo '<br>Attribut(s) ajouté(s) avec succes<br>';
	}


	function isItNewAttribute($attribute, $idPresta)
	{
		$con = ConBdPresta();
		$select = "SELECT id_attribute FROM ps_layered_product_attribute
		WHERE id_attribute = $attribute AND id_product = $idPresta";
		$req = $con->query($select);
		return $req->fetch();
	}





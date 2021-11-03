<?php

function precreateProduct($name_checked)
{
   //  $name_checked = get_first_short_name_article();
   if ($name_checked === null) {
      // forceIDname($idart);
      //  setIdSynchro($name_checked, 100, 1 );
      return [0, 'Pas de ID NAME'];
   }

   // Recuperation de la ligne à synchroniser
   $rows = rowsToSynchronise($name_checked);

 //Vérification si Rayon et Famille existe bien dans presta 
 $result = checkRayonExist($rows);
 if ($result == 1 ){
   return [0, 'Rayon inconnu pour '.$name_checked .' : vérifier dans Kezia'];
   //Lancer  creéation Rayon
 }
 $result = checkFamilleExist($rows);
 if ($result == 1 ){
   //   createNewFamille($rows);
   return [0, 'Famille inconnue pour '.$name_checked .' : vérifier dans Kezia'];
   //Lancer  création Famille
  
 }


   // VERIFICATION SI PRODUIT COMPLET 
   // Check si les Tailles, Couleurs, Famille, Rayon et Fabricant sont dispo
   $errors = filtre_size_color_rayon($rows);
   //   var_dump($errors);
   if (!empty($errors)) {
      return [0, 'Article incomplet pour '.$name_checked .': désactivation des déclinaisons incomplètes'];
   }

   $rows = rowsToSynchronise($name_checked);
   $check = isItUniquePriceRayonFamille($rows);
   if ($check == 0) {
      return [0, 'Probleme de Prix, Rayon, Famille Non Identique pour '.$name_checked ];
   }

   $rows = rowsToSynchronise($name_checked);
   $etat = CheckUniqueSizeColorItems($rows);
   if ($etat[0] == 2) {
      //  echo 'Probleme de doublon taille : Desactivation de l\'article n°ID : ' . $etat[1] . '<br>';
      return [0, "Probleme de doublon taille : Desactivation de l\'article n°ID : " . $etat[1] . "<br>"];  // on recommence a zero car doublon trouvé et refaire un check
   }


   $nbre_attrib =  counter_final_prod_to_update($name_checked);

   //activation de la marque a synchronier
   $id_marque = check_brand($name_checked);
   $state_brand = check_brand_is_active($id_marque);

   if ($state_brand == 0) {
      echo 'Marque non active : Activation';
      echo '</br>';
      active_brand($id_marque);
   }

   //VERIFIER SI PRODUIT DEJA EXISTANT SOUS D'AUTRES TAILLE DANS LA LISTE ID SYNC = 
   $new = check_if_same_products_exist($name_checked);

   if ($new == 0) {
      // echo '</br> Début Création nouveau produit ';
      if (!empty($rows)) {
          $create = create_declinate($rows);
         return [1, 'Article créé'];
      } else {
         echo 'Pas de Rows';
      }
   } else {
      echo '<br>NOM DEJA EXISTANT</br>';
      $uniquePrice = checkIfSamePriceThatExistingProd($name_checked);
      if ($uniquePrice >= 2) {
         desactiveRows($rows);
         return [0, ' C\'est un autre produit : Problème de nom identique avec prix différent : désactivation'];
      }

      $id_prestaExsitante = recup_id_presta($name_checked);
      // Voir si pas un doublon par rapport aux articles déja existant 
      $status = getSizeColorDoublon($rows);
      if ($status == 1) {
         return [0, ' C\'est un doublon : désactivation'];
      }
      $rows = rowsToSynchronise($name_checked);
      $nbre_attrib =  counter_final_prod_to_update($name_checked);
      if (!empty($rows)) {
          set_new_declinaison_existant_prod($rows, $id_prestaExsitante, $nbre_attrib);
         return [1, 'Atributs supplémentaires créés'];
      } else {
         echo 'Pas de rows';
      }
   }
}

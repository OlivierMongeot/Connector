
<?php

/**
 * SEO function for add later the category name to name product 
 * @param [type] $id_categorie
 * @return string
 */
function get_name_category(int $idCategory)
{
  $con = Db::PDO_P();
  $req_cat = "SELECT name FROM ps_category_lang WHERE id_category = $idCategory ";
  $req = $con->query($req_cat);
  $result = $req->fetch();
  return $result[0];
}


function get_name($id_prod)
{

  $con = Db::PDO_P();
  $get_name = "SELECT name FROM ps_product_lang WHERE id_product = '$id_prod' ";
  $stmt = $con->query($get_name);
  $row = $stmt->fetch();
  $name = $row[0];
  return $name;
}



function get_attribute_min($id_prod)
{

  $con = Db::PDO_P();
  $req_att = " SELECT (id_product_attribute) FROM ps_product_attribute WHERE id_product = $id_prod";
  $req = $con->query($req_att);
  $result = $req->fetch();
  $id_product_attr = $result[0];
  return $id_product_attr;
}

function get_id_max()
{

  $con = Db::PDO_P();
  $req_idmax = "SELECT MAX(id_product) FROM ps_product ";
  $req = $con->query($req_idmax);
  $result = $req->fetch();
  $id_product = $result[0];
  return $id_product;
}

function setIdName()
{
  // $sql = "SELECT IDART, DESIGNATION FROM WEB_ARTICLE
  // WHERE id_synchro = 0 AND id_name = '' OR id_synchro = 0 AND id_name is null";
  $sql = "SELECT IDART, DESIGNATION FROM WEB_ARTICLE
  WHERE id_synchro = 0";
  $con = Db::PDO_T();
  foreach ($con->query($sql) as $idcheck) {
    $name = parse_name($idcheck['DESIGNATION']);
    // echo 'New name = ' . $name . '<br>';
    set_short_name($idcheck[0], $name);
  }
}


function desactiveRows($rows)
{
  foreach ($rows as $row) {
    $idArt = $row['IDART'];
    setIdSynchro_stock($idArt, 99);
  }
}

function setIdSynchro($new_name, $state, $unwanted)
{
  $con = Db::PDO_T();
  $sql = "UPDATE WEB_ARTICLE SET id_synchro = :stated WHERE id_name = :new_name AND id_synchro != :unwanted ";
  $sth = $con->prepare($sql);
  $sth->execute(['stated' => $state, 'new_name' => $new_name, 'unwanted' => $unwanted]);
}

function setIdSynchro_stock($id_art, $state)
{
  $con = Db::PDO_T();
  $update_synchro = "UPDATE WEB_ARTICLE SET id_synchro = $state WHERE IDART = $id_art ";
  $con->query($update_synchro);
}


// VOIR SI PRODUIT DISPO AVEC CHECK DE  "id_synchro"
function ItemsByIdSynchro($idSynchro)
{
  $sql = " SELECT * FROM WEB_ARTICLE WHERE id_synchro = $idSynchro GROUP BY id_name ORDER BY IDART DESC";
  $con = Db::PDO_T();
  $sth = $con->query($sql);
  return $sth->fetchAll();
}



function AgregateNamebyIdSynchro($idSynchro)
{

  $sql = " SELECT DISTINCT id_name, IDART FROM WEB_ARTICLE WHERE id_synchro = $idSynchro GROUP BY id_name ORDER BY IDART DESC";
  $con =  Db::PDO_T();
  $sth = $con->query($sql);
  return $sth->fetchAll();
}


function counter_prod_to_update()
{
  $con = Db::PDO_T();
  $counter = "SELECT COUNT(*) FROM WEB_ARTICLE WHERE id_synchro = 0 ";
  $stmt = $con->query($counter);
  $row = $stmt->fetch();
  $number_to_up = $row[0];
  return $number_to_up;
}


function counter_final_prod_to_update($short_name)
{
  $con = Db::PDO_T();
  $counter = "SELECT COUNT(*) FROM WEB_ARTICLE WHERE id_synchro = 0 AND id_name = :short_name ";
  $stmt = $con->prepare($counter);
  $stmt->execute(['short_name' => $short_name]);
  $row = $stmt->fetch();
  $number_to_up = $row[0];
  return $number_to_up;
}

// modif en prepare 15/11
function set_short_name($id_art, $short)
{
  $con = Db::PDO_T();
  $sql = "UPDATE WEB_ARTICLE
   set id_name = :short
   WHERE IDART = :id_article ";
  $stmt = $con->prepare($sql);
  $stmt->execute(['short' => $short, 'id_article' => $id_art]);
}


/**
 *   // RECUPERATION DU  1er short_name commun POUR FAIRE UNE LISTE DE CE PRODUIT 
 *
 * @return string
 */
function get_first_short_name_article()
{
  $first_list = "SELECT id_name FROM WEB_ARTICLE WHERE id_synchro = 0 ORDER BY IDART DESC";
  $con = Db::PDO_T();
  $stmt = $con->query($first_list);
  $row = $stmt->fetchAll();
  $name_checked = $row[0]['id_name'];
  return $name_checked;
}



function checkRayonExist($rows)
{
  $tabRayon = [2, 3, 8];
  foreach ($rows as $row) {
    $rayon = $row['IDRAY'];
      if (!in_array($rayon, $tabRayon)) {
        setIdSynchro($row['id_name'], 27, 1);
        $err = 1;
      }
  }
  if (isset($err) && $err == 1) {
    return 1;
  }
}

function checkFamilleExist($rows)
{
  $tabFamille = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 16, 17, 18, 19, 20, 21, 23, 24, 25, 26, 33, 34, 35, 36, 37];
  foreach ($rows as $row) {
    $famille = $row['IDFAM'];
    if (!in_array($famille, $tabFamille)) {
      setIdSynchro($row['id_name'], 28, 1);
      $err = 1;
    }
  }
  if (isset($err) && $err == 1) {
    return 1;
  }
}

function isItemSolo($idcolor, $idSize, $name_check)
{
  $sql = "SELECT IDART, IDTAILLE, IDCOULEUR FROM WEB_ARTICLE 
  WHERE id_synchro = :idSynchro  AND id_name = :name_check 
  AND IDTAILLE = :idSize  AND IDCOULEUR = :idcolor ";
  $con = Db::PDO_T();
  $sth = $con->prepare($sql);
  $sth->execute(['idSynchro' => 0, 'name_check' => $name_check, 'idSize' => $idSize, 'idcolor' => $idcolor]);
  $rows = $sth->fetchAll();
  return $rows;
}

function CheckUniqueSizeColorItems($rows)
{
  foreach ($rows as $row) {
    $size = $row['IDTAILLE'];
    $idart = $row['IDART'];
    $color = $row['IDCOULEUR'];
    $name_check =  $row['id_name'];
    // voir si d'autres tailles identique avec meme couleur dans le tableau du meme name
    // nombre d'article avec la meme taille 
    $res = isItemSolo($color, $size, $name_check);

    if (Sizeof($res) > 1) {
      // desactive l'idart en 3
      setIdSynchro_stock($idart, 33);
      return [2, $idart];
    }
  }
  return  [0, $idart];
}




function rowsToSynchronise(string $name_checked): array
{
  $sql = "SELECT * FROM WEB_ARTICLE
  WHERE id_synchro = 0 AND id_name = :named
  ORDER BY IDART DESC";
  $con = Db::PDO_T();
  $sth = $con->prepare($sql);
  $sth->execute(['named' => $name_checked]);
  return $sth->fetchall();
}


function filtre_size_color_rayon($rows)
{

  foreach ($rows as $idcheck) {
    $ray = $idcheck['IDRAY'];
    $taille = $idcheck['IDTAILLE'];
    $id_colors = $idcheck['IDCOULEUR'];
    $brand = $idcheck['ID_FAB'];
    $famille = $idcheck['IDFAM'];
    $idart = $idcheck['IDART'];
    $errors = [];

    if ($taille <= 0 && $ray != 2) {
      // echo 'Pas de Taille </br>';
      $errors[] =  4;
    }

    if ($id_colors <= 0) {
      // echo 'Pas de Couleur </br>';
      $errors[] = 5;
    }

    if ($famille <= 0) {
      // echo 'Pas de famille';
      $errors[] =  6;
      echo '</br>';
    }

    if ($brand <= 0) {
      // echo 'Pas de Marque';
      $errors[] =  7;
      echo '</br>';
    }

    if ($ray <= 0) {
      // echo 'Pas de rayon';
      $errors[] =  8;
      echo '</br>';
    }
    // var_dump($errors);
    if (!empty($errors)) {
      // var_dump(implode($errors));
      // echo 'Pour l\'ID :' . $idart . '<br>';
      setIdSynchro_stock($idart, implode($errors));
    }
  }

  return $errors;
}



function isItUniquePriceRayonFamille($rows)
{

  foreach ($rows as $row) {
    $tabPrice[] = $row['PRIX_TTC'];
    $tabRayon[] = $row['IDRAY'];
    $tabFamille[] = $row['IDFAM'];
    $name = $row['id_name'];
    $fab[] = $row['ID_FAB'];
  }

  if (sizeof(array_unique($tabPrice)) == 1 && sizeof(array_unique($tabRayon)) == 1 && sizeof(array_unique($tabFamille)) == 1 && sizeof(array_unique($fab)) == 1) {

    return 1;
  } else {
    setIdSynchro($name, 22, 1);
    return 0;
  }
}


function check_if_same_products_exist($name_checked)
{
  $con = Db::PDO_T();
  $sql = "SELECT COUNT(id_name) FROM WEB_ARTICLE WHERE id_name = :name_checked AND id_synchro = 1";
  $stmt = $con->prepare($sql);
  $stmt->execute(['name_checked' => $name_checked]);
  $num = $stmt->fetch();
  $number = $num[0];
  // var_dump($number);
  return $number;
}

/**
 * Retourne l'ID produit Prestashop avec le name parse de Kezia 
 *
 * @param string $name 
 * @return $id_presta
 */
function recup_id_presta($name)
{
  $con = Db::PDO_T();
  $sql = "SELECT IDART FROM WEB_ARTICLE WHERE id_name = :named AND id_synchro = 1 GROUP BY IDART ASC";
  // echo 'For name :';
  // echo $name;
  // echo '<br />';
  $stmt = $con->prepare($sql);
  $stmt->execute(['named' => $name]);
  $num = $stmt->fetchall();

  foreach ($num as $id) {
    // echo 'Reference ID Kezia concernée  = ';
    // echo $id[0] . '<br>';
  }

  $con = Db::PDO_P();
  $sql = "SELECT id_product FROM ps_product_attribute WHERE reference = '$id[0]' ";
  $stmt = $con->query($sql);
  $num = $stmt->fetch();
  $id_presta = $num[0];
  // var_dump($id_presta);
  // echo '<br />';
  echo ' Correspond à l\'ID produit Prestashop : ';
  echo $id_presta . '<br>';
  return $id_presta;
}


function checkIfSamePriceThatExistingProd($name)
{
  $con = Db::PDO_T();
  $sql = "SELECT PRIX_TTC FROM WEB_ARTICLE WHERE id_name = :named ";
  $stmt = $con->prepare($sql);
  $stmt->execute(['named' => $name]);
  $num = $stmt->fetchall();
  foreach ($num as $n) {
    $tabPrice[] = $n['PRIX_TTC'];
  }
  return count(array_unique($tabPrice));
}


function isItRefresh($name)
{
  $con = Db::PDO_T();
  $sql = "SELECT id_name FROM WEB_ARTICLE WHERE id_name = :named AND id_synchro = :idSync";
  $stmt = $con->prepare($sql);
  $stmt->execute(['named' => $name, 'idSync' => 0]);
  return $stmt->fetchall();
}


function getSizeColorDoublon($rows)
{
  $con = Db::PDO_T();
  foreach ($rows as $row) {
    // Verifie si deja exisante sur presta 
    $newIdart = $row['IDART'];
    $idColor = $row['IDCOULEUR'];
    $idSize = $row['IDTAILLE'];
    $idName = $row['id_name'];
    $sql = "SELECT IDCOULEUR, IDTAILLE, IDART, id_name FROM WEB_ARTICLE WHERE IDCOULEUR = :idColor AND IDTAILLE = :idSize AND id_synchro = 1 AND id_name = :idName";
    $stm = $con->prepare($sql);
    $stm->execute(['idColor' => $idColor, 'idSize' => $idSize, 'idName' => $idName]);
    $attributs[] =  $stm->fetch();
  }

  foreach ($attributs as $attribut) {
    // var_dump($r);
    $idColor = $attribut['IDCOULEUR'];
    $idTaille = $attribut['IDTAILLE'];
    $name = $attribut['id_name'];

    if ($attribut === false) {
      // echo ' Pas de doublon<br>';
      $error = 0;
    } else {
      // echo 'Doublon Taille Couleur : Désactivation de l\'ID concernée <br>';
      desactiveProd($idColor, $idTaille, $name);
      $error = 1;
    }
  }
  if ($error == 1) {
    return 1;
  }
}

function desactiveProd($idColor, $idSize, $name)
{
  // var_dump($idColor, $idSize, $name);
  $con = Db::PDO_T();
  $sql = 'UPDATE WEB_ARTICLE
  SET id_synchro = 33 
  WHERE IDCOULEUR = :idColor 
  AND IDTAILLE = :idSize 
  AND id_synchro = :idsync 
  AND id_name = :named
  ';
  $stm = $con->prepare($sql);
  $stm->execute(['idColor' => $idColor, 'idSize' => $idSize, 'idsync' => 0, 'named' => "$name"]);
}


function parse_name($string)
{
  $string = preg_replace('!\s+!', ' ', $string);
  $string = trim($string);
  // echo "<br>String de départ : ";
  // echo $string;
  // echo '<br/>';
  //retourne les 5 derniers caracteres de la chaine 
  $der = substr($string,  -5);
  // echo 'LES 5 DERNIERES LETTRES : ';
  // echo $der;
  // echo '<br/>';

  $allSixDer = substr($string,  -6);
  $avantDer = substr($allSixDer, 0, 1);
  // echo '6eme :';
  // echo $avantDer;
  // echo '<br>';
  // ANALYSE DES 5 DERNIERS CARACTERES
  //prem_der = premier des 5 derniers 
  $prem_der  = substr($der, 0, 1);
  $deuz_der  = substr($der, 1, 1);
  $troiz_der = substr($der, 2, 1);
  $quat_der  = substr($der, 3, 1);
  $cinq_der  = substr($der, 4, 1);

  $long_string = strlen($string);

  // var_dump($long_string, $prem_der, $cinq_der);
  $forLast = $deuz_der . $troiz_der . $quat_der . $cinq_der;
  $threeLast = $troiz_der . $quat_der . $cinq_der;

  if ($forLast ==  "L/XL" || $forLast == "XS/S") {

    $string = substr($string, 0, -4);
    return $string;
  }

  if ($avantDer . $der == "XXS/XS") {
    $string = substr($string, 0, -6);
    return $string;
  }

  if ($threeLast == "M/L" || $threeLast == "S/M") {
    $string = substr($string, 0, -3);
    return $string;
  }


  // PREMIER POSITION DE l'ANTISLASH  "/___._" 
  if ($prem_der == "/" && $quat_der == '.') {
    $fin_de_string = substr($string, $long_string - 5);
    $string = substr($string, 0, -5);
    return $string;
  }

  if ($prem_der == "/" && $quat_der == ',') {
    $fin_de_string = substr($string, $long_string - 5);
    $string = substr($string, 0, -5);
    return $string;
  }
  // CAS DES POINTURES : " 37.5" 
  if ($prem_der == " " && $quat_der == '.') {
    $fin_de_string = substr($string, $long_string - 4);
    if (is_numeric($fin_de_string)) {
      $string = substr($string, 0, -5);
      return $string;
    }
  }
  // CAS DES POINTURES : " 37,5"
  if ($prem_der == " " && $quat_der == ',') {
    $string = substr($string, 0, -5);
    return $string;
  }


  // DEUXIEME "_/___"
  if ($deuz_der == "/") {
    $fin_de_string = substr($string, $long_string - 3);
    if (is_numeric($fin_de_string)) {
      $string = substr($string, $long_string - 4);
      return $string;
    }
  }

  // BLANC EN DEUZ ET '/' en TROIS
  if ($deuz_der == ' ' && $troiz_der == "/") {
    $fin_de_string = substr($string, $long_string - 3);
    $string = substr($string, 0, -4);
    return $string;
  }

  //FIN EN XXL OU XXS
  if ($deuz_der == ' ' && ($troiz_der . $quat_der . $cinq_der) == "XXL" || $deuz_der == ' ' && ($troiz_der . $quat_der . $cinq_der) == "XXS") {
    $fin_de_string = substr($string, $long_string - 4);
    $string = substr($string, 0, -4);
    return $string;
  }


  // 3EME DERNIER = ESPACE BLANC :
  if ($troiz_der == " ") {
    $fin_de_string = substr($string, $long_string - 2);

    if (is_numeric($fin_de_string)) {
      $string = substr($string, 0, -3);
      return $string;
    }
    if (($quat_der . $cinq_der) == 'XS' or ($quat_der . $cinq_der) == 'XL') {
      $string = substr($string, 0, -3);
      return $string;
    }
  }

  // 3EME DERNIER = / genre 32/35 :
  if ($troiz_der == "/") {
    $fin_de_string = substr($string, $long_string - 2);
    $debut_des_cinq =  $prem_der . $deuz_der;

    if (is_numeric($fin_de_string) && is_numeric($debut_des_cinq)) {
      $string = substr($string, 0, -5);
      return $string;
    }

    if (is_numeric($fin_de_string)) {
      $string = substr($string, 0, -3);
      return $string;
    }
    if (($quat_der . $cinq_der) == 'XS' or ($quat_der . $cinq_der) == 'XL') {
      $string = substr($string, 0, -3);
      return $string;
    }
  }

  // TRAITEMENT du caractere EN 3 ET 4 EME POS   
  if ($troiz_der == ' ' && $quat_der == "/") {
    $string = substr($string, 0, -3);
    return $string;
  }

  // 4eme POSITION 
  if ($quat_der == " ") {
    $fin_de_string = substr($string, $long_string - 1);
    $string = substr($string, 0, -2);
    return $string;
  }

  // 5eme POSITION 
  if ($cinq_der == "/") {
    $string = substr($string, 0,  -1);
    return $string;
  }


  return $string;
}

function check_brand($name)
{
  $con = Db::PDO_T();
  $sql = "SELECT ID_FAB FROM WEB_ARTICLE WHERE id_name = :named";

  $stm = $con->prepare($sql);
  $stm->execute(['named' => $name]);
  $num_brand = $stm->fetch();
  $num = $num_brand[0];
  return $num;
}

function check_brand_is_active($marque)
{
  $con = Db::PDO_P();
  $sql = "SELECT active FROM ps_manufacturer WHERE id_manufacturer = :marque";
  $stm = $con->prepare($sql);
  $stm->execute(['marque' => $marque]);
  $active = $stm->fetch();
  $state = $active[0];
  return $state;
}

function active_brand($id_marque)
{
  $con = Db::PDO_P();
  $sql = "UPDATE ps_manufacturer SET active = 1 WHERE id_manufacturer = '$id_marque'";
  $con->query($sql);
}


function check_brand_exist()
{
  //COMPARAISON DES ID MAX DES MARQUES 
  $con = Db::PDO_T();
  $sql = "SELECT max(IDFAB) FROM WEB_FABRICANT";
  $stm = $con->query($sql);
  $num_brand = $stm->fetch();
  // echo '</br>';
  $num1 = $num_brand[0];
  // echo 'MAX Brand Kezia : ';
  // echo $num1;

  $con2 = Db::PDO_P();
  $sql = "SELECT MAX(id_manufacturer) FROM ps_manufacturer";
  $stm2 = $con2->query($sql);
  $num_brand = $stm2->fetch();

  // echo '</br>';
  $num2 = $num_brand[0];
  // echo 'MAX Brand Presta : ';
  // echo $num2 . '<br />';

  if ($num1 > $num2) {
    // echo 'NOMBRE DE MARQUES A CREER<br />';

    for ($i = $num2 + 1; $i <= $num1; $i++) {
      //RECUPERATION DU NOM DE LA NOUVELLE MARQUE 
      $con = Db::PDO_T();
      $sql2 = "SELECT NOM_FAB FROM WEB_FABRICANT WHERE IDFAB = '$i'";
      $stm = $con->query($sql2);
      $name_brand = $stm->fetch();
      // echo 'ID : ' . $i . '<br />';
      $name = $name_brand[0];
      echo 'Inscription de ' . $name . '<br />';
      //ECRITURE DE LA MARQUE SUR LES 3 TABLES CONCERNEE                    
      $date_du_jour = date("Y-m-d H:i:s");
      $con = Db::PDO_P();
      $sql3 = "INSERT INTO
                    ps_manufacturer (name, date_add, date_upd, active)
                    VALUES (:named , :date_du_jour , :date_du_jour_two ,  :stats  )";

      $stmt = $con->prepare($sql3);
      $stmt->execute([
        'named' => $name,
        'date_du_jour' => $date_du_jour,
        'date_du_jour_two' => $date_du_jour,
        'stats' => 1
      ]);

      $sql4 = "INSERT INTO
                    ps_manufacturer_lang (id_manufacturer , id_lang )
                    VALUES ('$i' , '1' )";
      $stmt = $con->query($sql4);

      $sql5 = "INSERT INTO
                    ps_manufacturer_shop (id_manufacturer , id_shop )
                    VALUES ('$i' , '1' )";
      $con->query($sql5);
      // echo 'Insertion ps lang et shop OK<br />';
    }
  }
}


// function get_name_prod($id_art)
// {
//   $short_name = "SELECT DESIGNATION  FROM WEB_ARTICLE WHERE IDART = '$id_art'";
//   $con = ConBdTampon();
//   $stmt = $con->query($short_name);
//   $row = $stmt->fetch();
//   $name = $row[0];
//   return $name;
// }

// function get_name_attribute($id_attribute)
// {

//   $con = ConBdPresta();
//   $req_att = "SELECT name FROM ps_attribute_lang WHERE id_attribute = $id_attribute ";
//   $req = $con->query($req_att);
//   $result = $req->fetch();
//   $attribut_name = $result[0];
//   return $attribut_name;
// }

// function first_products_to_update($name_checked)
// {

//   $rows = rowsToSynchronise($name_checked);
//   foreach ($rows as $row) {
//     echo  ' ID KEZIA N°:   ' . $row["IDART"] . '  ' . $row["DESIGNATION"] . '  ';
//     echo '</br>';
//   }
// }

// checkIfSamePrice('PUMA TRACKPANT WORLDHOOD');

// function getPrestaSizeColorInstalled($name_checked){
//   $con = ConBdTampon();
//   $sql = "SELECT IDCOULEUR, IDTAILLE  FROM WEB_ARTICLE WHERE id_name = :named AND id_synchro = 1";
//   $stm = $con->prepare($sql);
//   $stm->execute(['named' => $name_checked]);
//   return  $stm->fetchall();
// }

// function verifieArticleSizeByColor(int $color, string $name_check): array
// {
//   $sql = "SELECT DESIGNATION, IDTAILLE, IDART, IDCOULEUR, id_name FROM WEB_ARTICLE
//   WHERE id_synchro = 0 AND id_name = :named AND IDCOULEUR = :color
//   ORDER BY IDART";
//   $con = ConBdTampon();
//   $sth = $con->prepare($sql);
//   $sth->execute(['named' => $name_check, 'color' => $color]);
//   $rowsByColor = $sth->fetchall();
//   return $rowsByColor;
// }

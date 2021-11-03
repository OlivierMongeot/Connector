<?php

function test(){
    $sql = "UPDATE WEB_ARTICLE SET refus_state = 55 WHERE IDART = 20";
    $con = DB::PDO_T();
    $con->exec($sql);
    echo 'TOTO ca marche !!';
}


function updateAllStocks()
{
    $sql = 'SELECT IDART, stock FROM WEB_ARTICLE WHERE id_synchro = 1 ';
    $con = DB::PDO_T();
    $sth = $con->query($sql);
    $rows = $sth->fetchAll();
    foreach ($rows as $row) {
        $id_article = $row['IDART'];
        // echo $id_article;
        $stockKezia = $row['stock'];
        checkDifferenceStock($id_article, $stockKezia);
    }
    return 1;
}

function checkDifferenceStock($idArtKez, $StockKezia)
{
    // echo 'STOCK KEZIA: ';
    // echo $StockKezia;
    // echo '</br>';
    //echo 'Recuperation de l\'id_prod_attrib associer à cet article sur  Presta  : ';
    $con = DB::PDO_P();
    $id_prod_attr_Presta = "SELECT id_product_attribute FROM ps_product_attribute WHERE reference = '$idArtKez'";
    $stmt = $con->query($id_prod_attr_Presta);
    $row = $stmt->fetch();
    $id_pro_att = $row[0];

    // echo 'ID PROD ATTRIBUTE CHECKER: ';
    // echo $id_pro_att;
    // echo '</br>';


    if (!$id_pro_att > 0) {
        echo 'Pas de produit trouvé correspondant sur presta  : STOP <br>';
        return;
    }

    $sql = "SELECT * FROM ps_stock_available WHERE id_product_attribute  = $id_pro_att";
    $stmt = $con->query($sql);
    $row3 = $stmt->fetch();
    $stockPresta = $row3['physical_quantity'];
    // echo 'STOCK Presta: ';
    // echo $stockPresta;
    // echo '</br>';
    // $id_prodPresta = $row3['id_product'];

    if ($stockPresta == $StockKezia) {
        // echo 'STOCK EGALE, on passe à la reference suivante';
        return;
    } else {
        echo 'ID ART KEZIA A CHECKER: ';
        echo $idArtKez;
        echo '</br>';
        echo 'Différence trouvée : ';
        $dif_stock = $StockKezia - $stockPresta;
        echo $dif_stock;
        echo '</br>';
        echo 'Stock Kezia != Stock Presta<br>';
        echo ' Ajouter ' . $dif_stock . ' dans Prestashop<br>';
        echo 'Update du stock Presta<br>';
        updateStock($id_pro_att, $StockKezia);
    }
}


function updateStock($id_prod_attrib, $stock_kezia)
{
    //set Physical quantity
    $con = DB::PDO_P();
    $req_upd = "UPDATE ps_stock_available SET physical_quantity = '$stock_kezia'
		WHERE id_product_attribute = '$id_prod_attrib' AND id_product_attribute != 0 ";
    $con->query($req_upd);
    echo 'Physical Stock Updated';
    echo '</br>';

    // Set quantity with reserverd_quantity
    $check_reserve = "SELECT reserved_quantity, id_product FROM ps_stock_available WHERE id_product_attribute  = '$id_prod_attrib'";
    $stmt = $con->query($check_reserve);
    $row = $stmt->fetch();
    $reserve = $row['reserved_quantity'];
    echo 'Réserve = ';
    echo $reserve;
    echo '</br>';
    echo 'ID_Product concerné : ';
    $id_prod = $row['id_product'];

    $stock_dispo = $stock_kezia - $reserve;
    $sql = "UPDATE ps_stock_available 
			SET quantity = '$stock_dispo' WHERE id_product_attribute = '$id_prod_attrib' AND id_product_attribute != 0 ";
    $con->query($sql);
   
    update_sum_stock($id_prod);
    echo 'Stock Available & Physical Updated<br>';
}

// prend en compte les reserve 
function update_sum_stock($id_pro)
{
    // I Calcul des stock physique de l'id 
    $con = DB::PDO_P();
    $sum = " SELECT SUM(physical_quantity) FROM ps_stock_available
                 WHERE id_product = '$id_pro' AND id_product_attribute != 0 ";
    $stmt = $con->query($sum);
    $row = $stmt->fetch();
    $sum_stock = $row[0];

    //Ecriture du Total physique 
    $write_sum = " UPDATE ps_stock_available SET physical_quantity = '$sum_stock' WHERE id_product = '$id_pro' AND id_product_attribute = 0 ";
    $con->query($write_sum);

    // II recherche de la somme des stock avec réservations incluses 
    $sum_dispo_req = " SELECT SUM(quantity) FROM ps_stock_available
                 WHERE id_product = '$id_pro' AND id_product_attribute != 0 ";
    $stmt3 = $con->query($sum_dispo_req);
    $row13 = $stmt3->fetch();
    $sum_stock_dispo = $row13[0];
    // echo 'Total des	stocks disponible du produit  = ';
    // echo $sum_stock_dispo;
    // echo '</br>';
    //ecriture du stock total 
    $write_sum = " UPDATE ps_stock_available SET quantity = '$sum_stock_dispo' WHERE id_product = '$id_pro' AND id_product_attribute = 0 ";
    $con->query($write_sum);
}

// ne prend pas en compte les reserves car le produit est neuf, donc pas encore de reserve possible 
// NON utilise 
// function sum_stock($id_pro)
// {
// 	//somme des stock de l'id 
// 	$con = Db::PDO_P();
// 	$sum = " SELECT SUM(quantity) FROM ps_stock_available
//                  WHERE id_product = $id_pro AND id_product_attribute != 0 ";
// 	$stmt = $con->query($sum);
// 	$row12 = $stmt->fetch();
// 	$sum_stock = $row12[0];

//     //ecriture du stock total physical_quantity et quantity
// 	$write_sum = " UPDATE ps_stock_available SET quantity = $sum_stock , physical_quantity = $sum_stock WHERE id_product = $id_pro AND id_product_attribute = 0 ";
// 	$con->query($write_sum);
// 	return $sum_stock;

// }
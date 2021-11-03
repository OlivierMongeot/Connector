<?php
function deleteItem($IdPresta)
{

    $idProdAttributes  = getAllAttributes($IdPresta);
    // var_dump($idProdAttributes);
    foreach ($idProdAttributes as $idProdAttribute) {
        deleteProduct_attribute_shop($idProdAttribute['id_product_attribute'], $IdPresta);
        deleteStock($idProdAttribute['id_product_attribute'], $IdPresta);
        deleteAttributeLayer($idProdAttribute['id_product_attribute'], $IdPresta);
        delete_ps_product_attribute_combination($idProdAttribute['id_product_attribute']);
        $reference = $idProdAttribute['reference'];
        setIdSynchro_stock($reference, 0);
    }
    deletePsProductShop($IdPresta);
    deletePsProductLang($IdPresta);
    deletePsCategoryProduct($IdPresta);
    deletePsProduct($IdPresta);
    deleteAllProduct_attribute($IdPresta);
    return 1;
   }



function getIdPresta($idKezia): int
{
    $sql = "SELECT id_product FROM ps_product_attribute WHERE reference = $idKezia";
    $con = Db::PDO_P();
    $stmt = $con->query($sql);
    $res = $stmt->fetch();
    return (int)$res['id_product'];
}


function  deletePsProduct($IdPresta)
{
    $con = Db::PDO_P();
    $sql = "DELETE FROM ps_product WHERE id_product = $IdPresta";
    $con->exec($sql);
}

function  deletePsProductShop($IdPresta)
{
    $con = Db::PDO_P();
    $sql = "DELETE FROM ps_product_shop WHERE id_product = $IdPresta";
    $con->exec($sql);
}

function  deletePsProductLang($IdPresta)
{
    $con = Db::PDO_P();
    $sql = "DELETE FROM ps_product_lang WHERE id_product = $IdPresta";
    $con->exec($sql);
}

function  deletePsCategoryProduct($IdPresta)
{
    $con = Db::PDO_P();
    $sql = "DELETE FROM ps_category_product WHERE id_product = $IdPresta";
    $con->exec($sql);
}

function isItLastProductAttribute($IdPresta)
{
    $sql = "SELECT COUNT(id_product_attribute) 
    FROM ps_product_attribute WHERE id_product = $IdPresta";
    $con = Db::PDO_P();
    $stmt = $con->query($sql);
    $res = $stmt->fetch();
    return (int)$res[0];
}


function deleteAttributeLayer($idProdAttribute, $IdPresta)
{
    $idAttributeSizeToDelete = getIdAttributeSize($idProdAttribute);
    $canIDeleteTheLayerSize = canIDeleteTheLayerSize($IdPresta, $idAttributeSizeToDelete);
    if ($canIDeleteTheLayerSize == 1) {
        delete_ps_layered_product($idAttributeSizeToDelete, $IdPresta);
        // echo 'Delete Attribut Size : ' . $idAttributeSizeToDelete . '<br>';
    } else {
        // echo 'Pas de suppression sur le Layer car taille néccessaire sur autre couleur<br>';
    }

    $idAttributeColorToDelete = getIdAttributeColor($idProdAttribute);
    $canIDeleteTheLayerColor = canIDeleteTheLayerColor($IdPresta, $idAttributeColorToDelete);
    if ($canIDeleteTheLayerColor == 1) {
        delete_ps_layered_product($idAttributeColorToDelete, $IdPresta);
        // echo 'Delete Attribut Color : ' . $idAttributeColorToDelete . '<br>';
    } else {
        // echo 'Pas de suppression sur le Layer car la Couleur doit etre existante pour une autre taille présente';
    }
}


function canIDeleteTheLayerSize($IdPresta, $idAttributeSizeToDelete)
{
    // Est ce que la taille est utilise par une autre couleur du meme produit 
    // verifier dans ps_attribure_combination si il existe une ou plusieurs autres tailles 
    // Si existe 1  : taille utilisée que par cette couleur donc effacement de la taille du layer 
    // si > 1 : ne pas effacer la taille du layer car utilise par une autre couleur.  
    $con = Db::PDO_P();
    $sql = "SELECT COUNT(ps_product_attribute_combination.id_attribute) FROM ps_product_attribute_combination 
    JOIN ps_product_attribute 
    ON ps_product_attribute.id_product_attribute = ps_product_attribute_combination.id_product_attribute
   
    WHERE ps_product_attribute_combination.id_attribute = $idAttributeSizeToDelete AND ps_product_attribute.id_product = $IdPresta";
    $sth = $con->query($sql);
    $res = $sth->fetch();
    // echo 'Nombre d\'attribut(s) existant(s) de cette taille : ';
    // echo $res[0];
    // echo '<br>';
    return $res[0];
}


function canIDeleteTheLayerColor($IdPresta, $idAttributeColorToDelete)
{
    $con = Db::PDO_P();
    $sql = "SELECT COUNT(ps_product_attribute_combination.id_attribute) FROM ps_product_attribute_combination 
    JOIN ps_product_attribute 
    ON ps_product_attribute.id_product_attribute = ps_product_attribute_combination.id_product_attribute
   
    WHERE ps_product_attribute_combination.id_attribute = $idAttributeColorToDelete AND ps_product_attribute.id_product = $IdPresta";
    $sth = $con->query($sql);
    $res = $sth->fetch();
    // echo 'Nombre d\'attribut(s) existant(s) de cette Couleur : ';
    // echo $res[0];
    // echo '<br>';
    return $res[0];
}


function deleteProduct_attribute($reference, $IdPresta)
{
    $con = Db::PDO_P();
    $sql = "DELETE FROM ps_product_attribute WHERE reference = $reference AND id_product = $IdPresta";
    $con->exec($sql);
}

function deleteAllProduct_attribute($IdPresta)
{
    $con = Db::PDO_P();
    $sql = "DELETE FROM ps_product_attribute WHERE id_product = $IdPresta";
    $con->exec($sql);
}



function delete_ps_product_attribute_combination($idProdAttribute)
{
    $con = Db::PDO_P();
    $sql = "DELETE FROM ps_product_attribute_combination WHERE id_product_attribute = $idProdAttribute";
    $con->exec($sql);
}


function  deleteProduct_attribute_shop($idProdAttribut, $IdPresta)
{
    $con = Db::PDO_P();
    $sql = "DELETE FROM ps_product_attribute_shop WHERE id_product_attribute = $idProdAttribut AND id_product = $IdPresta";
    $con->exec($sql);
}

function deleteStock($idProdAttribut, $IdPresta)
{
    $con = Db::PDO_P();
    $sql = "DELETE FROM ps_stock_available WHERE id_product_attribute = $idProdAttribut AND id_product = $IdPresta";
    $con->exec($sql);
}

function delete_ps_layered_product($idAttribut, $IdPresta)
{
    $con = Db::PDO_P();
    $sql = "DELETE FROM ps_layered_product_attribute WHERE id_attribute = $idAttribut AND id_product = $IdPresta";
    $con->exec($sql);
}


function getIdAttributeSize($idProdAttribute)
{
    $con = Db::PDO_P();
    $sql = "SELECT ps_product_attribute_combination.id_attribute
    FROM ps_product_attribute_combination 
    JOIN ps_attribute 
    ON ps_product_attribute_combination.id_attribute = ps_attribute.id_attribute
    WHERE ps_attribute.id_attribute_group != 2 
    AND ps_product_attribute_combination.id_product_attribute = $idProdAttribute";
    $sth = $con->query($sql);
    $res = $sth->fetch();
    // echo 'ID ATT SIZE : ';
    // echo ($res[0]);
    // echo '<br>';
    return (int)$res['id_attribute'];
}

function getIdAttributeColor($idProdAttribute)
{
    $con = Db::PDO_P();
    $sql = "SELECT ps_product_attribute_combination.id_attribute
    FROM ps_product_attribute_combination 
    JOIN ps_attribute 
    ON ps_product_attribute_combination.id_attribute = ps_attribute.id_attribute
    WHERE ps_attribute.id_attribute_group = 2 
    AND ps_product_attribute_combination.id_product_attribute = $idProdAttribute";
    $sth = $con->query($sql);
    $res = $sth->fetch();
    // echo 'ID ATT COLOR : ';
    // echo ($res[0]);
    // echo '<br>';
    return (int)$res['id_attribute'];
}


function getAllAttributes($idprod)
{
    $sql = "SELECT id_product_attribute, reference FROM ps_product_attribute WHERE id_product = $idprod";
    $con = Db::PDO_P();
    $sth = $con->query($sql);
    return $sth->fetchAll();
}

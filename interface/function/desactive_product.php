
<?php





function desactive_prod( $id_prod, $state )
{
$con = ConBdPresta();
$sql = "UPDATE ps_product SET active = '$state' WHERE id_product = '$id_prod'";
$set = $con->query($sql);
$sql = "UPDATE ps_product_shop SET active = '$state' WHERE id_product = '$id_prod'";
$set = $con->query($sql);

}









<?php

#############  TEST #########################
include 'Kezia_BDD.php';


$table_1 = "web_commande";
$colone_1 = "city";
$id_1 = 5;  
$value = "Miami3";
update($table_1 , $colone_1  , $id_1 ,  $value );

# function update($table, $colone, $id, $adr1 ){
try {
	
$con = ConBdPresta();
$requete = "
UPDATE $table 
SET $colone = '$adr1' 
WHERE id_order_detail = '$id'
";

$stmt = $con->query($requete);

}
catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }


#################################################################

$tbl = `web_commande`; 
$col = `NO_WEB`;
$dir = 'DESC';

function getAll($tble){
		
		$con = ConBdTampon();
		$requete = "SELECT * FROM $tble ORDER BY $tble.`NO_WEB` DESC";
		$rows = $con->query($requete);
		return $rows;
}


getAll($tbl);

?>
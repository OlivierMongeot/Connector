<?php

include 'Kezia_BDD.php';

# Voir si index de id order detail à bouger
# Si oui voir combien de nouvelles row
#Identifer les raw à updatez
#Lecture de 1 raw x sur id_order_detail  
#Ecriture de 1 raw x sur web_command  (en cours)
# a faire 3 x car les donnéees son sur 3 tables



$table_1 = "web_commande";
$colone_1 = "city";
$id_1 = 1;  
$value = "Paris";

update($table_1 , $colone_1  , $id_1 ,  $value );

# UPDATE ONE VALUE  
function update($table, $colone, $id, $adr1 ){

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
}


?>
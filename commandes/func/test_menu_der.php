

<?php

include 'Kezia_BDD.php';

	$req="SELECT VILLE FROM web_commande";

	$res=ConBdTampon();

	echo '<select name="myname">';

$stmt = $res->query($req);


while ($donnees = mysql_fetch_array($stlt)){
echo '<option value="'.$donnees['VALEUR'].'">'.$donnees['VALEUR'].'</option>';
}

echo '</select>';


?>
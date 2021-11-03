<html>
<meta charset="utf-8" />
<head>
    <title>PrestaKez</title>
    <script type="text/javascript" src="ajax.js"></script>
    <link href="../style.css" rel="stylesheet" media="all" type="text/css">
    <link rel="icon" type="image/png" href="../images/favicon-32x32.png" sizes="32x32" />
</head>


<?php
include 'Kezia_BDD.php';

$bdd = ConBdStreet();


$villes = $bdd->query('SELECT ville_nom_reel FROM villes_france_free ORDER BY ville_nom_reel DESC');

$code_p = $bdd->query('SELECT ville_nom_reel FROM villes_france_free ORDER BY ville_code_postal DESC');

$trigger = 0;



if(isset($_GET['q']) AND !empty($_GET['q'])) {

   $q = htmlspecialchars($_GET['q']);

   $villes = $bdd->query('SELECT ville_nom_reel FROM villes_france_free WHERE ville_nom_reel LIKE "%'.$q.'%" ORDER BY ville_id ASC');
   $trigger = 1;

   if($villes->rowCount() == 0) {
      $villes = $bdd->query('SELECT ville_nom_reel FROM villes_france_free WHERE CONCAT(ville_nom_reel, ville_nom_simple) LIKE "%'.$q.'%" ORDER BY ville_id ASC');
   }
}

if(isset($_GET['cp']) AND !empty($_GET['cp'])) {

   $cp = htmlspecialchars($_GET['cp']);

   $code_p = $bdd->query('SELECT villes_france_free.ville_nom_reel, villes_france_free.ville_code_postal FROM villes_france_free WHERE ville_code_postal = "$cp" ORDER BY ville_nom_reel ASC');
   $trigger = 2;

   if($code_p->rowCount() == 0) {
      
      $code_p = $bdd->query('SELECT villes_france_free.ville_nom_reel, villes_france_free.ville_code_postal FROM villes_france_free WHERE ville_code_postal LIKE "%'.$cp.'%" ORDER BY ville_nom_reel ASC');
   }
}



?>
<form method="GET">
   <input type="search" name="q" placeholder="Recherche par ville..." />
   <input type="submit" value="Valider" />
</form>
<form method="GET">
   <input type="search" name="cp" placeholder="Recherche par Code Postal..." />
   <input type="submit" value="Valider" />
</form>




<?php

if ($trigger == 1) {
                        if($villes->rowCount() > 0) { ?>
                           <div id="container4"><ul>
                           <?php while($a = $villes->fetch()) { ?>
                              <li><?= $a['ville_nom_reel'] ?></li>
                           <?php } ?>
                           </ul></div>
                        <?php } else { 
                        ?>
                        Aucun résultat pour: <?= $q 
                        ?>...<?php } 

}

 

if ($trigger == 2) {


if($code_p->rowCount() > 0) { ?>
   <div id="container4"><ul>
   <?php while($a = $code_p->fetch()) { ?>
      <li><tb><?= $a['ville_nom_reel'] ?> : <?= $a['ville_code_postal'] ?></tb></li>

   <?php } ?>
   </ul></div>
<?php } else { 
?>
Aucun résultat pour: <?= $cp 
?>...<?php } 

} else {
   echo 'rien';
}





?>
</html>
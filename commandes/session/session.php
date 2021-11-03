<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start ();

// On récupère nos variables de session
if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {

	// On teste pour voir si nos variables ont bien été enregistrées

echo '<?xml version="1.0" encoding="UTF-8"?>';

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
	
	echo '<html>';
	echo '<meta charset="UTF-8">';

	echo '<head>';
	echo '<link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />';
	echo '<title>Presta Kez</title>';
	echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
	echo '<meta name="mobile-web-app-capable" content="yes">';
	echo '</head>';

	echo '<body>';
	#echo 'Votre login est '.$_SESSION['login'].' et votre mot de passe est '.$_SESSION['pwd'].'.';
	#echo '<br />';

	// On affiche un lien pour fermer notre session
	echo '<div id="container3"><a href="./session/log_out.php">Déconnection</a></div>'    ;
}
else {
	echo '<meta http-equiv="refresh" content="0;URL=index.htm">';
	echo 'Les variables ne sont pas déclarées.';
}
?>
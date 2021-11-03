<?php

include 'Kezia_BDD.php';

function getIdPresta() {
	
	$bdd = ConBdPresta();
	
	$requete ="
	SELECT MAX(id_order_detail) 
	FROM ps_order_detail";
	
	$req = $bdd->query($requete);
	
	$result = $req->fetch();
	
	$IdMaxPresta = $result[0];
	
	echo $IdMaxPresta;
		}	

getIdPresta();

function getIdTampon() {
	
	$bdd = ConBdTampon();
	
	$requete ="
	SELECT MAX(NO_WEB) 
	FROM web_commande";
	
	$req = $bdd->query($requete);
	
	$result = $req->fetch();
	
	$IdMaxTampon = $result[0];
	
	echo $IdMaxTampon;
		}	

getIdTampon();



?>
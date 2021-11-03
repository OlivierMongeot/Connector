<?php
 	
INCLUDE 'func/Kezia_BDD.php';

function getAllusers(){
		
		$con = ConBdTampon();
				
		$requete = "SELECT * FROM `web_commande` ORDER BY `web_commande`.`NO_WEB` DESC";
		
		$rows = $con->query($requete);
		return $rows;
}

function createUser($code_web, $liv, $adr1, $adr2, $cp, $ville, $pays, $datecde, $port, $mode_de_reglement, $nota, $traite){
try {
			$con = ConBdTampon();
			$sql = $con->prepare(
			"INSERT INTO 
			web_commande
			(CODE_WEB, 
			LIV, 
			ADR1, 
			ADR2, 
			CP, 
			VILLE, 
			PAYS, 
			DATECDE, 
			PORT, 
			MODE_DE_REGLEMENT, 
			NOTA, 
			TRAITE)
			VALUES 
			(:cdweb,
			:livre,
			:addr1,
			:addr2,
			:cpw,
			:town,
			:country,
			:datec,
			:ports,
			:paye,
			:notes,
			:states)"
			);

			$sql->bindParam(':cdweb',$code_web);
			$sql->bindParam(':livre',$liv);
			$sql->bindParam(':addr1',$adr1);
			$sql->bindParam(':addr2',$adr2);
			$sql->bindParam(':cpw',$cp);
			$sql->bindParam(':town',$ville);
			$sql->bindParam(':country',$pays);
			$sql->bindParam(':datec',$datecde);
			$sql->bindParam(':ports',$port);
			$sql->bindParam(':paye',$mode_de_reglement);
			$sql->bindParam(':notes',$nota);
			$sql->bindParam(':states',$traite);

	    	$sql->execute();
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
}

function readUser($id){
	
	$con = ConBdTampon();
	$requete = "
	
	SELECT
	* FROM 
	web_commande
	where
	NO_WEB ='$id'
	";
	
	$stmt = $con->query($requete);
	
	$row = $stmt->fetchAll();
	
	if (!empty($row)) {
		return $row[0];
	}

}
//met à jour le user
function updateUser($id, $code_web, $liv, $adr1, $adr2, $cp, $ville, $pays, $datecde, $port, $mode_de_reglement, $nota, $traite) {
		try {
			$con = ConBdTampon();
			$requete = "UPDATE web_commande 
						set 
						CODE_WEB = '$code_web',
						LIV = '$liv',
						ADR1 = '$adr1',
						ADR2 = '$adr2',
						CP = '$cp',
						VILLE = '$ville',
						PAYS = '$pays',
						DATECDE = '$datecde',
						PORT = '$port',
						MODE_DE_REGLEMENT = '$mode_de_reglement',
						NOTA = '$nota',
						TRAITE ='$traite'
						where
						NO_WEB = '$id' ";
	
			$stmt = $con->query($requete);
		}
	    catch(PDOException $e) {
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}
// suprime un user
	function deleteUser($id) {
		try {
			$con = ConBdTampon();
			$requete = "DELETE FROM web_commande where NO_WEB = '$id' ";
			$stmt = $con->query($requete);
		}
	    catch(PDOException $e) {
	    	echo $requete . "<br>" . $e->getMessage();
	    }
	}


function getNewUser() {
		$user['id'] = "";
		$user['code_web'] = "";
		$user['liv'] = "";
		$user['adr1'] = "";
		$user['adr2'] = "";
		$user['cp'] = "";
		$user['ville'] = "";
		$user['pays'] = "";
		$user['datecde'] = "";
		$user['port'] = "";
		$user['mode_de_reglement'] = "";
		$user['nota'] = "";
		$user['traite'] = "";
		
	}

?>
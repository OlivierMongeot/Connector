<?php
 	
function ConBdPresta()
{
	try 
		{
		    	$servername = "localhost";
	    		$user1 = "root";
				$pass = "AbpH6Mv5F6cQe";
				// $pass = "";
    			$db_name = "prestashop";
				$pdo = new PDO("mysql:host=$servername;dbname=$db_name;charset=utf8", $user1, $pass);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $pdo;
		} 	
	catch (PDOException $e) 
		{
			print "Erreur !: " . $e->getMessage() . "<br/>";
		    die();
		}
}


function ConBdTampon()
{
	try 
		{
		    	$servername = "localhost";
	    		#$servername = "91.216.107.164";
	    		$user1 = "root";
	    		#$user1 = "custo1230104";
				$pass = "AbpH6Mv5F6cQe";
				// $pass = "";
    			#$pass = "hp6i6lzgtr";
    			$db_name = "tampon";
    			#$db_name = "custo1230104";	
				$pdo = new PDO("mysql:host=$servername;dbname=$db_name;charset=utf8", $user1, $pass);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $pdo;
		} 	

	catch (PDOException $e) 
		{
			print "Erreur !: " . $e->getMessage() . "<br/>";
		    die();
		}
}


?>
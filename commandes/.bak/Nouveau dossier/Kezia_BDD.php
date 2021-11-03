<?php
 	
function ConBdPresta()
{
	try 
		{
		    	$servername = "localhost";
	    		$user1 = "root";
    			$pass = "x6FDJtF5pctooBBy";
    			$db_name = "presta_og_store";
			$pdo = new PDO("mysql:host=$servername;dbname=$db_name", $user1, $pass);
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
	    		$user1 = "root";
    			$pass = "x6FDJtF5pctooBBy";
    			$db_name = "presta_kezia_tampon2";
			$pdo = new PDO("mysql:host=$servername;dbname=$db_name", $user1, $pass);
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
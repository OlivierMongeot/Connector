<html>
<head>
    <meta charset="UTF-8">
    <title>PrestaKez</title>
   <link href="style.css" rel="stylesheet" media="all" type="text/css"> 
</head>

<body>

<?php

$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$mail = $_POST["mail"];
$password = $_POST["password"];


$user = "root";
$pass = "x6FDJtF5pctooBBy";
$db_name = "presta_test";
$table_3 = "name";
$servername = "localhost";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $user, $pass);
    // set the PDO error mode to exception
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO $table_3 (firstname, lastname, email, password)
    VALUES ('$prenom', '$nom', '$mail', '$password')";
    
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
<br /><br />

<a href="Kezia_one_1.1.php">RETOUR HOME</a>

</body>

</html>
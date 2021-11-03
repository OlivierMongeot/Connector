<?php
include 'session/session.php';
?>

<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>PrestaKez</title>
<link href="style.css" rel="stylesheet" media="all" type="text/css">
	</head>
<body>
<?php

include 'Menu/menu.php';
include 'func/Kezia_func.php';
include 'func/Kezia_insert.php';

select_webcommande();  # dans ../func/Kezia-insert 

?>
</body>
</html>
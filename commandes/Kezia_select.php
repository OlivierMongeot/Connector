<?php
include 'session/session.php';
include 'Menu/menu.php';
?>
<html>
<meta charset="UTF-8">
<head>
    <title>PrestaKez</title>
    <script type="text/javascript" src="ajax.js"></script>
    <link href="style.css" rel="stylesheet" media="all" type="text/css">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
</head>
<body>
    <?php


echo '<h2>SYNCHRONISATION DES COMMANDES</h2>';

?>
</br>
      <div id="container">  <a href="" onclick="gestionClic(); return false;">
            Synchroniser les commandes
        </a></div></br>
  

   
<div id="container">  <a href="" onclick="gestionClic_2(); return false;">
            Synchroniser les clients
        </a></div></br>


  	 <div id="resultat">&nbsp;</div>
    </body>
</html>

<?php
?>



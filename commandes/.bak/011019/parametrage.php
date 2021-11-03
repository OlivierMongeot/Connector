<html>
<meta charset="UTF-8">
<head>
    
    <title>PrestaKez</title>
<link href="style.css" rel="stylesheet" media="all" type="text/css"> 
<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
<script type="text/javascript">
    function afficher()
    {
        alert("Yo ca gaze ?");

    }   
</script> 
</head>

<body>
<?php
include 'Kezia_func.php';
include 'Kezia_insert.php';
include 'menu.php';
server_info()
?>
</br></br>
    <h2>Entrée de donnés en BDD : </br></br>
         <form action="formulaire.php" method="POST">
        
            Nom
            <input type="text" name="nom" required="required"/>
            Prenom
            <input type="text" name="prenom" required="required"/>
            Mail
            <input type="text" name="mail" required="required"/>
            Password
            <input type="text" name="password" required="required"/>
            <input type="submit" value="Valider" />
        
    </form></h2>

             
    </br>
    <?php
    # bouton javascrpit 
    echo '<form><input type="submit" name="valider" value="Test JavaScrpt" onclick="afficher();"></form>';
     ?>
        </body>
</html>
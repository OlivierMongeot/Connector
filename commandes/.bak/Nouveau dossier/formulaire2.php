<html>
<body>
    <p>
        Cette page ne contient que du HTML.<br />
        Veuillez taper votre prénom :
    </p>
    
<?php
$nom = $_GET["nome"];
echo 'Bonjour'.$nom.'!';
?>

    <form action="test2.php" method="GET">
        <p>
            <input type="text" name="nome" />
                   
            <input type="submit" value="Valider" />
        </p>
    </form>
</body>

</html>

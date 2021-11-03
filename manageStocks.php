<html>

<head>
    <title>MAJ STOCK</title>
</head>

<body>
    <!-- ultimate -->
    <?php

    include 'interface/menu.php';
    include 'function/Db.php';
    include 'function/function_stock.php';

    if (isset($_GET['action']) && $_GET['action'] == 'stockUpdate') {
        // var_dump($_GET)
        $res = updateAllStocks();
        // test();
    }

    ?>

    <?php if (isset($res) && $res == 1) : ?>
        <div class="container">
            <div class="alert alert-success" role="alert">
                <?= 'Mise à jour du stock effectuée' ?>
            </div>
        </div>
    <?php endif ?>

    <?php if (isset($res) && $res != 1) : ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                <?= 'Problème dans la Mise à jour du stock' ?>
            </div>
        </div>
    <?php endif ?>

    <div class="container">
        <p>
            La mise à jour automatique du stock est effectué tous les jours à 04h00 du matin.<br>
            Vous pouvez mettre à jour manuellement en cliquant ci-dessous :
        </p>
        <a href="manageStocks.php?&action=stockUpdate" class="btn btn-danger btn-xs active" style="display:flex; justify-content:center;" role="button">
            Mise à jour manuel du Stock
        </a>

    </div>
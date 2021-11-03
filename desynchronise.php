<html>

<head>
    <title>Désynchronise</title>
</head>

<body>
    <?php
    include 'interface/menu.php';
    //CONFIG 
    // include 'function/Kezia_BDD.php';
    include 'function/Db.php';
    include 'function/function_prepare.php';
    include 'function/function_delete.php';



    // var_dump($items); 
    if (isset($_GET['id']) && isset($_GET['action']) && isset($_GET['idPresta'])) {
        // var_dump($_GET);
        $res = deleteItem((int)$_GET['idPresta']);
    }

    if (isset($res) && $res == 1 ) : ?>
        <div class="alert alert-success" role="alert">
            <?= 'Article '. $_GET['idPresta'] .' suprimé de Prestashop et réinitialisé' ?>
        </div>
       
    <?php endif ?>

    <?php

    $items =  AgregateNamebyIdSynchro(1);
    ?>
    <div class="container">

        <div class="row">

            <!-- <div class="table-container"> -->
            <table id="header-fixed" class="table table-bordered table-striped table-highlight">
                <thead>
                    <tr class="menu">
                        <th id="center">ID KEZIA</th>
                        <th id="center1">ARTICLES</th>
                        <th id="center">ID PRESTASHOP </th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $article) : ?>
                        <tr>
                            <td id="center"># <?= $idK = $article['IDART'] ?></td>
                            <td id="center"><?= $article['id_name'] ?></a></td>
                            <td id="center"><?= $idP = getIdPresta($article['IDART']); ?></a></td>
                            <td id="center">
                                <a href="/connector/desynchronise.php?id=<?= $idK . '&idPresta=' . $idP . '&action=del' ?>" class="btn btn-danger btn-xs active" style="display:flex; justify-content:center;" role="button">
                                    DESYNCHRONISE
                                </a>
                            </td>

                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- </div> -->
        </div>

    </div>
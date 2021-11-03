<html>

<head>
    <title>Repare Products</title>
</head>

<body>

    <?php
    include 'interface/menu.php';
    include 'function/function_prepare.php';
    include 'function/Db.php';

    function checkifStillExistOnKezia($itemsPresta)
    {
        foreach ($itemsPresta as $item) {
            // var_dump($item);
            // Voir li l'idart existe sur Kezia 
            $reference = $item['reference'];
            $IdPresta = $item['id_product'];
            $idProdAttribute = $item['id_product_attribute'];
            $sql = "SELECT IDART FROM WEB_ARTICLE WHERE IDART = :idArt ";
            $con = DB::PDO_T();
            $stmt = $con->prepare($sql);
            $stmt->execute(['idArt' => $reference]);
            $res = $stmt->fetch();
            if ($res === false) {
                echo '<br>IDART Kezia  :';
                echo $reference;
                echo '<br>Pas de Correspondance sur Kezia';
                echo '<br>Pour l\'ID Prestashop : ';
                echo  $IdPresta;
                echo '<br>ID PROD ATTRIBUTE :';
                echo $idProdAttribute;
                echo '<br>';
                echo 'Supression de l\'attribut<br>';

                 $lastProdAtribute = isItLastProductAttribute($IdPresta);
                // deleteProduct_attribute_shop($idProdAttribute, $IdPresta);
                // deleteStock($idProdAttribute, $IdPresta);
                // deleteAttributeLayer($idProdAttribute, $IdPresta);
                // deleteProduct_attribute($reference, $IdPresta);
                // delete_ps_product_attribute_combination($idProdAttribute);


                if ($lastProdAtribute <= 1) {
                    // Delete all Complete Product 
                    // deletePsProductShop($IdPresta);
                    // deletePsProductLang($IdPresta);
                    // deletePsCategoryProduct($IdPresta);
                    // deletePsProduct($IdPresta);
                    echo '<br>Suppression Complete<br>';
                } else {
                    echo '<br>Supression Partielle';
                }
                echo '<br>Suppression OK';
                echo '<br>';
            }
        }
    }

    function listItemsPrestaToCheck()
    {
        $sql = " SELECT reference, id_product_attribute, id_product 
        FROM ps_product_attribute  WHERE reference > 0";
        $con = DB::PDO_P();
        $stmt = $con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchall();
    }

    function checkIdName()
    {
        $sql = 'SELECT id_name, DESIGNATION, IDART FROM WEB_ARTICLE';
        $pdo = DB::PDO_T();
        $sth = $pdo->query($sql);
        $items = $sth->fetchAll();
        foreach ($items as $item) {
            $designationParsed = parse_name($item['DESIGNATION']);
            $idart = $item['IDART'];
            $idName = $item['id_name'];

            // if (trim($designationParsed) != $idName){
            //     // echo 'Designation Parsed 1:';
            //     // echo $designationParsed.'<br>';
            //     // echo strlen($designationParsed).'<br>';

            //     echo 'Designation Parsed 2:';
            //     echo trim($designationParsed).'<br>';
            //     echo strlen(trim($designationParsed)).'<br>';
            //     echo 'ID NAME :';
            //     echo $idName.'<br>';
            //     echo strlen(trim($idName)).'<br>';
            //     echo 'Différence anormale trouvée : id '. $item['IDART'] .'<br><br>';
            // }

            $res = strcmp(trim($designationParsed), trim($idName));
            if ($res  !== 0) {
                echo 'ID  :';
                echo $idart . '<br>';
                var_dump($res);
                echo "$designationParsed n'est pas égal à $idName par comparaison sensible à la casse.<br><br>";
                // set_short_name( $idart, $designationParsed);
            }
        }
        echo 'Fin de la vérification';
    }

    function repareIdSynchroBaseWebArticle()
    {
        $ProductsToCheck = selectAllIDFromWebArticle(1);
        // var_dump($ProductsToCheck );
        foreach ($ProductsToCheck as $ProductToCheck) {
            $id =  $ProductToCheck['IDART'];
            $name = $ProductToCheck['DESIGNATION'];
            // var_dump($id);
            $res = getIdProductPrestashop($id);
            if ($res === false) {
                echo 'Présent sur Kezia / Pas sur Presta : ' . $id . ' - ' . $name . ' Set ID sync to 0<br>';
                // set_id_synchro_zero($id);
            } 
        }
    }

    function selectAllIDFromWebArticle($idSynchro)
    {
        $sql = "SELECT IDART, DESIGNATION, id_synchro FROM WEB_ARTICLE WHERE id_synchro = $idSynchro ORDER BY IDART ASC";
        $con = Db::PDO_T();
        $res = $con->query($sql);
        return $res->fetchAll();
    }

    function selectAllIDFromWebArticleIsNot($idSynchro)
    {
        $sql = "SELECT IDART, DESIGNATION, id_synchro FROM WEB_ARTICLE WHERE id_synchro != $idSynchro ORDER BY IDART ASC";
        $con = DB::PDO_T();
        $res = $con->query($sql);
        return $res->fetchAll();
    }

    function getIdProductPrestashop($idart)
    {
        $sql = "SELECT id_product_attribute, id_product, reference 
        FROM ps_product_attribute WHERE reference = $idart";
        $con = DB::PDO_P();
        $res = $con->query($sql);
        return $res->fetch();
    }

    function set_id_synchro_zero($id)
    {
        $con = DB::PDO_T();
        $sql = "UPDATE WEB_ARTICLE SET id_synchro = 0 WHERE IDART = '$id' 
		";
        $con->query($sql);
    }

    function toogleIdSynchroByIdSynchro($ActualId, $idWanted)
    {
        $con = DB::PDO_T();
        $sql = "UPDATE WEB_ARTICLE 
        SET id_synchro = $idWanted WHERE id_synchro = '$ActualId' 
		";
        $con->query($sql);
    }

    function checkIfStatusOneIsRespectedid()
    {
        $ProductsToCheck = selectAllIDFromWebArticleIsNot(1);
        foreach ($ProductsToCheck as $ProductToCheck) {
            $id =  $ProductToCheck['IDART'];
            $name = $ProductToCheck['DESIGNATION'];
            $res = getIdProductPrestashop($id);
            if ($res !== false) {
                echo 'Correspondance Presta - Kezia : ' . $id . ' - ' . $name . '<br>';
                // setIdSynchro_stock($id, 1);
                echo 'On basucle en 1<br>';
            }
        }
    }



    function sanitizePsProductAttribute()
    {
        $sql = "SELECT COUNT(reference) AS nbr_doublon, reference, id_product FROM ps_product_attribute WHERE reference > 0
        GROUP BY reference
        HAVING nbr_doublon > 1";
        $con = DB::PDO_P();
        $sth = $con->query($sql);
        $results = $sth->fetchAll();
        // var_dump($results);
        // var_dump($results['id_product']);
        foreach ($results as $result){
            //Vérifier si le produit est inscrit dans ps_product -> si non alors delete
             var_dump($result);
             echo '<br>';
             var_dump($result['reference']);
             echo '<br>';
            //  deleteItem($result['id_product']);
        }
    }


    function deleteDoublonOnWeb(){
        $sql = "SELECT COUNT(name) AS nbr_doublon, reference, name, ps_product_lang.id_product FROM ps_product_lang
        INNER JOIN ps_product ON ps_product.id_product = ps_product_lang.id_product
        GROUP BY name
        HAVING COUNT(name) > 1";
        $con = DB::PDO_P();
        $sth = $con->query($sql);
        $results = $sth->fetchAll();
        // var_dump($results);
        foreach ($results as $res){
            var_dump($res);
            echo '<br><br>';
        }
        if ($results){
            // deleteItem($results[0]['id_product']);
        }
    }


    
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        // var_dump($name_checked);
        if ($action == 'checkzero') {
            echo 'REPARE ZERO<br>';
            repareIdSynchroBaseWebArticle();
        }
        if ($action == 'checkone') {
            echo 'REPARE ONE<br>';
            checkIfStatusOneIsRespectedid();
        }
        if ($action == 'idname') {
            echo 'REPARE ID NAME<br>';
            checkIdName();
        }
        if ($action == 'delete') {
            echo 'Delete product prestashop who are supressed from Kezia<br>';
            $itemsPresta = listItemsPrestaToCheck();
            checkifStillExistOnKezia($itemsPresta);
        }
        if ($action == 'sanitize') {
            // echo 'Supprime articles non effacés correctement de la base Prestashop<br>';
            sanitizePsProductAttribute();
        }
        if ($action == 'deldblpresta') {
            // echo 'Supprime articles non effacés correctement de la base Prestashop<br>';
            deleteDoublonOnWeb();
        }

    }
    ?>

<br>
    <div class="container">
        <a href="reparation.php?action=checkzero" class="btn btn-danger btn-xs active" style="display:flex; justify-content:center;" role="button">
            Check Status Zéro for UnSynchro Items 
        </a>
        <br>
        <a href="reparation.php?action=checkone" class="btn btn-danger btn-xs active" style="display:flex; justify-content:center;" role="button">
            Check Status One for Synchro Items
        </a>  <br>
        <a href="reparation.php?action=idname" class="btn btn-danger btn-xs active" style="display:flex; justify-content:center;" role="button">
            Check all ID name bug 
        </a>  <br>
        <a href="reparation.php?action=delete" class="btn btn-danger btn-xs active" style="display:flex; justify-content:center;" role="button">
            Delete Unuse Prestashop Items
        </a>
        <br>
        <a href="reparation.php?action=sanitize" class="btn btn-danger btn-xs active" style="display:flex; justify-content:center;" role="button">
            Supprime aricles non effacés correctement de la base Prestashop
        </a> <br>
        <a href="reparation.php?action=deldblpresta" class="btn btn-danger btn-xs active" style="display:flex; justify-content:center;" role="button">
            Supprime doublon name de Prestashop de ps_lang
        </a> <br>
        
    </div>
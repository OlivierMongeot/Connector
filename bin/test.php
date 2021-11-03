<html>

<head>
    <title>Prepare Products</title>
</head>

<body>
    <?php
    ini_set('display_errors', 'on');
    //CONFIG 
    include 'function/Kezia_BDD.php';
    include 'function/switcher.php';
    //PREPARATION
    include 'function/prepare_list.php';
    // include 'function/function_prepare.php';
    //CREATION
    // include 'create_simple_product.php';
    include 'function/create_declinate_product.php';
    include 'function/create_additionnal_attribut.php';
    include 'function/function_create_product.php';
    include 'function/function_pre_seo.php';

    // $id_prodPresta = 934;
    // $name_checked = get_first_short_name_article();
    // $rows = rowsToSynchronise($name_checked);
    // $sizeKezia = (getAllSizes($rows));

    function checkIfSamePriceThatExistingProd($name)
    {
        $con = ConBdTampon();
        $sql = "SELECT PRIX_TTC FROM WEB_ARTICLE WHERE id_name = :named ";
        $stmt = $con->prepare($sql);
        $stmt->execute(['named' => $name]);
        $num = $stmt->fetchall();
        foreach ($num as $n) {
            $tabPrice[] = $n['PRIX_TTC'];
        }
        return count(array_unique($tabPrice));
    }

    // $colorKezia  = (getAllColors($rows));
    // foreach ($colorKezia as $color) {
    //     // taille = attribute 
    //     $colorsPresta[] = switch_couleur($color);
    // }

    // var_dump($colorsPresta);

    // $sizeKezia = (getAllSizes($rows));
    // foreach ($sizeKezia as $size) {
    //     // taille = attribute 
    //     $sizesPresta[] = switch_taille($size);
    // }

    // var_dump($sizesPresta);
    // $res = array_unique(array_merge(GetAllSizeInstalled($id_prodPresta),$sizesPresta), SORT_REGULAR);

    // var_dump($res);
    ?>
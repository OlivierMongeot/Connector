<html>

<head>
    <title>Doublon Products</title>
  
</head>

<body>

    <?php
    include 'interface/menu.php';
    include 'function/Db.php';
    include 'function/Kezia_BDD.php';
    include 'function/function_prepare.php';
    include 'function/switcher.php';
    include 'function/function_refused.php';
   
    if (isset($_GET['action']) && $_GET['action'] == 'recheck' &&  isset($_GET['id'])) {
        setIdSynchro_stock($_GET['id'], 0);
    }
	
	 if (isset($_GET['action']) && $_GET['action'] == 'desactive'&& isset($_GET['id'])) {
        setIdSynchro_stock($_GET['id'], 65);
    }

    $rows = ItemsByIdSynchro(33);
    ?>
    <div class="container">
        <table  id="header-fixede" class="table table-striped header-fixed">
            <thead>
                <tr>
                    <h1>DOUBLON A CORRIGER DANS KEZIA</h1>
                </tr>
                <tr>
                    <th >ID</th>
                    <th class="morewide4">ARTICLES</th>
                    <th>COULEUR</th>
                    <th>TAILLE</th>
                    <th>PRIX</th>
                    <th>RAYON</th>
                    <th>FAMILLE</th>
                    
                    <th id="morewide2">ACTION</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?= $row['IDART'] ?></td>
                        <td  class="morewide4"> <?= $row['DESIGNATION'] .'<br>'.getColorBugNamePrice($row['id_synchro'])  ?> </a></td>
                        <td  > <?= getNameAttribute(switch_couleur($row['IDCOULEUR'])) ?> </a></td>
                        <td > <?= getSizeForRefusedProduct($row['IDTAILLE'],$row['IDRAY'], $row['id_synchro']) ?> </a></td>
                        <td > <?= $row['PRIX_TTC'] ?> €</a></td>

                        <td > <?= getRayonName(switch_rayon($row['IDRAY']))  ?> </a></td>
                        <td > <?= getFamilleName(switch_cat($row['IDFAM'])) ?> </a></td>           
                        <td id="morewide" >
                        <a href="doublonProd.php?id=<?= $row['IDART'] ?>&action=recheck" 
                        class="btn btn-warning btn-xs active refused"  role="button">Réactiver</a>

                        <a href="doublonProd.php?id=<?= $row['IDART'] ?>&action=desactive" 
                        class="btn btn-secondary btn-xs active refused" role="button">Désactiver</a>
						
						</td>
                    
					</tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
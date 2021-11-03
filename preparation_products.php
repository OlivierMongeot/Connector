<html>

<head>
   <title>Prepare Products</title>
</head>

<body>
   <?php
   include 'interface/menu.php';
   //DB
   include 'function/Kezia_BDD.php';
   include 'function/Db.php';

   include 'function/switcher.php';
   //PREPARATION
   // include 'function/prepare_list.php';
   include 'function/function_stock.php'; 
   include 'function/function_prepare.php';
   //CREATION
   include 'precreateproduct.php';
   include 'function/create_declinate_product.php';
   include 'function/create_additionnal_attribut.php';
   include 'function/function_create_product.php';
   include 'function/function_pre_seo.php';

   // ajout 10/02
   include 'function/CheckNewItems.php';
   // Check New product 10/02 
   $news = new CheckMovementItems;
   $news-> checkMove();
  
   // I ECRITURE DU NOM UNIQUE DANS LA DERNIERE COLONES BASE TAMPOM 
   // POUR CLASSER LES DECLINAISONS EN 1 SEUL PRODUIT  
   setIdName();
   //CHEK DE LA MARQUE 
   check_brand_exist();


   if (  isset($_GET['name'])  &&  isset($_GET['action']) && $_GET['action'] == 'synchronise' ) {
      $name_checked = $_GET['name'];
         if (!empty(isItRefresh($name_checked))) {
         $res = preCreateProduct($name_checked);
        }
   }

   if (  isset($_GET['name'])  &&  isset($_GET['action']) && $_GET['action'] == 'desactive' ) {
      $name_checked = $_GET['name'];
      setIdSynchro($name_checked, 65, 1);
   }

   $compteur = counter_prod_to_update();

   if (isset($res) && $res[0] == 0) : ?>
      <div class="container">
         <div class="alert alert-danger" role="alert">
            <?= $res[1] ?>
         </div>
      </div>
   <?php endif ?>

   <?php if (isset($res) && $res[0] == 1) : ?>
      <div class="container">
         <div class="alert alert-success" role="alert">
            <?= 'Article synchronisé : '.   $name_checked  ?>
         </div>
      </div>

   <?php endif ?>

   <?php if ($compteur == 0) : ?>
      <div class="container">
         <div class="alert alert-warning" role="alert">
            <?= 'Plus de Produits à synchroniser' ?>
         </div>
      </div>
   <?php endif ?>

   <?php
   $items =  ItemsByIdSynchro(0);
   ?>

   <div class="container">
      <div class="row">
         <table class="table table-bordered table-striped table-highlight">
            <thead>
               <tr class="menu">
                  <th id="center">ID KEZIA</th>
                  <th id="center">ARTICLES</th>
                  <th id="center">ACTION</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($items as $article) : ?>
                  <tr>
                     <td> <?= $article['IDART'] ?></td>
                     <td> <?= $article['id_name'] ?> </a></td>
                     <td>
                        <a href="preparation_products.php?name=<?= $article['id_name'].'&action=synchronise' ?>" 
                        class="btn btn-success btn-xs active" style="display:flex; justify-content:center;" role="button">Ajouter sur le site</a>
                        <a href="preparation_products.php?name=<?= $article['id_name'].'&action=desactive' ?>" 
                        class="btn btn-warning btn-xs active" style="display:flex; justify-content:center;" role="button">Désactiver</a>
                     </td>

                  </tr>
               <?php endforeach ?>
            </tbody>
         </table>
        </div>
   </div>

   <?php

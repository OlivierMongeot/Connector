<html>

<head>
   <title>Attente synchro</title>
      <script type="text/javascript" src="ajax.js"></script>
      </head>
<body>
 
<?php 
ini_set('display_errors','on');
include './menu.php';
?>
<div class="jumbotron jumbotron-fluid">
   <div class="container">
       <h1>ARTICLES A SYNCHRONISER</h1>
   </div>
</div>

<div class="container">
  <div class="container">
 
  <div class="row">
  
  <div class="col-sm-6">
    	<table class="table table-dark table-striped">
       <thead>
        <tr>            
             <th>EN ATTENTE : 
            <a href="" class="btn btn-success btn-xs active" style="float:right; " role="button"  onclick="gestionClic_8(); return false;">
                IMPORTER DE KEZIA
            </a>
    
            <a href="" class="btn btn-success btn-xs active" style="float:right" role="button"  onclick="gestionClic_4(); return false;">
            AJOUTER SUR LE SITE
            </a>
          </th>
     
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php read_product(0); ?></td>
       </tr>
    </tbody>
  </table>


























  <table class="table table-dark table-striped">
    <thead>
      <tr><th>PRODUIT EN DOUBLON A SUPPRIMER DE KEZIA</th>
        </tr></thead><tbody><tr><td>
        <?php read_product(3);  ?>
        </td>
      </tr>
    </tbody>
  </table>


</div>


<div class="col-sm-6">

      <table class="table table-dark table-striped">
    <thead>
      <tr>
           <div id="container"> 
              <th>PRODUITS REFUSES 
                <a href="" class="btn btn-success btn-xs active" style="float:right" role="button" onclick="gestionClic_5(); return false;">
                REVERIFIER 
                </a>
         <!--   <a href="" class="btn btn-success btn-xs active" style="float:right" role="button" onclick="gestionClic_test(); return false;">
            TEST 
          </a> -->
               </div></br>
              </th>
          </tr>
    </thead>
    <tbody>
      <tr>
            <td><?php read_product(2); ?></td>
      </tr>
     </tbody>
  </table>
</div>
<!--   <div class="container" >
  <div id="resultat">&nbsp;</div>
</div>
</div> -->

<!-- </div> -->








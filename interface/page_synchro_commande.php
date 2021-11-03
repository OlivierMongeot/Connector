<?php
//include 'session/session.php';
include 'menu.php';
?>

<html>
<head>
    <title>PrestaKez</title>
    <script type="text/javascript" src="ajax.js"></script>
   
   <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
</head>
<body>


     <div class="jumbotron jumbotron-fluid">
  <div class="container">
   <h1>SYNCHRO DES COMMANDES SUR KEZIA</h1> 

    </div>
</div>
</br>

<div id=container style=display:table;>
 <div id=contenu style=display:table-cell;vertical-align:middle;>



 <div class="container">


      <div id="container">  <a href="" class="btn btn-success btn-lg active" role="button" style= "width:400px"   onclick="gestionClic(); return false;">
            SYNCHRONISER LES COMMANDES
        </a></div>
  

   
<div id="container">  <a href="" class="btn btn-success btn-lg active" role="button" style= "width:400px" onclick="gestionClic_2(); return false;">
            SYNCHRONISER LES CLIENTS
        </a></div>


   
<div id="container">  <a href="" class="btn btn-success btn-lg active" role="button" style= "width:400px"  onclick="gestionClic_3(); return false;">
              SYNCHRONISER LES STOCKS
        </a></div>




   
<div id="container">  <a href="" class="btn btn-success btn-lg active" role="button" style= "width:400px"  onclick="gestionClic_6(); return false;">
              MISE A JOUR DES PRIX PROMO
        </a></div>



<!--    
<div id="container">  <a href="" class="btn btn-success btn-lg active" role="button" style= "width:400px"  onclick="gestionClic_4(); return false;">
            AJOUTER LES PRODUITS SUR LE SITE
        </a></div> -->


<!-- 
   
<div id="container">  <a href="" class="btn btn-success btn-lg active" role="button" style= "width:400px"  onclick="gestionClic_5(); return false;">
            REVERIFIER ARTICLES REFUSES KEZIA 
        </a></div> -->
</div>

</div>
</div>



  	 <div id="resultat">&nbsp;</div>
    </body>
</html>

<?php
?>



<?php
include 'menu.php';
?>


<html>

<head>
  <title>MAJ STOCK</title>
  <script type="text/javascript" src="ajax.js"></script>
</head>

<body>


  <!-- <div class="container"></div> -->

  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1>Verification des articles du site </h1>


      <div id="container">
        <!--  <a href="" class="btn btn-success btn-lg active" role="button" style= "width:300px"   onclick="gestionClicVerif(); return false;">
            REVERIFIER LES ARTICLES
        </a> -->
        <!-- <a href="" class="btn btn-success btn-lg active" role="button" title="Faire des jolies description + legendes  aux photos + ecriture meta title enjolivé + link rewrite + name rewrite " style= "width:300px"   onclick="gestionClicSeo(); return false;">
         SEO +
        </a> -->





      </div>


    </div>
  </div>

  <!-- <script async src="https://cse.google.com/cse.js?cx=017513904572429444346:xrbuhjjty6e"></script> -->
  <!-- <div class="gcse-search"></div> -->





  <div class="container">

    <div class="container">
      <div class="row">
        <div class="col-sm-6">

          <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th>IMAGES TROP PETITES

                  <a href="" class="btn btn-success btn-xs active" style="float:right" role="button" style="width:300px" onclick="gestionClicVerif(); return true;">
                    REVERIFIER
                  </a>
                </th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php
                    check_base_ss_image();
                    ?></td>


              </tr>

            </tbody>
          </table>

          <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th>ARTICLES SANS IMAGES
                </th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php
                    list_sans_image();
                    ?></td>


              </tr>

            </tbody>
          </table>


          <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th>ARTICLES SANS TEXTE
                </th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php
                    check_active_sans_descri();
                    ?></td>


              </tr>

            </tbody>
          </table>

          <!-- 
 <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>ARTICLES DESACTIVES
      </th>
  
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php
            //list_prod_inactive();
            ?></td>
    
    
      </tr>
     
    </tbody>
  </table> -->


        </div>


        <div class="col-sm-6">





          <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th>ARTICLES SANS EAN13
                </th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php
                    check_active_sans_ean();

                    ?></td>


              </tr>

            </tbody>
          </table>


          <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th>SEULEMENT 1 PHOTO
                </th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php
                    check_prod_one_image();

                    ?></td>


              </tr>

            </tbody>
          </table>


          <div class="container">
            <div id="resultat">&nbsp;</div>
            <!-- </div> -->
          </div>






</body>

</html>
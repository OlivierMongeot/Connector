<html>

<head>
  <title>Home</title>
</head>

<body>

  <?php
  include 'menu.php';
  ?>


  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1>TABLEAU DE BORD</h1>
      <!-- <p>Interfacte de connexion Kezia II et Prestashop</p> -->
      <!-- <p>Cliquer sur les compteurs pour voir le détail</p> -->
    </div>
  </div>




  <!-- <div class="container" > -->
  <div class="container">
    <div class="row">


      <!-- COLLONNE 1  -->


      <div class="col-sm-4">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>
                  <h2>CHECK KEZIA</h2>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <h2>
                  <td>
                    <h5>Manque couleur, taille, rayon ou marque, etc...
                  </td>
                  <td>
                    <h5>

                      <?php $count2 = counter_prod_id_two();
                      if ($count2 == 0) {      ?>

                        <a href="page_attente_synchro.php" style="float:right" class="btn btn-success btn-lg active" role="button" title="Cliquez ici pour voir le détail">
                          <?php echo $count2;      ?>


                        <?php  } else { ?>
                          <a href="page_attente_synchro.php" style="float:right" class="btn btn-danger btn-lg active" role="button" title="Cliquez ici pour voir le détail">
                          <?php echo $count2;
                        }  ?> </a>
                    </h5>
                  </td>

              </tr>


              <tr>
                <td>
                  <h5>Manque l'ean13
                </td>
                <td>
                  <h5>
                    <?php $count5 = counter_prod_ean();
                    if ($count5 == 0) {      ?>

                      <a href="#" class="btn btn-success btn-lg active" style="float:right" role="button" title="Cliquez ici pour voir le détail">
                        {# <?php echo $count5;      ?> #}


                      <?php  } else { ?>
                        <a href="#" class="btn btn-warning btn-lg active" style="float:right" role="button" title="Cliquez ici pour voir le détail">
                        <?php echo $count5;
                      }  ?>
                        </a>
                  </h5>
                </td>

              <tr>
                <td>
                  <h5>Valides en attente
                </td>
                <td>
                  <h5>

                    <?php $count5 = count_read_product(0);
                    if ($count5 == 0) {     ?>

                      <a href="page_attente_synchro.php" style="float:right" class="btn btn-success btn-lg active" role="button" title="Cliquez ici pour voir le détail">
                        <?php echo $count5;     ?>
                      <?php  } else { ?>
                        <a href="page_attente_synchro.php" style="float:right" class="btn btn-warning btn-lg active" role="button" title="Cliquez ici pour voir le détail">
                        <?php echo $count5;
                      }  ?> </a>

                  </h5>
                </td>

              <tr>
                <td>
                  <h5>Doublon sur Kezia
                </td>
                <td>
                  <h5>

                    <?php $count5 = count_read_product(3);
                    if ($count5 == 0) {     ?>

                      <a href="page_attente_synchro.php" style="float:right" class="btn btn-success btn-lg active" role="button" title="Cliquez ici pour voir le détail">
                        <?php echo $count5;     ?>
                      <?php  } else { ?>
                        <a href="page_attente_synchro.php" style="float:right" class="btn btn-warning btn-lg active" role="button" title="Cliquez ici pour voir le détail">
                        <?php echo $count5;
                      }  ?> </a>

                  </h5>
                </td>




            </tbody>
          </table>
        </div>
      </div> <!-- COLLONNE 2  -->

      <!-- <div class="container"> -->
      <!-- <div class="row"> -->
      <div class="col-sm-4">
        <div class="table-responsive">
          <table class="table">

            <thead>
              <tr>
                <th>
                  <h2>COMMANDES</h2>
                </th>
              </tr>
            </thead>
            <tbody>


              <tr>
                <h2>
                  <td>
                    <h5>Nouvelles
                  </td>
                  <td>
                    <h5>

                      <?php $count2 = count_new_order();
                      if ($count2 == 0) {     ?>

                        <a href="page_orders.php" style="float:right" class="btn btn-success btn-lg active" role="button" title="Cliquez ici pour voir le détail">
                          <?php echo $count2;     ?>

                        <?php  } else { ?>
                          <a href="page_orders.php" style="float:right" class="btn btn-danger btn-lg active bump" role="button" title="Cliquez ici pour voir le détail">
                          <?php echo $count2;
                        }  ?> </a>

                    </h5>
                  </td>

              </tr>


              <tr>
                <td>
                  <h5>En cours de traitement
                </td>
                <td>
                  <h5>


                    <?php $count5 = count_order_to_check();
                    if ($count5 == 0) {     ?>

                      <a href="page_orders.php" style="float:right" class="btn btn-success btn-lg active" role="button" title="Cliquez ici pour voir le détail">
                        <?php echo $count5;     ?>


                      <?php  } else { ?>
                        <a href="page_orders.php" style="float:right" class="btn btn-warning btn-lg active" role="button" title="Cliquez ici pour voir le détail">
                        <?php echo $count5;
                      }  ?> </a>


                  </h5>
                </td>

              <tr>
                <td>
                  <h5>Total
                </td>
                <td>
                  <h5>


                    <?php $count5 = counter_order();
                    if ($count5 == 0) {     ?>

                      <a href="page_orders.php" style="float:right" class="btn btn-success btn-lg active" role="button" title="Cliquez ici pour voir le détail">
                        <?php echo $count5;     ?>


                      <?php  } else { ?>
                        <a href="page_orders.php" style="float:right" class="btn btn-warning btn-lg active" role="button" title="Cliquez ici pour voir le détail">
                        <?php echo $count5;
                      }  ?> </a>


                  </h5>
                </td>


            </tbody>
          </table>
        </div>
      </div> <!-- Colone 3  -->


      <div class="col-sm-4">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>
                  <h2>CHECK SITE </h2>
                </th>

              </tr>
            </thead>
            <tbody>

              <tr>
                <td>
                  <h5>Articles non activés
                </td>
                <td>
                  <h5>

                    <?php
                    //  $count3 = num_san_image();
                    $count3 = count_prod_desactivate();

                    if ($count3 == 0) {     ?>

                      <a href="page_images.php" class="btn btn-success btn-lg active" role="button" style="float:right" title="Cliquez ici pour voir le détail">
                        <?php echo $count3;     ?>

                      <?php  } else { ?>
                        <a href="#" class="btn btn-warning btn-lg active" role="button" style="float:right" title="Cliquez ici pour voir le détail">
                        <?php echo $count3;
                      }  ?></a>

                  </h5>
                </td>

              </tr>
              <tr>
                <td>
                  <h5>Manque le descriptif
                </td>
                <td>
                  <h5>


                    <?php $count4 = count_active_sans_descri();
                    if ($count4 == 0) {     ?>

                      <a href="page_images.php" class="btn btn-success btn-lg active" role="button" style="float:right" title="Cliquez ici pour voir le détail">
                        <?php echo $count4;     ?>


                      <?php  } else { ?>
                        <a href="page_images.php" class="btn btn-danger btn-lg active" role="button" style="float:right" title="Cliquez ici pour voir le détail">
                        <?php echo $count4;
                      }  ?></a>




                  </h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5>Manque l'ean13
                </td>
                <td>
                  <h5>


                    <?php $count5 = count_active_sans_ean();
                    if ($count5 == 0) {     ?>

                      <a href="page_images.php" class="btn btn-success btn-lg active" role="button" style="float:right" title="Compteur">
                        <?php echo $count5; ?>

                      <?php  } else { ?>
                        <a href="page_images.php" class="btn btn-warning btn-lg active" role="button" style="float:right" title="Compteur">
                        <?php echo $count5;
                      }  ?>


                        </a>
                  </h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5>Photos trop petites
                </td>
                <td>
                  <h5>

                    <?php $count5 = counter_little_image();
                    if ($count5 == 0) {     ?>

                      <a href="page_images.php" style="float:right" class="btn btn-success btn-lg active" role="button" title="Compteur">
                        <?php echo $count5;     ?>

                      <?php  } else { ?>
                        <a href="page_images.php" style="float:right" class="btn btn-danger btn-lg active" role="button" title="Compteur">
                        <?php echo $count5;
                      }  ?> </a>



                  </h5>
                </td>
              </tr>
              <tr>
                <td>
                  <h5>Manque la Photo
                </td>
                <td>
                  <h5>


                    <?php $count5 = check_tot_sans_image();

                    if ($count5 == 0) {     ?>

                      <a href="page_images.php" style="float:right" class="btn btn-success btn-lg active" role="button" title="Compteur">
                        <?php echo $count5;     ?>


                      <?php  } else { ?>
                        <a href="page_images.php" style="float:right" class="btn btn-danger btn-lg active" role="button" title="Compteur">
                        <?php echo $count5;
                      }  ?> </a>



                  </h5>
                </td>

              </tr>
              <!-- </tr> -->


              <tr>
                <td>
                  <h5>Articles avec 1 photo
                </td>
                <td>
                  <h5>


                    <?php $count5 = counter_prod_one_image();

                    if ($count5 == 0) {     ?>

                      <a href="page_images.php" style="float:right" class="btn btn-success btn-lg active" role="button" title="Compteur">
                        <?php echo $count5;     ?>


                      <?php  } else { ?>
                        <a href="page_images.php" style="float:right" class="btn btn-danger btn-lg active" role="button" title="Compteur">
                        <?php echo $count5;
                      }  ?> </a>



                  </h5>
                </td>

              </tr>
              <!-- </tr> -->


            </tbody>
          </table>
        </div>
      </div>



    </div>

  </div>

  </div>

</body>

</html>
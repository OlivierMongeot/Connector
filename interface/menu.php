<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="interface/style.css" rel="stylesheet" media="all" type="text/css">
  
  <title>Home Kezia Connect</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand" href="#"> Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="preparation_products.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ARTICLES
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="./preparation_products.php">Nouveaux articles</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="./refusedprod.php">Articles incomplets</a>
            <a class="dropdown-item" href="./doublonProd.php">Articles doublons</a>
           
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../connector/desactivedProd.php">Articles désactivés</a>
            <a class="dropdown-item" href="#">F.A.Q</a>
          </div>
        </li>

        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="../connection/desynchronise.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            SUPPRIMER
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="../connection/desynchronise.php">DESYNCHRONISER + EFFACER DE PRESTASHOP</a> -->
        <!-- <a class="dropdown-item" href="#">PRODUITS REFUSE</a> -->
        <!-- <a class="dropdown-item" href="page_google_soe.php">SEO</a> -->
        <!-- </li> -->
        <li class="nav-item">
          <a class="nav-link" href="#">COMMANDES</a>
        </li>

        <li class="nav-item dropdown ">
           <a class="nav-link dropdown-toggle" href="reparation.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          GESTION
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="./reparation.php">Reparation</a>
            <a class="dropdown-item" href="./desynchronise.php">Désynchroniser du site</a>
            <a class="dropdown-item" href="./manageStocks.php">MAJ du Stock</a>
           </div>
        </li>



      </ul>

      <form class="form-inline my-2 my-lg-0">
        <!-- <script async src="https://cse.google.com/cse.js?cx=017513904572429444346:xrbuhjjty6e"></script>  -->
        <!-- <div class="gcse-search"></div>  -->
      </form>


      <span class="btn" type="button">
        <?php
        include 'session/session.php';
        ?>
      </span>

    </div>
  </nav>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  <?php
  ini_set('display_errors', 'on');
  
  ?>
</body>

</html>
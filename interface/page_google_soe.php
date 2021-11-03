<html>

<head>
   <title>SEO GOOGLE</title>
       </head>
<body>

  
<?php 
include 'menu.php';
?>

<!-- <div class="container"></div> -->

   <div class="jumbotron jumbotron-fluid">
  <div class="container">
   <h1>Verification SEO  du site </h1> 

    </div>
</div>



<?php 


google_microdata();

function google_microdata()
{

                //$rech = str_replace (' ' , '+' , $rech);

                $url ="3-vetements";

                $html = "https://search.google.com/structured-data/testing-tool?hl=Fr#url=https%3A%2F%2Fogstore.fr%2F$url";


                //echo $html;
                ?>

                <a onclick="window.open(this.href); return false;"  href=' <?php  echo $html;  ?>   '><img id="image-neon" src="./img/logo.png"/ style ="width: 30px"  >TEST DES CATEGORIES</a>
                
              
                <!-- <br /> -->
                <?php
}


  	echo '<br />';
  	echo '<br />';

google_microdata2();

function google_microdata2()
{

                //$rech = str_replace (' ' , '+' , $rech);

                $url ="brands/7-47-brand";

                $html = "https://search.google.com/structured-data/testing-tool?hl=Fr#url=https%3A%2F%2Fogstore.fr%2F$url";


                //echo $html;
                ?>

                <a onclick="window.open(this.href); return false;"  href=' <?php  echo $html;  ?>   '><img id="image-neon" src="./img/logo.png"/ style ="width: 30px"  >TEST DES MARQUES</a>
                
              
                <!-- <br /> -->
                <?php
}
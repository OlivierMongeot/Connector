<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- <link href="style.css" rel="stylesheet" media="all" type="text/css"> -->
    <title>Home Kezia Connect</title>
  </head>
  <body>
   <script async src="https://cse.google.com/cse.js?cx=017513904572429444346:xrbuhjjty6e"></script>
<div class="gcse-search"></div>


   <!-- <img id="image-neon" src="./interface/img/47.png"/> -->
<!-- ultimate -->
<?php
ini_set('display_errors','on');

//include 'function/Kezia_BDD.php';
//include 'switcher.php';

//include 'function/function_prepare.php';

//
?>


<script>


</script>
  <!-- <script src="js/jquery.js"></script> -->
 <!-- <script src="mon_script.js"></script> -->



<?php
$name= 'AVNIER HODDIE';


search_google($name);

function search_google($rech)
{

                $rech = str_replace (' ' , '+' , $rech);

                $html = "https://www.google.com/search?q=$rech&roq=$rech&sourceid=chrome&ie=UTF-8";

                //echo $html;
                ?>

                <a href=" 
                <?php
                echo $html;
                ?> 
                ">
                Googelize </a> 
                <?php
}



















//count_prod_one_image();


function count_img ($id_prod)
{
$con = ConBdPresta();
$sql = "SELECT COUNT(*) FROM ps_image WHERE id_product = '$id_prod'";

        $stmt = $con->query($sql);
                      $row = $stmt->fetch();
                      $tot = $row[0];
//echo 'TOTAL IMAGE :';
//echo $tot;
//echo '<br />';
return $tot;
                  
}







function count_prod_one_image()
{
    $sql = "SELECT id_product FROM ps_product_shop WHERE active = 1";
    $con = ConBdPresta();

  foreach($con->query($sql) as $row)
                 {
                // echo 'ID PROD';
                  $id_prod = $row['id_product'];
                  //echo  $id_prod;
                  $counter = count_img ($id_prod);
                  //echo '<br />';
                //echo $counter;
                 
                 if ($counter == 1)
                      {
                    echo 'ID PROD AVEC UNE SEULE IMAGE  :';
                    echo  $id_prod;
                    echo '<br />';

                      }




                 }
}







//count_active_sans_descri();


function get_active_sans_descri ()
{

  $con = ConBdPresta();

  $sql = "SELECT * FROM ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product WHERE description_short = '' AND active = 1";

    foreach($con->query($sql) as $row)
                 {

                  //var_dump($row);
                         echo'<br />';
                  $idart = $row['id_product'];
                  $desc =  $row['description_short'];

                  echo 'ID ART  : ';
                  echo $idart;
                  echo $desc;
                  echo'<br />';
                 
                 }


 $sql2 = "SELECT COUNT(*) FROM ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product WHERE description_short = '' AND active = 1";

   $stmt2 = $con->query($sql2);
                      $row2 = $stmt2->fetch();
                      $tot2 = $row2[0];
                      echo "TOTAL SANS DESCRIPTION : ";
                      echo $tot2;


    }




function count_active_sans_descri()
{

 $sql2 = "SELECT COUNT(*) FROM ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product WHERE description_short = '' AND active = 1 OR description_short IS NULL AND active = 1";

   $stmt2 = $con->query($sql2);
                      $row2 = $stmt2->fetch();
                      $tot2 = $row2[0];
                      return $tot2;
}






















//echo num_san_descriptif();


function num_san_descriptif()
{

           $con = ConBdPresta();

           
            $sql2 = "SELECT id_product FROM ps_product WHERE active = 1"; 

                 foreach($con->query($sql2) as $row)
                 {

                  $idart = $row[0];
                  //echo 'ID ART ACTIVE : ';
                 // echo $idart;
                  //echo'<br />';
                  select_no_describ($idart);
                 }


                  $sql = "SELECT COUNT(*)
                  FROM ps_product_lang WHERE description_short IS NULL OR description_short = '' 
                                    ";
                              
                  $stmt = $con->query($sql);
                  $row = $stmt->fetch();
                  $tot = $row[0];
                  echo 'TOTAL SANS DESCRIPTION  :';
                  echo $tot;
                  echo'<br />';
                 
                  echo 'TOTAL INACTIVE PROD : ';
                  $tot_inact = count_inactive_prod();
                  echo $tot_inact ;
                  echo'<br />';

  // return $t;*/

}



function count_active_prod()
{

$con = ConBdPresta();
                  $tot_produit = "SELECT COUNT(*) FROM ps_product WHERE active = 1";
                         $stmt2 = $con->query($tot_produit);
                      $row2 = $stmt2->fetch();
                      $tot2 = $row2[0];
                     return $tot2;
                  


}

function count_inactive_prod()
{

$con = ConBdPresta();
                  $tot_produit = "SELECT COUNT(*) FROM ps_product WHERE active = 0";
                         $stmt2 = $con->query($tot_produit);
                      $row2 = $stmt2->fetch();
                      $tot2 = $row2[0];
                     return $tot2;
                  


}




 function select_no_describ($idart)
                {
                     $con = ConBdPresta();
               $sql = "SELECT id_product FROM ps_product_lang WHERE (description_short IS NULL AND id_product = '$idart') OR (description_short = '' AND id_product = '$idart')";
               $stmt2 = $con->query($sql);
               $row2 = $stmt2->fetch();
               $id = $row2['id_product'];
               if ($id <= 0)
               {
                //
               }
               else
               {


               echo 'ID SANS SHORT DESRIPTION : ';
               echo $id;
               echo'<br />';
                }
                  }












































/*



function num_san_image ()
{

  $con = ConBdPresta();
$tot_avec_image = "SELECT DISTINCT COUNT(*)
FROM ps_product
WHERE active = 1
AND EXISTS (
              SELECT *
              FROM ps_image
              WHERE ps_product.id_product = ps_image.id_product
              AND   ps_product.id_product = ps_image.id_product )";  
              $stmt = $con->query($tot_avec_image);
    $row = $stmt->fetch();
    $tot = $row[0];
 
echo $tot;
echo'<br />';


$tot_produit = "SELECT COUNT(*) FROM ps_product WHERE active = 1";
       $stmt2 = $con->query($tot_produit);
    $row2 = $stmt2->fetch();
    $tot2 = $row2[0];

echo $tot2;
echo'<br />';


  
  
  $t = $tot2-$tot ;
  return $t;


}









$tests = array(
 'PUMA RS X REIVENT WNS  39',
 'PUMA RS X REIVENT WNS  39.5',
 'PUMA RS X REIVENT WNS  /39,5',
'PANAFRICA KAMPALA /XS',
'PANAFRICA KAMPALA /S',
'PANAFRICA KAMPALA ',
'PANAFRICA KAMPALA  ',
'PANAFRICA KAMPALA',
'PANAFRICA KAMPALA /38.5',
'PANAFRICA KAMPALA 38',
'PANAFRICA KAMPALA /38',
'PUMA RS X BOLD WHT/GECKO   40',
'PUMA RS X BOLD WHT/GECKO  40',
'PUMA RS X BOLD WHT/GECKO  /40',
'PUMA RS X BOLD WHT/GECKO  /40.5',

'PULL IN DENING EPIC PATRIOT ',
'PULL IN DENING EPIC PATRIOT',
'AVNIER HOODIE  VERTICAL BACK BLK',
'AVNIER T-S BASIC BLK',
'SAUCONY JAZZ OG VINTAGE  BLU/NVY/SIL',
'SAUCONY JAZZ  OG VINTAGE  WHITE' ,
'AVNIER HOODI VERTICAL BACK RADIO APPLE  M',
'AVNIER HOODI VERTICAL BACK RADIO APPLE  XS',
'AVNIER HOODI VERTICAL BACK RADIO APPLE XS',
'AVNIER  LIVE JKT BLK  L',
'AVNIER  LIVE JKT BLK M',
'PUMA RS X BOLD WHT/GECKO   43',
'PUMA RS X BOLD WHT/GECKO   42',
'PUMA RS X BOLD WHT/GECKO   42.5',
'WEYZ PANT ZEUS REFLECTIVE  3M',
'WEYZ PANT ZEUS REFLECTIVE  3M S',
'WEYZ PANT ZEUS REFLECTIVE  3M XS',
'WEYZ PANT ZEUS REFLECTIVE  3M /34',
'WEYZ PANT ZEUS REFLECTIVE  3M XXS',
'WEYZ PANT ZEUS REFLECTIVE  3M XXL'





);

//$string = 'TAXDI RE XS';
/*
$string = 'PANAFRICA KAMPALA /XS';
$string = 'PANAFRICA KAMPALA /S';
$string4 = 'PANAFRICA KAMPALA ';
$string8 = 'PANAFRICA KAMPALA  ';
$string5 = 'PANAFRICA KAMPALA';
$string7 = 'PANAFRICA KAMPALA /38.5';
$string8 = 'PANAFRICA KAMPALA 38';
$string8 = 'PANAFRICA KAMPALA /38';
$string9 = "PUMA RS X BOLD WHT/GECKO   40";*/


/*
foreach ($tests as $string)
 {


parse_name($string);

   }

*/


function parse_name($string)

{
      echo 'String de base : ';
      echo $string;
      echo '<br />';
      echo 'String avec pregreplace : ';

     $string = preg_replace('!\s+!', ' ', $string); 
     echo $string;


      echo '<br />';
      echo "1 ere Coupe des 5 derniers lettres : ";
      $der = substr($string ,  -5);
      echo $der;
      echo '<br />';
      $c_der = substr($der , 4 , 1);



      if ($c_der == ' ')

      {
          //echo '<br />';
          echo 'Espace à la fin trouvé';
          $string = substr($string, 0, - 1);
          echo '<br />';
          echo "2 eme Coupe des 5 derniers lettres : ";
          $der = substr($string ,  -5);
          echo $der;
          echo '<br />';
          }



      echo "1ere place : " ;
      $prem_der = substr($der , 0 , 1);
      echo $prem_der;
      echo '<br />';

      echo "2eme place : " ;
      $deuz_der = substr($der , 1 , 1);
      echo $deuz_der;
      echo '<br />';

      echo "3eme place : " ;
      $troiz_der = substr($der , 2 , 1);
      echo $troiz_der;
      echo '<br />';

      echo "4eme place : " ;
      $quat_der = substr($der , 3 , 1);
      echo $quat_der;
      echo '<br />';


      echo "5eme place : " ;
      $cinq_der = substr($der , 4 , 1);
      echo $cinq_der;
      echo '<br />';

      echo "Longueur totale string : ";
      $long_string = strlen($string);
      echo "$long_string";
      echo '<br />';

// PREMier 
      if ($prem_der == "/" && $quat_der == '.')
                    {
                   
                   $fin_de_string = substr($string, $long_string - 5);
                           echo 'Fin de String : ';
                         echo $fin_de_string;
                        echo '<br />';
                            $string = substr($string, 0, - 5);
                       
                      
                     }


   if ($prem_der == "/" && $quat_der == ',')
              {
             
             $fin_de_string = substr($string, $long_string - 5);
                     echo 'Fin de String : ';
                   echo $fin_de_string;
                  echo '<br />';
                      $string = substr($string, 0, - 5);
                 
                 }

    if ($prem_der == " " && $quat_der == '.')
              {
                  $fin_de_string = substr($string, $long_string - 4);
                  if (is_numeric($fin_de_string))
                     {
                      $string = substr($string, 0, - 5);
                     }
               }


     if ($prem_der == " " && $quat_der == ',')
                        {
                     
                       $fin_de_string = substr($string, $long_string - 4);
                              $string = substr($string, 0, - 5);
                       }



// DEUSIME 
      if ($deuz_der == "/" )
                {
                  //
                       $fin_de_string = substr($string, $long_string - 3); 
                       echo 'Fin de String : ';
                       echo $fin_de_string;
                       echo '<br />';

                         if (is_numeric($fin_de_string))
                         {
                           $string = substr($string, $long_string - 4);
                         }
                } 

  // BLANC EN DEUZ / en troiSs
      if ($deuz_der == ' ' && $troiz_der == "/"  ){
                        //

                      $fin_de_string = substr($string, $long_string - 3);
                      echo 'Fin de String trois  : ';
                      echo $fin_de_string;
                      echo '<br />';

                               $string = substr($string, 0 , - 4 );

                      }

      
      if ($deuz_der == ' ' && ($troiz_der.$quat_der.$cinq_der) == "XXL" || $deuz_der == ' ' && ($troiz_der.$quat_der.$cinq_der) == "XXS"  ){
                    //

                  $fin_de_string = substr($string, $long_string - 4);
                  echo 'Fin de String trois  : ';
                  echo $fin_de_string;
                  echo '<br />';
                           $string = substr($string, 0 , - 4 );
                            }



      if ($deuz_der == '/ '  && $troiz_der == " " )
                      {


                         $string = substr($string, 0 , 1 );
                      }

 
      if ($troiz_der == " ")

                    {
                      //

                    $fin_de_string = substr($string, $long_string - 3);
                    echo 'Fin de String trois avec espace devant  : ';
                    echo $fin_de_string;
                    echo '<br />';


                     
                             if (is_numeric($fin_de_string))
                             {
                             $string = substr($string, 0 , - 3 );

                             }

                             if ( ($quat_der.$cinq_der) == 'XS' or ($quat_der.$cinq_der) == 'XL')
                             {

                             $string = substr($string, 0 , - 3 );

                             }

                    }
 
        // WHITE 3  et 4 Eme / 
       //   $cinq_der =

        if ( $troiz_der == ' '  && $quat_der == "/" )
                      {
                        
                      $fin_de_string = substr($string, $long_string - 2);
                      echo 'Fin de String de deux  car : ';
                      echo $fin_de_string;
                      echo '<br />';
                      $string = substr($string, 0 , - 3);
                      }




        if ($quat_der == " " )
                  {
                    
                  $fin_de_string = substr($string, $long_string - 1);
                  echo 'Fin de String de un car : ';
                  echo $fin_de_string;
                  echo '<br />';
                  $string = substr($string, 0 , - 1);
                  }


      // 5 eme 
        if ($cinq_der == "/")

                  {
                   $string = substr($string, 0,  - 1);
                  }


                echo "Rechek dernier lettres : ";
                $derder = substr($string ,  -1);
                echo $derder;
                echo '<br />';
                

                         if ($derder == ' ')
                         {
                         echo 'Last car null à couper';
                         echo '<br />';
                         $string = substr($string , 0 , -1 );
                         echo 'Nouvelle String : ';
                         echo $string;
                         echo '<br />';       
                         }
                         else
                         {
                         echo 'Nouvelle String : ';
                         echo $string;
                         echo '<br />';       
                         }  
        

      echo 'Longueur Nouvelle String : '; 
       $long = strlen($string);
       echo $long; 
           echo '<br />';
               echo '<br />';
}







function update_short_name ($id_art_kezia)
{

$req_info = " SELECT * FROM ps_product_lang WHERE id_product = '$id_prod' ";
$con = ConBdPresta();
$req = $con->query($req_info);

    $result = $req->fetch();
    echo '</br>';
    
    //var_dump($result);
    $id = $result["id_product"];
    
    echo 'ID Produit : ';
    echo $id;
    echo '</br>';

    echo 'Name : ';
    $string = $result["name"];
    //$prod_attributte = $result[0]
    echo $string;
       echo '</br>';
    
      $string = preg_replace('!\s+!', ' ', $string);       
      // Filtres mots à completer ou à mettre en bdd 
      $string = str_replace (' 35' , '' , $string );
      $string = str_replace (' 36' , '' , $string );
      $string = str_replace (' 37' , '' , $string );
      $string = str_replace (' 38' , '' , $string );
      $string = str_replace (' 39' , '' , $string );
      $string = str_replace (' 40' , '' , $string );
      $string = str_replace (' 41' , '' , $string );
      $string = str_replace (' 42' , '' , $string );
      $string = str_replace (' 43' , '' , $string );
      $string = str_replace (' 44' , '' , $string );
      $string = str_replace (' 45' , '' , $string );
      $string = str_replace (' 46' , '' , $string );
      $string = str_replace (' 47' , '' , $string );
      $string = str_replace (' 35.5' , '' , $string );
      $string = str_replace (' 36.5' , '' , $string );
      $string = str_replace (' 37.5' , '' , $string );
      $string = str_replace (' 38.5' , '' , $string );
      $string = str_replace (' 39.5' , '' , $string );
      $string = str_replace (' 40.5' , '' , $string );
      $string = str_replace (' 41.5' , '' , $string );
      $string = str_replace (' 42.5' , '' , $string );
      $string = str_replace (' 43.5' , '' , $string );
      $string = str_replace (' 44.5' , '' , $string );
      $string = str_replace (' 45.5' , '' , $string );
      $string = str_replace (' 46.5' , '' , $string );
    
    //$string = str_replace (' XS' , '' , $string );
    //$string = str_replace (' S' , '' , $string );
    //$string = str_replace (' M' , '' , $string );
    //$string = str_replace (' L' , '' , $string );
    //$string = str_replace (' XL' , '' , $string );
    
      $der = substr($string, -2);
      $derder = substr($string, -1);
  

      if ($derder = ' ' )
      {
        $string = substr($string , 0 , -1 );
      }

      if ($der = '  ' )
      {
        $string = substr($string , 0 , -2 );
      }

      $der = substr($string, -1);

      if ($der = 'XS' || $der = 'XL' )
      {
        $string = substr($string , 0 , -2 );
  
      }

      if ($der = ' S' || $der = ' M' || $der = ' L' )
      {
        $string = substr($string , 0 , -2 );      
      }


    

      
    
    
    echo 'New Name : ';
    echo $string;
      echo '</br>';




      //supprimer les doubles espaces dans le titre 
      if(stristr($string, '  ') === FALSE)

        {
        echo 'Double space non trouvé dans la chaîne de caractères';
        echo '</br>';
        //return $string;
      }
    else
    {
      echo '</br>';
      echo '"double space" trouve';
      echo '</br>';
      $pos = strpos( $string , '  ');
      echo $pos;
      echo '</br>';
      $string = str_replace ('  ' , ' ' , $string );
      
      
      echo 'NOUVEAU NOM : REMPLACE : '; 
        echo $string;
        echo '</br>';
        //mise a jour 
        //$con = ConBdPresta();
        echo 'NOUVEAU NOM : ECRITURE';
        set_name($id_prod , $string );
          echo '</br>';
        //return $string;
    }



    //supprimer les espaces à la fin du titre


    //recuperation du nom en cours 
    $current_name = $string;




     echo 'Longeur du nom du base à traiter : ';
     $long_base = strlen($current_name);
     echo $long_base;

         echo '</br>';
          echo 'Dernier caractere : ';
              $last_car = substr($current_name, -1, 1);  
              echo $last_car;
              echo '</br>';
                 if ($last_car == ' ' )
                 {
                  echo "espace trouve à la fin";
                     echo '</br>';
                     $name2 = substr( $current_name , 0 , $long_base - 1 );  // 
                      echo '</br>';
                        echo '</br>';
                        set_name($id_prod , $name2 );


                 }
                 else
                 {
                  echo "Pas d'espace trouve à la fin";
                     echo '</br>';
                       echo '</br>';
                        echo 'STRING = ';
                        echo $current_name;
                        set_name($id_prod , $current_name );

                    }
}









function count_read_product($id_synchro)
{

 $con = ConBdTampon();
 //echo '<H2>RE FILTRES TAILLES COULEURS FAMILLE </H2></br>';
  //lecture du rayon 

  $rayon_to_check = "SELECT COUNT(id_synchro) FROM WEB_ARTICLE
                    WHERE id_synchro = '$id_synchro' ";
    

                $stm =$con->query($rayon_to_check); 
                $num = $stm->fetch();
                $nombre = $num[0];
                return $nombre;
                    
         

}








function check_sans_image()
{


  $sd ="
  SELECT SQL_CALC_FOUND_ROWS p.`id_product`  AS `id_product`,
   p.`reference`  AS `reference`,
   pl.`name`  AS `name`,
    sa.`active`  AS `active`,
    image_shop.`id_image`  AS `id_image`
  FROM  `ps_product` p 
  LEFT JOIN `ps_product_lang` pl ON (pl.`id_product` = p.`id_product` AND pl.`id_lang` = 1 AND pl.`id_shop` = 1)
  JOIN `ps_product_shop` sa ON (p.`id_product` = sa.`id_product` AND sa.id_shop = 1) 
  LEFT JOIN `ps_image_shop` image_shop ON (image_shop.`id_product` = p.`id_product` AND image_shop.`cover` = 1 AND image_shop.id_shop = 1)
  LEFT JOIN `ps_image` i ON (i.`id_image` = image_shop.`id_image`) 
  WHERE (1 AND state = 1) 
  AND image_shop.id_image IS NULL
  AND sa.active = 1
 
  ";


    $con = ConBdPresta();
 
    foreach($con->query($sd) as $id_prod)
           {
            echo 'ID PRODUIT SANS IMAGE : ';
            $id = $id_prod['id_product'];
            echo $id;
             echo '</br>';

           //is_prod_an_image($id);
            }


$qry = "SELECT FOUND_ROWS() AS NbRows";
$stmt = $con->query($qry);
    $res = $stmt->fetch();
echo '</br>';
echo 'TOTAL : ';
echo $res[0];

}




function is_prod_an_image($id_product)
{
   
    $con = ConBdPresta();
 
    $sql = " SELECT id_product FROM ps_image WHERE id_product = $id_product";

    $stmt = $con->query($sql);
    $row = $stmt->fetch();
    $number = $row[0];
    //echo $number;

  
    if ($number > 0)
    {
    return 1; 
    }
    else 
    {
    
     echo 'ID product : '.$id_product; 
     echo '</br>';
     echo "Pas d'image";
     echo '</br>';
     return 0;
    }

//    return $number;

}


function check_image_from_only_active()
{
      $con = ConBdPresta();
 
    $sql = " SELECT id_product FROM ps_product WHERE active = 1";

        foreach($con->query($sql) as $id_prod)
     {
        //echo 'ID PROD ACTIVE : ';
        $id = $id_prod['id_product'];
        //echo $id;
     
        is_prod_an_image($id);

      }


}



//check_image_from_only_active();
 

//is_prod_an_image(524);



















//read_doublon_product();

function read_doublon_product()
{

       $con = ConBdTampon();
       //echo '<H2>RE FILTRES TAILLES COULEURS FAMILLE </H2></br>';
        //lecture du rayon 

        $rayon_to_check = "
      SELECT   COUNT(*) AS nbr_doublon, IDTAILLE, DESIGNATION , IDART
      FROM     WEB_ARTICLE
      GROUP BY DESIGNATION, IDTAILLE
      HAVING   COUNT(*) > 1 ";



       foreach($con->query($rayon_to_check) as $row)
                    {

            echo "ID KEZIA : "; 
            $id_art = $row['IDART'];
            echo $id_art;
       
        
              echo '  ';
            $name = $row['DESIGNATION'];
            echo $name;
             echo '<br />';
        
        
              echo "TAILLE : "; 
            $id_taille = $row['IDTAILLE'];
            echo $id_taille;
            echo '<br />';
            }                    

               //filtre_size_color_rayon($id_art, $id_synchro );
               
}


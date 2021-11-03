<html>

<head>
   <title>MAJ STOCK</title>
       </head>
<body>

  
<?php 
ini_set('display_errors','on');
//include 'function/function_prepare.php';
//include 'function/Kezia_BDD.php';
//include 'interface/function/function_dashbord.php';
//include 'interface/function/function_images.php';
//include 'interface/function/function_recheck_refused_prod.php';

//include 'interface/function/function_orders.php';


//echo 'Produits sans description<br />';

 	// get_active_sans_descri ();
   
   //echo '<br /';

   //echo 'Produits avec 1 image<br />';
   //get_prod_one_image();
   

   echo 'Check des tailles images';
   echo '<br /';
   
   check_by_last(); // check des tailles images 


//check_img (561);

function check_by_last() 
{
  $con = ConBdPresta();
  $sql = "SELECT * FROM ps_product_shop WHERE active = 1 ORDER BY id_product DESC LIMIT 100";

    foreach($con->query($sql) as $row)
    {
      $id_prod = $row['id_product'];
      
     
      check_img ($id_prod);
    }
}




function check_img ($id_prod)
{

  $con = ConBdPresta();
  $sql = "SELECT * FROM ps_image WHERE id_product = '$id_prod' GROUP BY id_image ASC ";
  $n = 1;
  //echo 'ID_PRODUCT PRESTA = ';
   // echo $id_prod;
   // echo '<br>';
   $tab = array(); 
  foreach($con->query($sql) as $row)
  {

    

    //echo 'Image N° '. $n ;
    //echo '<br>';
    $id_image = $row[0];
    //echo '<br>';
    $long_id_img = strlen($id_image);

    
    $count_lit = check_size_img($id_image , $long_id_img , $id_prod );
    //echo "RESULTAT : ";
    //echo $count_lit;
    //echo '<br>';
    
    array_push($tab, $count_lit);
    $n++;
      }
      //var_dump($tab);
          
      $tot = array_sum($tab);
     // echo 'TOTAL ERREUR : ';
     // echo $tot;
      //echo '<br>';

      if ($tot > 0)
      {
         $id_image = $row[0];
        set_little_image($id_image , 1 );
        echo 'DESACTIVATION PROD : ';
        echo '<br>';
        desactive_prod( $id_prod, 0 );
      }
      else
      {
         $id_image = $row[0];
         set_little_image($id_image , 0 );
        // echo 'ALL IMAGE OK '.$id_image;
      }
      // echo '<br>';
      echo '<br>';
}






function check_size_img($id_img , $long_id_img , $id_prod )
{
  
    //echo 'Longueur ID IMAGE : ';
    //echo $long_id_img;
    //echo '<br>';
    $stack = array();
    $count = 0;
    for($i = 0 ; $i <= $long_id_img ; $i++)
    {
      $numero = substr($id_img, $i , 1);
      array_push($stack, $numero);
    }

      switch ($long_id_img)
      {
        case '2':
          $under_path = $stack[0].'/'.$stack[1];
          break;
        case '3':
          $under_path = $stack[0].'/'.$stack[1].'/'.$stack[2];
          break;
        case '4':
          $under_path = $stack[0].'/'.$stack[1].'/'.$stack[2].'/'.$stack[3];
          break;
        case '5':
          $under_path = $stack[0].'/'.$stack[1].'/'.$stack[2].'/'.$stack[3].'/'.$stack[4];
          break;
        default: echo 'PROBLEME DE CHEMIN ';
        break;
      }

  
    $path ='../../img/p/'.$under_path.'/'.$id_img.'.jpg';
    //echo 'Chemin : ';
    //echo $path; 
    //echo '<br>';
    
    $filename = $path;
    $size = getimagesize($filename);
    $larg = $size[0];
    
    //$file_weight = filesize ( $filename );

//    echo 'Poids ='; 
  //  echo $file_weight;  
   // echo '<br>';

    //   if ($file_weight < 10000 )
    // {
    //   echo 'POIDS trop petit';
    //   echo '<br>';
    //   //set_little_image($id_img , 1 );
    //   //desactive_prod( $id_prod, 0 );
    // }



    if ($larg < 450 )
    {
      echo 'ID IMAGE : ';
      echo $id_img; 
      echo '<br>';
      echo 'Largeur ='; 
      echo $larg; 
      echo '<br>';




      echo 'Image trop petite';
      //echo '<img src=" '.$filename.' " alt="texte alternatif" title="Titre" width="50"  />';
      echo '<br>';
      // inscription dans la bbd de presta sur colone non utilise supplier_reference
      set_little_image($id_img , 1 );
      desactive_prod( $id_prod, 0 );
      $count++;


    }
    else
    {
      //echo 'Taille image OK ';
        //echo '<br>';
      set_little_image($id_img , 0);

    } 

       //echo '<br>';
       return $count;
}








function set_little_image($id_img , $state)
{

  $con = ConBdPresta();
  $sql = "SELECT id_product FROM ps_image WHERE id_image = '$id_img' GROUP BY id_image ASC ";

    $req = $con->query($sql);
    $result = $req->fetch();
    $id_prod = $result[0];

  $sql2 = "UPDATE ps_product SET supplier_reference = '$state' WHERE id_product = '$id_prod' ";
  $req2 = $con->query($sql2);


}




function desactive_prod( $id_prod, $state )
{
$con = ConBdPresta();
$sql = "UPDATE ps_product SET active = '$state' WHERE id_product = '$id_prod'";
$set = $con->query($sql);
$sql = "UPDATE ps_product_shop SET active = '$state' WHERE id_product = '$id_prod'";
$set = $con->query($sql);

}



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

function get_prod_one_image()
{
    $sql = "SELECT * FROM ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product";
    $con = ConBdPresta();
   
  foreach($con->query($sql) as $row)
                 {
                // echo 'ID PROD';
                  $id_prod = $row['id_product'];
                  $name = $row['name'];
                  $counter = count_img ($id_prod);
                  //echo '<br />';
                //echo $counter;
                 
                 if ($counter == 1)
                      {

                    //echo ' ID ';
                    //echo  $id_prod;
                    //echo ' : ';
                    //echo $name;
                    //echo '<br />';
                    desactive_prod( $id_prod, 0 );

                    
                      }

                 }
               
}



/////////////
function counter_prod_one_image()
{
    $sql = "SELECT * FROM ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product";
    $con = ConBdPresta();
    $n = 0;
  foreach($con->query($sql) as $row)
                 {
                // echo 'ID PROD';
                  $id_prod = $row['id_product'];
                 $counter = count_img ($id_prod);
                  //echo '<br />';
                //echo $counter;
                 
                 if ($counter == 1)
                      {
                       $n++;
                      }

                 }
                 return $n;
}








function get_active_sans_descri()
{

  $con = ConBdPresta();

  $sql = "SELECT * FROM ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product WHERE description_short = '' OR description_short IS NULL";

    foreach($con->query($sql) as $row)
                 {

                 //var_dump($row);
                 
                  $idart = $row['id_product'];
                  $name = $row['name'];
                  //$desc =  $row['description_short'];
                  //search_google($name);
                  echo ' ID ';
                  echo $idart;
                   echo ' : ';
                

                  echo $name;
                  echo'<br />';
                 desactive_prod( $idart, 0 );
                 }




    }









function ConBdPresta()
{
  try 
    {
          $servername = "localhost";
          $user1 = "root";
          $pass = "AbpH6Mv5F6cQe";
          $db_name = "prestashop";

        $pdo = new PDO("mysql:host=$servername;dbname=$db_name;charset=utf8", $user1, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      



        return $pdo;
    }   
  catch (PDOException $e) 
    {
      print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}


function ConBdTampon()
{
  try 
    {
          $servername = "localhost";
          #$servername = "91.216.107.164";
          $user1 = "root";
          #$user1 = "custo1230104";
          $pass = "AbpH6Mv5F6cQe";
          #$pass = "hp6i6lzgtr";
          $db_name = "tampon";
          #$db_name = "custo1230104"; 
      
        $pdo = new PDO("mysql:host=$servername;dbname=$db_name;charset=utf8", $user1, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }   

  catch (PDOException $e) 
    {
      print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}




<?php
ini_set('display_errors','on');

recheck(2);


function recheck($id_synchro )
{

	 $con = ConBdTampon();
 	 $rayon_to_check = "SELECT * FROM WEB_ARTICLE WHERE id_synchro = '$id_synchro' GROUP BY IDART DESC";

			 foreach($con->query($rayon_to_check) as $idcheck)
              {
              	$id_art = $idcheck['IDART'];
                echo 'ID ARTICLE : ';
                echo $id_art;
                echo '</br>';
              	filtre_size_color_rayon($id_art, $id_synchro );
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



function filtre_size_color_rayon($id_art, $id_checked )
{
     $con = ConBdTampon();
     $rayon_to_check = " SELECT * FROM WEB_ARTICLE WHERE id_synchro = '$id_checked' AND IDART = $id_art ";

    foreach ($con->query($rayon_to_check) as $idcheck)
    {
        //var_dump($idcheck);

                $ray = $idcheck['IDRAY'];
                $taille = $idcheck['IDTAILLE'];
                $id_art = $idcheck['IDART'];
                $id_colors = $idcheck['IDCOULEUR'];
                $new_name = $idcheck['DESIGNATION'];
                $brand = $idcheck['ID_FAB'];
                $ss_famille = $idcheck['IDSSFAM'];
                //echo '</br>';
             //   echo 'ID KEZIA : ';
              // echo $id_art;
               // echo ' ';
               // echo $new_name;
               // echo ' --> ';

                
             
                    if ($ray == 8 && $taille > 0 && $id_colors > 0  )
                    {
                      echo 'GOOD PRODUCT VETEMENT';
                       $state_prod = 0;
                     echo '</br>';
                    }

                    if ($ray == 8 && $taille <= 0 )
                    {
                      echo 'Pas de Taille';
                     $state_prod = 2;
                     echo '</br>';
                    }
                      if ($ray == 8 && $id_colors <= 0 )
                    {
                     echo 'Pas de Couleur';
                       $state_prod = 2;
                     echo '</br>';
                     }

             

                    if ($ray == 2 && $taille  <= 0 && $id_colors > 0  &&  $ss_famille >= 0  )
                     {
                      echo ' GOOD PRODDUCT  ACCESS';
                       $state_prod = 0;
                    echo '</br>';
                     } 

                    if ($ray == 2 && $taille  <= 0 && $id_colors > 0  &&  $ss_famille <= 0  )
                     {
                      echo ' NO GOOD PRODDUCT  FAMMILE';
                       $state_prod = 2;
                    echo '</br>';
                     } 
                    if ($ray == 2 && $taille <= 0 && $id_colors <= 0  && $ss_famille >= 0)
                     {
                     echo 'Pas de Couleur';
                       $state_prod = 2;
                    echo '</br>';
                     }
                    if ($ray == 2 && $taille > 0 && $id_colors <= 0  && $ss_famille >= 0  )
                     {
                    echo 'GOOD PRODDUCT : Accessoire with size ';
                        $state_prod = 0;
                    echo '</br>';
                     }




                    if ($ray == 3 && $taille > 0 && $id_colors > 0  )
                    {
                     echo ' GOOD SHOES ';
                     $state_prod = 0;
                     echo '</br>';
                    }

                  
                    if ($ray == 3 && $taille <= 0 )
                    {
                     echo 'Pas de Taille';
                     $state_prod = 2;
                    echo '</br>';
                    }

                    if ($ray == 3 && $id_colors <= 0 )
                    {
                    echo 'Pas de Couleur'; 
                    $state_prod = 2;
                    echo '</br>';
                     }
                                     


                     if ($brand == 0)
                         {
                    echo 'Pas de Marque'; 
                    $state_prod = 2;
                   echo '</br>';
                     }

                         if ($ray == 0 )
                    {
                      echo 'Pas de rayon';
                      $state_prod = 2;
                      echo '</br>';
                    }


                      echo 'STATE FINAL : '.$state_prod;
                      echo '</br>';
                      setIdSynchro_stock( $id_art , $state_prod);
      }
}



function setIdSynchro_stock ( $id_art , $state )
{
      $con = ConBdTampon();

      $update_synchro = "UPDATE WEB_ARTICLE SET id_synchro = '$state' WHERE IDART = '$id_art' ";

      $setup = $con->query($update_synchro);
      //echo '</br>';
      //echo ' ID_SYNCHRO UPDATED FOR ONE ATTRIBUTES ';
      




}





?>

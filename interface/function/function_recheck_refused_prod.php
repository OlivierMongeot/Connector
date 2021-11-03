
<html><head><title>Display errors</title>


</head><body>
<?php


function recheck($id_synchro )
{

 $con = ConBdTampon();
 //echo '<H2>RE FILTRES TAILLES COULEURS FAMILLE </H2></br>';
  //lecture du rayon 

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


function read_product($id_synchro )
{

 $con = ConBdTampon();
 //echo '<H2>RE FILTRES TAILLES COULEURS FAMILLE </H2></br>';
  //lecture du rayon 

  $rayon_to_check = "SELECT * FROM WEB_ARTICLE
                    WHERE id_synchro = '$id_synchro' GROUP BY IDART ";

			 foreach($con->query($rayon_to_check) as $idcheck)
              {
              	
                $id_art = $idcheck['IDART'];
                echo 'ID '.$id_art; 
                            		$name = $idcheck['DESIGNATION'];

              	echo " : &nbsp;&nbsp;"; 
              	echo $name;
              	echo '<br />';
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


?>
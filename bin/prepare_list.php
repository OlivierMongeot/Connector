<?php 
// Re ecriture de la base produit pour partir sur une base saine 
// Lors de la synchro KEZIA 
// Lecture de web_article
// Voir si ref existante sur novelle base 


// function setNewBddArticle()
// {
// 	$sql = "SELECT IDART, DESIGNATION FROM WEB_ARTICLE ORDER BY IDART ASC";
//     $con = ConBdTampon();

// 	    foreach($con->query($sql) as $idcheck)
//     	{
// 			$id = $idcheck['IDART'];
// 			$name =  $idcheck['DESIGNATION'];
// 			//voir si id  presente sur new_articles
// 			$return = is_it_new($id);
		
// 				if($return === false)
// 				{
// 					echo 'NEW ARTICLE  ';
// 					echo $id.' ';
// 					echo $name;
// 					echo '<br>';
// 					// write_new_article($id, $name);
// 					set_id_synchro_zero($id);
// 				} 
// 				// else
// 				// {
// 				// echo 'ARTICLE EXISTANT';
// 				// echo '<br>';
// 				// echo '<br>';
// 				// }
    
//     }
//     echo 'Fin du check';
// }

// // VOIR SI EXISTE UN ARTICLE SUR BDD ANNEXE 
// function is_it_new($id)
// {
// 	$con = ConBdTampon();
// 	$sql = "SELECT IDART FROM NEW_ARTICLE WHERE IDART = '$id' ";
// 	$req = $con->query($sql);
// 	$result = $req->fetch();
// 	return $result;
// }
// // MODIF 15/11 en requete prepare
// function write_new_article($id , $name)
// {
// 	$con = ConBdTampon();
// 	$sql = "INSERT INTO NEW_ARTICLE (IDART, DESIGNATION , ID_SYNCHRO)
// 		VALUES ( ? , ? , ? ) ";
// 	$res = $con->prepare($sql);
// 	$res->execute([ $id , $name , 0]);	 
// }

// // ID SYNCHRO 0 
// function set_id_synchro_zero($id)
// {
// 	$con = ConBdTampon();
// 	$sql = "UPDATE WEB_ARTICLE SET id_synchro = 0 WHERE IDART = '$id' 
// 		";
// 	$setup = $con->query($sql);	

// }
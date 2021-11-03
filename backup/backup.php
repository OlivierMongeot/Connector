<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Entrez ici les informations de votre base de données et le nom du fichier de sauvegarde.
$mysqlDatabaseName ='tampon3';
$mysqlUserName ='root';
$mysqlPassword ='';
$mysqlHostName = 'localhost';
$today = date("d_m_y");

$mysqlExportPath ='TamponBDDSave'.$today.'.sql';

$command = "mysqldump --databases --user=root --password your_db_name > export_into_db.sql";

//Veuillez ne pas modifier les points suivants
//Exportation de la base de données et résultat
// $command='mysqldump --opt -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ' .$mysqlExportPath;

// exec($command);

// switch($worked){
// case 0:
// echo 'La base de données <b>' .$mysqlDatabaseName .'</b> a été stockée avec succès dans le chemin suivant '.getcwd().DIRECTORY_SEPARATOR .$mysqlExportPath .'</b>';
// break;
// case 1:
// echo 'Une erreur s est produite lors de la exportation de <b>' .$mysqlDatabaseName .'</b> vers'.getcwd(). DIRECTORY_SEPARATOR .$mysqlExportPath .'</b>';
// break;
// case 2:
// echo 'Une erreur d exportation s est produite, veuillez vérifier les informations suivantes : <br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr></table>';
// break;
// }


$DBUSER="root";
$DBPASSWD="";
$DATABASE="tampon3";

$filename = "backup-" . date("d-m-Y") . ".sql.gz";
$mime = "application/x-gzip";

header( "Content-Type: " . $mime );
header( 'Content-Disposition: attachment; filename="' . $filename . '"' );

// // $cmd = "mysqldump -u $DBUSER --password=$DBPASSWD $DATABASE | gzip --best";   
$cmd = "mysqldump -u $DBUSER --password=$DBPASSWD $DATABASE > export_into_db2.sql";   


passthru( $cmd );

// exit(0);
?>


?>
<?php



ini_set('display_errors','on');

//include '../menu.php';

include '../../../connection/function/Kezia_BDD.php';
include '../../../connection/interface/function/function_recheck_refused_prod.php';
include '../../../connection/function/function_prepare.php';


recheck(2);


?>

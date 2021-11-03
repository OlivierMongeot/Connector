<html>
<meta charset="UTF-8">
<head>
    <style> 
input[type=text] {
  width: 230px;
  /*box-sizing: border-box;*/
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  /*background-image: url('favicon-32x32.png');*/
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 100%;
}
</style>
    <title>PrestaKez</title>
<link href="style.css" rel="stylesheet" media="all" type="text/css"> 
<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
</head>

<body>
<?php
include 'Kezia_func.php';
include 'Kezia_insert.php';
include 'menu.php';
?>

             
    </br>
         <form>
  <input type="text" name="search" placeholder="Search..">
</form>
    </body>
</html>
<html>

<head>
   <title>COMMANDES</title>
       </head>
<body>

  
<?php 
include 'menu.php';
?>

<!-- <div class="container"></div> -->

   <div class="jumbotron jumbotron-fluid">
  <div class="container">
   <h1>Verification des commandes</h1> 

    </div>
</div>


 <div class="container">

<div class="container">
  <div class="row">
    <div class="col-sm-12">

 <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>NOUVELLES COMMANDES   
      </th>
         
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php
 		select__last_order();
 		?></td>
    
    
      </tr>
     
    </tbody>
  </table>

 <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>COMMANDES A FINALISER 
      </th>
  
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php
 list_sans_image();
    ?></td>
    
    
      </tr>
     
    </tbody>
  </table>




</div>
  



    <div class="col-sm-12">
 




<table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>DERNIERES COMMANDES
      </th>
  
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php
select_test();

    ?></td>
    
    
      </tr>
     
    </tbody>
  </table>





<?php 

?>

  </body>
</html>


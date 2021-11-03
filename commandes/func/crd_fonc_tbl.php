<?php

function afficherTableau($rows, $headers) 
{
			?>
			<table border="1">
		    <tr>
		    <?php
		    foreach ($headers as $header): 
		    ?>
		    <th><?php echo $header; ?></th>
		    <?php 
			endforeach; ?>
		    </tr>



			<?php foreach ($rows as $row): ?>
			    <tr>
	
			    <?php for ($k = 0; $k < count($headers); $k++): ?>
			    	<?php if ($k == 0){ ?>
			    		
<td>
<?php 
echo '<a href=crd_formulaire.php?id= ' 

.$row[$k]. '>'
.$row[$k]. '</a>';
 ?>
 </td>
			    	<?php } else { ?>
			    		<td><?php echo $row[$k]; ?></td>
			    	<?php } ?>
			        
			    <?php endfor; ?>
			    </tr>
	

			<?php endforeach; ?>
	
		</table>
		<?php
}

function getHeaderTable() {
	$headers = array();
	$headers[] = "NO_WEB";
	$headers[] = "CODE_WEB";
	$headers[] = "LIV";
	$headers[] = "ADR1";
	$headers[] = "ADR2";
	$headers[] = "CP";
	$headers[] = "VILLE";
	$headers[] = "PAYS";
	$headers[] = "DATECDE";
	$headers[] = "PORT";
	$headers[] = "MODE_DE_REGLEMENT";
	$headers[] = "NOTA";
	$headers[] = "TRAITE";


	return $headers;
}

	?>

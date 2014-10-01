
<div id="content">
	<h4>Bienvenue M. <?php echo $Nom; ?></h4>
	<div>
		<h5>Inscriptions valid&eacute;es</h5>
		<?php
			if (count($Inscription) > 0 ) {
		?>  

				<table>
					<tr>
						<th width="260px">Nom de la mati&egrave;re</th>
						<th width="260px">Fili&egrave;re rattach&eacute;e</th>
						<th width="60px">TP</th>
						<th width="60px">TD</th>
						<th width="60px">Cours</th>
						<th width="60px">Total</th>
					</tr>	
					<?php
					
						$NbrCol=5; //: //le nombre de colonnes
						$NbrLigne= count($Inscription) - 1;// : le nombre de lignes
						 
					
						for ($i=0; $i<=$NbrLigne; $i++){ 
					?>
					<tr>
						<?php for ($j=0; $j<=$NbrCol; $j++){ 	?>	
							<td> <?php echo $Inscription[$i][$j]; ?>	</td>
						<?php }  ?>
					</tr>
					<?php } ?>
				</table>
		<?php } else { ?>
		
			<h6>Aucune inscriptions valid&eacute;es</h6>
		
		
		<?php } ?>
	</div>
	<div>
		<h5>Inscription en cours d'arbitrage</h5>
		<?php
			if (count($Conflit) > 0 ) {
		?>  
			<table>
				<tr>
					<th width="260px">Nom de la mati&egrave;re</th>
					<th width="260px">Fili&egrave;re rattach&eacute;e</th>
					<th width="60px">TP</th>
					<th width="60px">TD</th>
					<th width="60px">Cours</th>
					<th width="60px">Total</th>
				</tr>
				<?php
				
					$NbrCol=5; //: //le nombre de colonnes
					$NbrLigne= count($Conflit) - 1;// : le nombre de lignes
					 
				
					for ($i=0; $i<=$NbrLigne; $i++){ 
				?>
				<tr>
					<?php for ($j=0; $j<=$NbrCol; $j++){ 	?>	
						<td> <?php echo $Conflit[$i][$j]; ?>	</td>
					<?php }  ?>
				</tr>
				<?php } ?>
			</table>
		<?php } else { ?>
		
			<h6>Aucune inscription en cours d'arbitrage</h6>
		
		
		<?php } ?>
	</div>
</div>

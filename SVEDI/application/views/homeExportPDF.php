
<div id="content">
	<h4>Etat Enseignant de <?php echo $Prefix.' '.$Nom; ?></h4> 
	<h5> <?php echo(" le ");setlocale (LC_TIME, 'fr_FR.utf8','fra');echo (strftime("%A %d %B %Y"));?><h5>
	<div>
		<h5>Inscriptions valid&eacute;es</h5>
		<br />
		<br />
		<?php
			if (count($Inscription) > 0 ) {
		?>  

				<table>
					<tr>
						<th width="200px">Nom de la mati&egrave;re</th>
						<th width="200px">Fili&egrave;re rattach&eacute;e</th>
						<th width="40px">TP</th>
						<th width="40px">TD</th>
						<th width="40px">Cours</th>
						<th width="40px">Total</th>
					</tr>	
					<?php
					
						$NbrCol=5; //: //le nombre de colonnes
						$NbrLigne= count($Inscription) - 1;// : le nombre de lignes
						 
					
						for ($i=0; $i<=$NbrLigne; $i++){ 
					?>
					<tr>
						<?php for ($j=0; $j<=$NbrCol; $j++){ 	?>	
							<td align="center"> <?php echo $Inscription[$i][$j]; ?>	</td>
						<?php }  ?>
					</tr>
					<?php } ?>
				</table>
		<?php } else { ?>
		
			<h6 class="h6Decal">Aucune inscriptions valid&eacute;es</h6>
		
		
		<?php } ?>
	</div>
	<div>
		
		<h5>Inscription en cours d'arbitrage</h5>
		<br />
		<br />
		<?php
			if (count($Conflit) > 0 ) {
		?>  
			<table>
				<tr>
					<th width="200px">Nom de la mati&egrave;re</th>
					<th width="200px">Fili&egrave;re rattach&eacute;e</th>
					<th width="40px">TP</th>
					<th width="40px">TD</th>
					<th width="40px">Cours</th>
					<th width="40px">Total</th>
				</tr>
				<?php
				
					$NbrCol=5; //: //le nombre de colonnes
					$NbrLigne= count($Conflit) - 1;// : le nombre de lignes
					 
				
					for ($i=0; $i<=$NbrLigne; $i++){ 
				?>
				<tr>
					<?php for ($j=0; $j<=$NbrCol; $j++){ 	?>	
						<td align="center"> <?php echo $Conflit[$i][$j]; ?>	</td>
					<?php }  ?>
				</tr>
				<?php } ?>
			</table>
		<?php } else { ?>
		
			<h6 class="h6Decal">Aucune inscription en cours d'arbitrage</h6>
		
		
		<?php } ?>
	</div>
</div>

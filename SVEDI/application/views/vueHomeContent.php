
<div id="content">
	<p id="UserTypeLink"><a  href="../ControleurHome/ExportPDF"> Exporter son état<img src="../../assets/images/iconePdf.png" /></a></p>

	<h4>Bienvenue <?php echo $Prefix.' '.$Nom; ?></h4>
	<div>
		<p>Nombre annuel d'heures à completer : <b><?php echo $todo;?>h</b></p>
		<p>Vous êtes actuellement inscrit à <b><?php echo number_format($actual,1);?>h</b>, il vous manque <b><?php echo number_format($todo-$actual,1);?>h</b> pour completer votre quotat.</p>
		<p class="rappel">Rappel : 1h de TP = 0,66h de TD<br/> 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1h de cours = 1,5h de TD</p>
		<br/>
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
						<th>Suppr.</th>
								
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
						<td class="supprTD"><img id="IS<?php echo $Inscription[$i][6]; ?>" src="../../assets/images/iconeSupprimer.png"/></td>
					<?php } ?>
					</tr>
				</table>
				<p  class="log" id="ILog"><?php echo @$Log;?></p>
		<?php } else { ?>
		
			<h6 class="h6Decal">Aucune inscriptions valid&eacute;es</h6>
		
		
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
					<th>Suppr.</th>
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
					<td class="supprTD"><img id="CS<?php echo $Conflit[$i][6]; ?>"  src="../../assets/images/iconeSupprimer.png"/></td>
				<?php } ?>
				
					
				</tr>
			</table>
			<p  class="log" id="CLog"><?php echo @$Log;?></p>
		<?php } else { ?>
		
			<h6 class="h6Decal">Aucune inscription en cours d'arbitrage</h6>
		
		
		<?php } ?>
	</div>
</div>

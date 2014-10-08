<div id="content">
	<input type="hidden" id="baseUrl" value="<?php echo base_url();?>"/>
	 <h4>Liste des fili&egrave;res</h4>
	 <div>
	<?php 
		if (sizeof($Resultats) > 0){

			$i = 0;

			for($i = 0; $i < sizeof($Resultats); $i++){
	 ?>

		<p><a href="<?php echo base_url().'controleurRechercheCatalogue/?id='.$Resultats[$i]['F_ID'];?>"><?php echo $Resultats[$i]['F_Nom']?></a></p>
	<?php 
			}

		}
	?>
</div>
</div>


<div id="nav">
	<div id="enseignant" class="ouvert">
		<h2>Enseignant</h2>
		<ul>
			<li><a href="<?php echo base_url()."ControleurHome/";?>">Mes inscriptions</a></li>
			<li><a href="<?php echo base_url()."controleurRechercheCatalogue/"?>">Catalogue de mati&egrave;res</a></li>
			<li><a href="<?php echo base_url()."controleurProfilUtilisateur/"?>">Mon profil</a></li>
		</ul>
	</div>

	<?php
$role = $this->session->userdata('Role');

if($role > 1){
	?>

	<div id="responsable" class="ferme">
		<h2>Responsable</h2>
		<ul>
			<li><a href="<?php echo base_url()."ControleurRespEtatGeneral/";?>">Etat g&eacute;n&eacute;ral</a></li>
			<li><a href="<?php echo base_url()."ControleurRespModifierFiliere/";?>">Modifier ma fili&egrave;re</a></li>
			<li><a href="<?php echo base_url()."ControleurRespInscrEns/";?>">Inscrire un enseignant &agrave; une mati&egrave;re</a></li>
			<li><a href="<?php echo base_url()."ControleurRespDescrEns/";?>">D&eacute;sinscrire un enseignant &agrave; une mati&egrave;re</a></li>
		</ul>
	</div>

	<?php
}

?>

	<div id="notifications">
		<h3>Notifications</h3>

	</div>
	<div id="listNotifs">
		
		<?php
			if (count($Notification) > 0 ) {
			$NbrLigneN=count($Notification);
				for ($i=0; $i<$NbrLigneN; $i++) 
				{ 
				
				if($Notification[$i][3] != 'Desinscription'){
			?>
				<div id="<?php echo $Notification[$i][9] ?>">
				<h4><?php echo $Notification[$i][3].'-' .$Notification[$i][1] ; ?></h4>
				<p>  

					Fili&egrave;re:<span> <?php echo $Notification[$i][5] ; ?></span><br/>
					Mati&egrave;re:<span> <?php echo $Notification[$i][4] ; ?></span><br/>
					TP: <span><?php echo $Notification[$i][7] ; ?>H</span><br/>
					TD: <span><?php echo $Notification[$i][6] ; ?>H</span><br/>
					Cours: <span><?php echo $Notification[$i][8] ; ?>H</span><br/>
				    Info: <span><?php echo $Notification[$i][0] ; ?></span><br/>
				</p>
				</div>
				
		<?php 
			   } else {
		?>
			   <div id="<?php echo $i ?>">
				<h4><?php echo $Notification[$i][3].'-' .$Notification[$i][1] ; ?></h4>
				<p>
				    Info: <span><?php echo $Notification[$i][0] ; ?></span><br/>
				</p>
				</div>
			   
			<?php    
			   }
			  } 
			} 
		?>	

	</div>
</div>
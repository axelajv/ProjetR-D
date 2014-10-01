<div id="nav">
	<div id="enseignant" class="ouvert">
		<h2>Enseignant</h2>
		<ul>
			<li ><a href="../ControleurProfilUtilisateur/" style="text-decoration:none" color="red">Gestion de profil</a></li>
			<li>Recherche de mati&egrave;res</li>
		</ul>
	</div>
	<div id="responsable" class="ferme">
		<h2>Responsable</h2>
		<ul>
			<li>Mon profil</li>
			<li>Recherche de mati&egrave;res</li>
			<li>Recherche de mati&egrave;res</li>
			<li>Recherche de mati&egrave;res</li>
		</ul>
	</div>
	<div id="notifications">
		<h3>Notifications</h3>

	</div>
	<div id="listNotifs">
		
		<?php
			if (count($Notification) > 0 ) {
			$NbrLigneN=count($Notification);
			for ($i=0; $i<=$NbrLigneN; $i++) 
			{ 
		?>
			<div id="<?php echo $i ?>">
			<h4><?php echo $Notification[$i][3].'-' .$Notification[$i][1] ; ?></h4>
			<p>  

				Fili&egrave;re :<span><?php echo $Notification[$i][5] ; ?></span><br/>
				Mati&egrave;re :<span><?php echo $Notification[$i][4] ; ?></span><br/>
				TP : <span><?php echo $Notification[$i][7] ; ?>H</span><br/>
				TD : <span><?php echo $Notification[$i][6] ; ?>H</span><br/>
				Cours : <span><?php echo $Notification[$i][8] ; ?>H</span><br/>
			    Info : <span><?php echo $Notification[$i][0] ; ?></span><br/>
			</p>
			</div>
			
		<?php } } ?>	

	</div>
</div>
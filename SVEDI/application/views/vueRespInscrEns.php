<div id="content">
	<h4>Inscrire un enseignant à une matière de la filière "<?php echo stripslashes($FiliereNom); ?>"</h4>
<div>
	<p>Choisir la matière sur laquel vous souhaitez effectuer une inscription : <?php echo $listM;?></p>
	<p id="infoM"></p>

	<p>Saisir le nombre d'heure pour l'inscription à réaliser :</p>
	<table width="760px">
	<tr><td>Heures de Cours : <input id="HC" name="heure de cours" onkeyup="this.value=this.value.replace(/[^\d]/,'')" type="text"/></td>
		<td>Heures de TD : <input id="HTD" name="heure de cours" onkeyup="this.value=this.value.replace(/[^\d]/,'')" type="text"/></td>
		<td>Heures de TP : <input id="HTP" name="heure de cours" onkeyup="this.value=this.value.replace(/[^\d]/,'')" type="text"/></td>
		</tr>
	</table><br/>

	<p>Selectionner l'enseignant que vous souhaitez assoscier à cette inscription :</p>
	<p><?php echo $listE;?></p>
	<p><input type="submit" id="inscrireEns" value="Finaliser l'inscription"/></p>	
	<p class="logResp" id="logMsg"></p>
</div>
</div>

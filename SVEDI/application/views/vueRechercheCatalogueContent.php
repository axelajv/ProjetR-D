<div id="content">
	<input type="hidden" id="baseUrl" value="<?php echo base_url();?>"/>
	
	<?php 
		if (sizeof($Resultats) > 0){
echo "<h4>Liste de mati&egrave;res de la fili&egrave;re \"".$Keywords."\"</h4>";
echo "<div><p><a href=\"".base_url()."controleurRechercheCatalogue/\">Retour au catalogue</a><br/><br/></p></div>";

			$i = 0;

			for($i = 0; $i < sizeof($Resultats); $i++){

				if($Resultats[$i]['U_Sexe']=="M"){
					$prefixe = "Mr";
				}else{
					$prefixe = "Mme";
				}

				if($Resultats[$i]['M_SumHTP'] >= $Resultats[$i]['HTP']){
					if($Resultats[$i]['M_SumHTP'] == $Resultats[$i]['HTP']){
						$ClasseTPFull = "gras";
					}else{
						$ClasseTPFull = "full";
					}
				}else{
					$ClasseTPFull = "";
				}

				if($Resultats[$i]['M_SumHTD'] >= $Resultats[$i]['HTD']){
					if($Resultats[$i]['M_SumHTD'] == $Resultats[$i]['HTD']){
						$ClasseTDFull = "gras";
					}else{
						$ClasseTDFull = "full";
					}
				}else{
					$ClasseTDFull = "";
				}

				if($Resultats[$i]['M_SumHC'] >= $Resultats[$i]['HC']){
					if($Resultats[$i]['M_SumHC'] == $Resultats[$i]['HC']){
						$ClasseCoursFull = "gras";
					}else{
						$ClasseCoursFull = "full";
					}
				}else{
					$ClasseCoursFull = "";
				}


	 ?>
	<div class="resultSearch">
		<table>
			<tr>
				<td>Heure de TP :</td>
				<td class="<?php echo $ClasseTPFull;?>"><?php echo $Resultats[$i]['M_SumHTP']."/".$Resultats[$i]['HTP'];?></td>
				<td rowspan="3"><img alt="inscription" src="../../assets/images/inscription.png"/></td>
			</tr>
			<tr>
				<td>Heure de TD :</td>
				<td class="<?php echo $ClasseTDFull;?>"><?php echo $Resultats[$i]['M_SumHTD']."/".$Resultats[$i]['HTD'];?></td>
			</tr>
			<tr>
				<td>Heure de cours :</td>
				<td class="<?php echo $ClasseCoursFull;?>"><?php echo $Resultats[$i]['M_SumHC']."/".$Resultats[$i]['HC'];?></td>
			</tr>
		</table>
		<h6 id="<?php echo $Resultats[$i]['M_ID'];?>"> <span class="bleu"><?php echo $Resultats[$i]['F_Nom']."</span> (".$prefixe." ".$Resultats[$i]['U_Nom'];?>
			<a href="mailto:<?php  echo $Resultats[$i]['U_Mail']; ?>"><img class="mailIcon" alt="mail" src="../../assets/images/mailIcon.png" /></a>)</h6>

			<input type="hidden" id="<?php echo $Resultats[$i]['M_ID'];?>-HC" value="<?php if($Resultats[$i]['HC']-$Resultats[$i]['M_SumHC'] > 0){ echo $Resultats[$i]['HC']-$Resultats[$i]['M_SumHC'];}else{echo "0";}?>"/>
			<input type="hidden" id="<?php echo $Resultats[$i]['M_ID'];?>-HCMAX" value="<?php echo $Resultats[$i]['HC'];?>"/>
			<input type="hidden" id="<?php echo $Resultats[$i]['M_ID'];?>-HTD" value="<?php if($Resultats[$i]['HTD']-$Resultats[$i]['M_SumHTD'] > 0){ echo $Resultats[$i]['HTD']-$Resultats[$i]['M_SumHTD'];}else{echo "0";}?>"/>
			<input type="hidden" id="<?php echo $Resultats[$i]['M_ID'];?>-HTDMAX" value="<?php echo $Resultats[$i]['HTD'];?>"/>
			<input type="hidden" id="<?php echo $Resultats[$i]['M_ID'];?>-HTP" value="<?php if($Resultats[$i]['HTP']-$Resultats[$i]['M_SumHTP'] > 0){ echo $Resultats[$i]['HTP']-$Resultats[$i]['M_SumHTP'];}else{echo "0";}?>"/>
			<input type="hidden" id="<?php echo $Resultats[$i]['M_ID'];?>-HTPMAX" value="<?php echo $Resultats[$i]['HTP'];?>"/>

		<p><?php echo $Resultats[$i]['M_Nom'];?></p>
	</div>
	<?php 
			}

		}else{
				echo "<h4>L'URL de la page a été modifiée.</h4>";
		}
	?>
</div>


<div id="modal">
<div id="popUp">
	<div id="inscriptionDiv">
	<input type="hidden" id="ID_Matiere" value="" />
<p class="popUpTitle">Inscription &agrave; <span id="popUpTitleMatiere"></span><span class="closePopUp">X</span></p>
<table>
<tr>
	<td colspan="3">Etat actuel</td>
	<td colspan="2">Demande</td>
</tr>
<tr>
	<td>Heures de TP</td>
	<td>Heures de TD</td>
	<td>Heures de cours</td>
	<td>TP : <input tabindex="1" type="text"  onkeyup="this.value=this.value.replace(/[^\d]/,'')" id="inputHTP"/></td>
	<td rowspan="3" class="submitCell"><input tabindex="4" type="submit" value="Valider" id="validerPopUp" class="button"/></td>
</tr>
<tr>
	<td>Disponibles : <span id="TP_dispo"></span>h</td>
	<td>Disponibles : <span id="TD_dispo"></span>h</td>
	<td>Disponibles : <span id="cours_dispo"></span>h</td>
	<td>TD :  <input  tabindex="2" type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" id="inputHTD"/></td>
	
</tr>
<tr>
	<td>Maximum : <span id="TP_max"></span>h</td>
	<td>Maximum : <span id="TD_max"></span>h</td>
	<td>Maximum : <span id="cours_max"></span>h</td>
	<td>Cours :  <input tabindex="3" type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" id="inputHC"/></td>
</tr>
</table>
<p id="msgConflit">Attention, votre saisie entrainera un dépassement du cotat maximal. Tout les enseignants concernés par cette matière en seront informés, ainsi que le responsable de la filière qui arbitrera le conflit.</p>
</div>
<div id="confirmationDiv">
	<p class="popUpTitle">Information<span class="closePopUp">X</span></p>
	<br/>
	<p id="msgInfo"></p>
	<p class="center"><input class="button" type="submit" value="Retour" id="retourBtn"/></p>
</div>
</div>
</div>
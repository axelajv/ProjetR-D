<div id="content" class="decal">
	<p id="retourAdminLink"><a href="../ControleurAdminHome/">Retour au panneau d'administration</a></p>
<?php 

	if ($FiliereNom != false){
		echo '<h4>Modification de la filière '.$FiliereNom.'</h4>';
	}else{
		echo '<h4>Création d\'une filière</h4>';
	}

?>
	<input type="hidden" id="FID" value="<?php echo @$FID;?>"/>
	<div id="Resp">
		<p>Nom de la filière : <input type="text" id="FNom" value="<?php echo $FiliereNom;?>"/><input type="submit" value="Changer nom" id="saveBtn"/></p>
		<p>Responsable : <?php echo $SelectResp;?><input type="submit" value="Changer responsable" id="saveBtnResp"/></p>

		<br/>
		</p>

						<h5>Liste des matières</h5>
						<table>
							<tr>
								<th width="200px">Nom</th>
								<th width="120px">Heures de cours</th>
								<th width="120px">Heures de TD</th>
								<th width="120px">Heures de TP</th>
								<th width="80px">Semestre</th>
								<th width="50px">Modif.</th>
								<th width="50px">Suppr.</th>
							</tr>
							<?php 
								for($i=0;$i < sizeof(@$Matieres);$i++){
							?>
							<tr>
								<td><?php echo $Matieres[$i]['M_Nom'];?></td>
								<td><?php echo $Matieres[$i]['M_HC'];?>h</td>
								<td><?php echo $Matieres[$i]['M_HTD'];?>h</td>
								<td><?php echo $Matieres[$i]['M_HTP'];?>h</td>
								<td>S<?php echo $Matieres[$i]['M_Semestre'];?></td>
								<td>
									<input type ="hidden" value="<?php echo $Matieres[$i]['M_Nom'];?>" id="M<?php echo $Matieres[$i]['M_ID'];?>-Nom"/>
									<input type ="hidden" value="<?php echo $Matieres[$i]['M_HC'];?>" id="M<?php echo $Matieres[$i]['M_ID'];?>-HC"/>
									<input type ="hidden" value="<?php echo $Matieres[$i]['M_HTD'];?>" id="M<?php echo $Matieres[$i]['M_ID'];?>-HTD"/>
									<input type ="hidden" value="<?php echo $Matieres[$i]['M_HTP'];?>" id="M<?php echo $Matieres[$i]['M_ID'];?>-HTP"/>
									<input type ="hidden" value="<?php echo $Matieres[$i]['M_Semestre'];?>" id="M<?php echo $Matieres[$i]['M_ID'];?>-Semestre"/>
									<img id="MM<?php echo $Matieres[$i]['M_ID'];?>" src="../../assets/images/iconeModifier.png"/></td>
								<td><img id="MS<?php echo $Matieres[$i]['M_ID'];?>" src="../../assets/images/iconeSupprimer.png"/></td>
							</tr>
							<?php 
								}
							?>
						</table>
						<h6 id="addMatiereResp"><a href="">Ajouter une matière <img id="addMatiereRespImg" src="../../assets/images/addFiliere.png" alt="add" /></a></h6>

						<p class="log respLog" id="Log"><?php echo @$Log;?></p>
		</div>
</div>



<div id="modal">
	<div id="popUpMatiere">
		<p class="popUpTitle"><span id="Title"></span><span class="closePopUp">X</span></p>
		<p class="contentPopUp">

			<input id="popUpID" type="hidden" />
			Nom : </br><input id="popUpNom" type="text" /></br></br>
			Heures de cours : </br><input id="popUpHC"  onkeyup="this.value=this.value.replace(/[^\d]/,'')"  type="text" /></br></br>
			Heures de TD : </br><input id="popUpHTD"  onkeyup="this.value=this.value.replace(/[^\d]/,'')" type="text" /></br></br>
			Heures de TP : </br><input id="popUpHTP" onkeyup="this.value=this.value.replace(/[^\d]/,'')"  type="text" /></br></br>
			Semestre : <select id="popUpSemestre"><option value="1">S1</option><option value="2">S2</option></select>
		</p>
		<p class="log" id="msgInfo"></p>
			<p class="center"><input class="button" type="submit" value="Modifier" id="validerMM"/><input class="button" type="submit" value="Créer" id="validerMA"/></p>
	</div>
</div>
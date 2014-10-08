
<div id="admin">
	<input type="hidden" id="baseUrl" value="<?php echo base_url();?>"/>
	<p id="UserTypeLink"><a href="../ControleurAdminHome/">retour à l'accueil</a></p>

	<h4>Panneau d'administration</h4>
	<div>
		<table id="layout">
			<tr  class="noBg">
				<td>
					<h6 class="center"><a id="newStatut" href="">Ajouter un statut <img id="addFiliereImg" src="../../assets/images/addFiliere.png" alt="add" /></a></h6>
					<br/>
					<h5>Liste des statuts enseignants</h5>
					<br/>
					<table>
						<tr>
							<th width="200px">Code</th>
							<th width="200px">Libellé</th>
							<th width="260px">Heures</th>
							<th width="70px">Modif.</th>
							<th width="70px">Suppr.</th>
						</tr>
						<?php 
							for($i=0;$i < sizeof($Types);$i++){
						?>
						<tr>
							
							<td><?php echo $Types[$i]['Code'];?></td>
							<td><?php echo $Types[$i]['Libelle'];?></td>
							<td><?php echo $Types[$i]['NbHeure'];?></td>
							<td><form>
								<input type ="hidden" value="<?php echo  $Types[$i]['Code'];?>" id="U<?php echo $Types[$i]['ID'];?>-Code"/>
								<input type ="hidden" value="<?php echo $Types[$i]['Libelle'];?>" id="U<?php echo $Types[$i]['ID'];?>-Libelle"/>
								<input type ="hidden" value="<?php echo $Types[$i]['NbHeure'];?>" id="U<?php echo $Types[$i]['ID'];?>-NbHeure"/>
								</form>
								<img id="SM<?php echo $Types[$i]['ID'];?>" src="../../assets/images/iconeModifier.png"/></td>
							<td><img id="SS<?php echo $Types[$i]['ID'];?>" src="../../assets/images/iconeSupprimer.png"  /></td>
						</tr>
						<?php 
							}
						?>
					</table>
					<p  class="log" id="ULog"><?php echo @$Log;?></p>
				</tr>
			</td>
		</table>
	</div>
</div>

<div id="modal">
<div id="popUpStatut">
<p class="popUpTitle"><span id="Title"></span><span class="closePopUp">X</span></p>
<p>
	<table>
		<tr>
			<td>
				<input id="popUpID" type="hidden" />
				Code: </br><input id="popUpCode" type="text" /></br></br>
				Libellé : </br><input id="popUpLibelle" type="text" /></br></br>
				quota d'heures : </br><input id="popUpNbHeure" type="text" /></br></br>
				
			</td>	
		</tr>
	</table>
</p>
<p class="log" id="msgInfo"></p>
	<p class="center"><input class="button" type="submit" value="Modifier" id="validerSM"/><input class="button" type="submit" value="Créer" id="validerSA"/></p>

</div>
</div>
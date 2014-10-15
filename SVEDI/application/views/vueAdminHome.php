<div id="admin">
	<input type="hidden" id="baseUrl" value="<?php echo base_url();?>"/>
<p id="UserTypeLink"><a href="../ControleurTypeUtilisateur/">Param&eacute;trage des statuts enseignants</a></p>
	<h4>Panneau d'administration</h4>
	<div>
		<table id="layout">
			<tr  class="noBg">
				<td>
					<h6 class="center"><a id="newUser" href="">Ajouter un utilisateur <img id="addUserImg" src="../../assets/images/addUser.png" alt="add" /></a></h6>
					<br/>
					<h5>Liste des comptes utilisateurs</h5>
					<table>
						<tr>
							<th width="200px">Nom</th>
							<th width="200px">Pr&eacute;nom</th>
							<th width="260px">Mail</th>
							<th width="50px">Modif.</th>
							<th width="50px">Suppr.</th>
						</tr>
						<?php 
							for($i=0;$i < sizeof($Users);$i++){
						?>
						<tr>
							<td><?php echo $Users[$i]['U_Nom'];?></td>
							<td><?php echo $Users[$i]['U_Pre'];?></td>
							<td><?php echo $Users[$i]['U_Mail'];?></td>
							<td><form>
								<input type ="hidden" value="<?php echo $Users[$i]['U_Nom'];?>" id="U<?php echo $Users[$i]['U_ID'];?>-Nom"/>
								<input type ="hidden" value="<?php echo $Users[$i]['U_Pre'];?>" id="U<?php echo $Users[$i]['U_ID'];?>-Prenom"/>
								<input type ="hidden" value="<?php echo $Users[$i]['U_Mail'];?>" id="U<?php echo $Users[$i]['U_ID'];?>-Mail"/>
								<input type ="hidden" value="<?php echo $Users[$i]['U_Tel'];?>" id="U<?php echo $Users[$i]['U_ID'];?>-Tel"/>
								<input type ="hidden" value="<?php echo $Users[$i]['U_Sexe'];?>" id="U<?php echo $Users[$i]['U_ID'];?>-Sexe"/>
								<input type ="hidden" value="<?php echo $Users[$i]['U_Mdp'];?>" id="U<?php echo $Users[$i]['U_ID'];?>-Mdp"/>
								<input type ="hidden" value="<?php echo $Users[$i]['U_Login'];?>" id="U<?php echo $Users[$i]['U_ID'];?>-Login"/>
								<input type ="hidden" value="<?php echo $Users[$i]['U_Role'];?>" id="U<?php echo $Users[$i]['U_ID'];?>-Role"/>
								<input type ="hidden" value="<?php echo $Users[$i]['U_Type'];?>" id="U<?php echo $Users[$i]['U_ID'];?>-Type"/>
								</form>
								<img id="UM<?php echo $Users[$i]['U_ID'];?>" src="../../assets/images/iconeModifier.png"/></td>
								<td>
						<?php 
							if($Users[$i]['U_ID'] != $Id_user) {
						?>
							<img id="US<?php echo $Users[$i]['U_ID'];?>" src="../../assets/images/iconeSupprimer.png"/>
						<?php 
							}
						?>
							</td>
						</tr>
						<?php 
							}
						?>
					</table>
					<p  class="log" id="ULog"><?php echo @$Log;?></p>
				</td>
				<td>
					<h6 class="center"><a href="../ControleurAdminModifierFiliere/">Ajouter une fili&egrave;re <img id="addFiliereImg" src="../../assets/images/addFiliere.png" alt="add" /></a></h6>
					<br/>
					<h5>Liste des fili&egrave;res</h5>
					<table>
						<tr>
							<th width="200px">Nom</th>
							<th width="220px">Nombre de mati&egrave;res</th>
							<th width="200px">Enseignants inscrits</th>
							<th width="70px">Export</th>
							<th width="50px">Modif.</th>
							<th width="50px">Suppr.</th>
						</tr>
						<?php 
							for($i=0;$i < sizeof($Filieres);$i++){
						?>
						<tr>
							<td><?php echo $Filieres[$i]['F_Nom'];?></td>
							<td><?php echo $Filieres[$i]['F_Nbm'];?></td>
							<td><?php echo $Filieres[$i]['F_Nbi'];?></td>
							<td class="export"><img id="FE<?php echo $Filieres[$i]['F_ID'];?>" src="../../assets/images/ExportCSV.png"/></td>
							<td><img id="FM<?php echo $Filieres[$i]['F_ID'];?>" src="../../assets/images/iconeModifier.png"/></td>
							<td><img id="FS<?php echo $Filieres[$i]['F_ID'];?>" src="../../assets/images/iconeSupprimer.png"/></td>
						</tr>
						<?php 
							}
						?>
					</table>
					<p class="log" id="FLog"></p>
					</td>
			</tr>
		</table>
		
	</div>
</div>


<div id="modal">
<div id="popUpUser">
<p class="popUpTitle"><span id="Title"></span><span class="closePopUp">X</span></p>
<p>

	<table>
		<tr>
			<td colspan="2" class="center">
				Civilit&eacute; : &nbsp;&nbsp;&nbsp;&nbsp;<input name="Sexe" value="F" type="radio" id="r1"/> <label for="r1">Madame</label>&nbsp;&nbsp;&nbsp;&nbsp; <input name="Sexe" value="M" id="r2" type="radio"/> <label for="r2">Monsieur</label><br/><br/>
			</td>
		</tr>
		<tr>
			<td>
				<input id="popUpID" type="hidden" />
				Nom : </br><input id="popUpNom" type="text" onblur="verifNom(this)" /></br></br>
				Prenom : </br><input id="popUpPrenom" type="text" onblur="verifPrenom(this)" /></br></br>
				Adresse Mail : </br><input id="popUpMail" type="text" onblur="verifMail(this)" /></br></br>
				T&eacute;l&eacute;phone : </br><input id="popUpTel"  type="text" onblur="verifTel(this)" /></br>
			</td>	
			<td>
				Login : </br><input id="popUpLogin" type="text" onblur="verifNom(this)" /></br></br>
				Mot de passe : </br><input id="popUpMdp" type="text" onblur="verifMDP(this)" /></br></br>
				Rôle : </br>
				<?php echo $Roles; ?>
				</br></br>
				Type : </br>
				<?php echo $Types; ?>
			</td>
		</tr>
	</table>
</p>
<p class="log" id="msgInfo"></p>
	<p class="center"><input class="button" type="submit" value="Modifier" id="validerUM"/><input class="button" type="submit" value="Cr&eacute;er" id="validerUA" onsubmit="return verifForm(this)"/></p>

</div>
</div>
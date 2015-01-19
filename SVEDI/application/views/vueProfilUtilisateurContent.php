<div id="content">
	<h4>Gestion de mon profil utilisateur</h4>
	<div>
	<table id="layoutProfil">
		<tr class="noBg">
			<td>
				 <form action="ModificationDP" method="POST" onsubmit="return verifForm(this)"> <!--onsubmit=""return verifForm(this)-->
					<h5>Données personnelles</h5>
					<p> 
						<p>Civilité : <br/><input name="Sexe" value="F" type="radio" id="r1" <?php if($DP[5]=='F'){echo "checked";}?>/> <label for="r1">Madame</label> <br/><input name="Sexe" value="M" id="r2" type="radio" <?php if($DP[5]=='M'){echo "checked";}?>/> <label for="r2">Monsieur</label><br/><br/>
						Nom : <br/><input type="text"  name="Nom" onblur="verifNom(this)"  value="<?php echo stripslashes($DP[0]) ; ?>" /><br/><br/>
						Pr&eacute;nom : <br/><input type="text"  name="Prenom" onblur="verifPrenom(this)" value="<?php echo $DP[1] ; ?>"><br/><br/>
						Adresse mail : <br/><input type="text"  name="Mail" onblur="verifMail(this)" value="<?php echo $DP[2] ; ?>"/><br/><br/>
						Téléphone : <br/><input type="text" name="Tel" onblur="verifTel(this)" value="<?php echo $DP[3] ; ?>" /><br/>
						<br/>
					</p>
					<input class="button" type="submit" value="Appliquer modifications" />
				</form>
				<p><?php echo @$InfoDP ?></p>
			</td>
			<td >
				<form action="ModificationMDP" method="POST" onsubmit=" event.preventDefault(); verifSimilitudeMdp(this,'<?php echo $DP[4] ; ?>');">
					<h5>Modification mot de passe</h5>
					<p>
						Ancien mot de passe : <br/><input type="password"  name="AMdp" onblur="verifAncienMDP(this,'<?php echo $DP[4] ; ?>')"/><br/><br/>
						Nouveau mot de passe : <br/><input type="password"  name="Mdp1" onblur="verifMDP(this)" /><br/><br/>
						Nouveau mot de passe : <br/><input type="password" name="Mdp2" onblur="verifMDP(this)" />
					</p>
					<br/>
					<input class="button" type="submit" value="Changer mot de passe" />
				</form>
				<p><?php echo @$InfoMDP ?></p>
			</td>
		</tr>
	</table>
	</div>
</div>
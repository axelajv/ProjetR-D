<body><div id="svedi">
<img src="../../assets/images/svediMoyen.png"/>
</div>
<div id="connexion">
	<img src="../../assets/images/connexionTop.png"/>
		<div>
			<div id="connect">
			<p>Connectez-vous :</p> 
			<form action="login" method="POST">
				<input type="text" name="login" placeholder="Login"/>
				<input type="password" name="password" placeholder="Password"/>
				<input class="buttonSearch" type="submit" name="valider" value="Connexion"/>
			</form>
			<p ><a id="forgot">Mot de passe oubli&eacute; ?</a></p>
			<p class="full"><?php echo @$error_credentials; ?></p>
			</div>
			<div id="recup"><br/>
				<form action="recupMdp" method="POST">
				<p>Veuillez saisir votre email,<br/>un mot de passe temporaire vous sera envoy&eacute;.</p><br/>
				<input type="text" id="mail" name="mailRecup" placeholder="Adresse email"/>
				<input class="button" type="submit" name="envoiMdp" id="envoiMdp" value="Envoyer"/>
			</form>
			</div>
		</div>
	<img src="../../assets/images/connexionBtm.png"/>
</div>
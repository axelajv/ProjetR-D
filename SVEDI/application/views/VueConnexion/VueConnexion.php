<!DOCTYPE html>
<html lang="fr">
<head>
	<title>SVEDI</title>
	<link rel=stylesheet type="text/css" href="/SVEDI/assets/css/home.css"/>
	<script type="text/javascript" src="/SVEDI/assets/javascript/jquery-2.1.1.min.js"></script>
</head>
<body>
<div  id="svedi">
<img src="/SVEDI/assets/images/svediMoyen.png"/></div>
<div id="connexion">
<img src="/SVEDI/assets/images/connexionTop.png"/>
<div>
<p>Connectez-vous :</p> 
<form action="login" method="POST">
<input type="text" name="login" placeholder="Login"/>
<input type="password" name="password" placeholder="Password"/>
<input class="buttonSearch" type="submit" name="valider" value="Connexion"/>
</form>

<?php

echo $test;
echo @$error_credentials;

?>

<p><a>Mot de passe oubli&eacute; ?</a></p>
</div>
<img src="/SVEDI/assets/images/connexionBtm.png"/></div>

<footer>
<p>Serveur de Voeux des Enseignants du D&eacute;partement Informatique</p>
</footer>
</body>
</html>


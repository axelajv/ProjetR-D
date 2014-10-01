﻿<!DOCTYPE html>
<html lang="fr">
<head>
	<title>SVEDI</title>
	<link rel=stylesheet type="text/css" href="../../assets/css/home.css"/>
	<script type="text/javascript" src="../../assets/javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../../assets/javascript/search.js"></script>
</head>
<body>

<header>
<div id="logo">
	<a href="http://localhost/SVEDI/index.php/ControleurHome/"><img alt="svedi" src="../../assets/images/SVEDI-small.png"/></a>
</div>
<div id="searchBar">
		<form id="newsearch" method="get" action="recherche.html">
		        <input type="text" class="textinput" name="q" size="35" maxlength="120"><input id="btnLoupe" type="submit" value="" class="buttonSearch">
		        <img id="loupeSearchBar" alt="loupe" src="../../assets/images/loupe.png"/>
		</form>

</div>

<p id="deconnexion">
	<a href="connexion.html">D&eacute;connexion</a>
</p>
</header>

<div id="nav">
	<div id="enseignant" class="ouvert">
		<h2>Enseignant</h2>
		<ul>
			<li><a href="http://localhost/SVEDI/index.php/ControleurProfilUtilisateur/">Mon profil</a></li>
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
		<div id="#numéroDeLaNotif#">
			<h4>Inscription - 10/05/2014</h4>
			<p>
				Fili&egrave;re :<br/>
				<span>Licence 3 MIAGE</span><br/>
				Mati&egrave;re :<br/>
				<span>Math&eacute;matique</span><br/>
				TP : <span>0h</span><br/>
				TD : <span>8h</span><br/>
				Cours : <span>10h</span><br/>
			</p>
		</div>
	</div>
</div>
<div id="content">
	<h4>Gestion de mon profil utilisateur</h4>
	<div>
		<form method="post" action="">

			<table id="layoutProfil">
				<tr class="noBg">
					<td>
						<h5>Données personnelles</h5>
						<p>Nom : <br/><input type="text"/><br/><br/>
						Pr&eacute;nom : <br/><input type="text"/><br/><br/>
						Adresse mail : <br/><input type="text"/><br/><br/>
						Téléphone : <br/><input type="text"/><br/>
						<br/></p>
						</td>
						<td>
						<h5>Modification mot de passe</h5>
						<p>Ancien mot de passe : <br/><input type="password"/><br/><br/>
				    	Nouveau mot de passe : <br/><input type="password"/><br/><br/>
						Nouveau mot de passe : <br/><input type="password"/></p>
					</td>
				</tr>
				<tr class="noBg">
					<td colspan="2"><br/>
						<p class="centerProfilUser">
						<input class="button" type="submit" value="Appliquer modifications" />
						<p/>
						<br/>
						<br/>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<footer>
<p>Serveur de Voeux des Enseignants du D&eacute;partement Informatique</p>
</footer>
</body>
</html>

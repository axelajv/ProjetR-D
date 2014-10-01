<!DOCTYPE html>
<html lang="fr">
<head>
	<title>SVEDI</title>
	<link rel=stylesheet type="text/css" href="../../assets/css/home.css"/>
	<script type="text/javascript" src="../../assets/javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../../assets/javascript/search.js"></script>
	<script type="text/javascript" src="../../assets/javascript/popUpMohamed.js"></script>
	<script type="text/javascript" src="../../assets/javascript/VerifFormulaire.js"></script>
</head>
<body>

<header>
<div id="logo">
	<a href="http://localhost/SVEDI/index.php/ControleurHome/"><img alt="svedi" src="../../assets/images/SVEDI-small.png"/></a>
</div>
<div id="searchBar">
		<form id="newsearch" method="get" action="../controleurRecherche/">
		        <input type="text" class="textinput" name="search" size="35" maxlength="120"><input id="btnLoupe" type="submit" value="" class="buttonSearch">
		        <img id="loupeSearchBar" alt="loupe" src="../../assets/images/loupe.png"/>
		</form>

</div>


<p id="deconnexion">
	<a href="../ControleurConnexion/Deconnect">D&eacute;connexion</a>
</p>

</header>
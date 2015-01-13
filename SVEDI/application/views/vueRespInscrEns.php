
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>SVEDI</title>
	<link rel=stylesheet type="text/css" href="../../assets/css/home.css"/>
	<script type="text/javascript" src="../../assets/javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../../assets/javascript/search.js"></script>
	<script type="text/javascript" src="../../assets/javascript/VerifFormulaire.js"></script>
	<script type="text/javascript" src="../../assets/javascript/Desinscription.js"></script>
	<script type="text/javascript" src="../../assets/javascript/Notification.js"></script>


<?php 
	if(@$resp == "Y"){
		echo '<script type="text/javascript" src="../../assets/javascript/isResp.js"></script>';
		echo '<script type="text/javascript" src="../../assets/javascript/Resp.js"></script>';
	}else{
		echo '<script type="text/javascript" src="../../assets/javascript/popUp.js"></script>';
	}

?>

	<style>
	<?php 
	$role = $this->session->userdata('Role');

if($role > 1){
	?>
		#listNotifs{
			z-index:30;
			overflow:auto;
			height: calc(100% - 204px);
		}
	<?php
}else{
	?>
		#listNotifs{
			z-index:30;
			overflow:auto;
			height: calc(100% - 163px);
		}

<?php
}
?></style>
	
</head>
<body>
<header>
	
	<div id="logo">
		<a href="../controleurHome/"><img alt="svedi" src="../../assets/images/SVEDI-small.png"/></a>
	</div>
	
	<div id="searchBar">
		<form id="newsearch" method="get" action="../controleurRecherche/">
		        <input type="text" value="<?php if(@$Key != ''){ echo $Key;}?>" class="textinput" name="search" size="35" maxlength="120"><input id="btnLoupe" type="submit" value="" class="buttonSearch">
		        <img id="loupeSearchBar" alt="loupe" src="../../assets/images/loupe.png"/>
		</form>

	</div>

	<div id="Date">
		 <a id="gaucheDate"  href="../ControleurRespInscrEns/AnneeMoins"><img alt="" src="../../assets/images/DateGaucheHeader.png"></a>
		
		 <label id="centreDate" value="<?php echo $Date;?>"><?php echo $Date;?></label>
		 
		 <a id="droiteDate"  href="../ControleurRespInscrEns/AnneePlus"><img alt="" src="../../assets/images/DateDroiteHeader.png"></a>
	</div>
	
	<p id="deconnexion">
		<a href="../ControleurConnexion/deconnect">D&eacute;connexion</a>
	</p>
	
	
</header>

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

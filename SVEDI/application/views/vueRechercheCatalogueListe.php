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
	<a href="../ControleurRechercheCatalogue/"><img alt="svedi" src="../../assets/images/SVEDI-small.png"/></a>
</div>
<div id="searchBar">
		<form id="newsearch" method="get" action="../controleurRecherche/">
		        <input type="text" value="<?php if(@$Key != ''){ echo $Key;}?>" class="textinput" name="search" size="35" maxlength="120"><input id="btnLoupe" type="submit" value="" class="buttonSearch">
		        <img id="loupeSearchBar" alt="loupe" src="../../assets/images/loupe.png"/>
		</form>

</div>

<div id="Date">
		 <a id="gaucheDate"  href="../ControleurRechercheCatalogue/AnneeMoins"><img alt="" src="../../assets/images/DateGaucheHeader.png"></a>
		
		 <label id="centreDate" value="<?php echo $Date;?>"><?php echo $Date;?></label>
		 
		 <a id="droiteDate"  href="../ControleurRechercheCatalogue/AnneePlus"><img alt="" src="../../assets/images/DateDroiteHeader.png"></a>
</div>

<p id="deconnexion">
	<a href="../ControleurConnexion/deconnect">D&eacute;connexion</a>
</p>

</header>



<div id="content">
	<input type="hidden" id="baseUrl" value="<?php echo base_url();?>"/>
	 <h4>Liste des fili&egrave;res  <?php echo $Date ?> </h4>
	 <div>
	<?php 
		if (sizeof($Resultats) > 0){

			$i = 0;

			for($i = 0; $i < sizeof($Resultats); $i++){
	 ?>

		<p><a href="<?php echo base_url().'controleurRechercheCatalogue/?id='.$Resultats[$i]['F_ID'];?>"><?php echo $Resultats[$i]['F_Nom']?></a></p>
	<?php 
			}

		}
	?>
</div>
</div>


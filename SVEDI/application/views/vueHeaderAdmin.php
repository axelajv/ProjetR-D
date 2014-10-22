<!DOCTYPE html>
<html lang="fr">
<head>
	<title>SVEDI</title>
	<link rel=stylesheet type="text/css" href="../../assets/css/home.css"/>
	<script type="text/javascript" src="../../assets/javascript/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../../assets/javascript/search.js"></script>
	<script type="text/javascript" src="../../assets/javascript/VerifFormulaire.js"></script>
	

	<?php 
	if(@$IsStatut == true){
		echo '<script type="text/javascript" src="../../assets/javascript/adminStatut.js"></script>';
	}else{
		echo '<script type="text/javascript" src="../../assets/javascript/admin.js"></script>';
	}
	?>
</head>

<body>

<header>
	
	<div id="logo">
		<a href="../controleurAdminhome/"><img alt="svedi" src="../../assets/images/SVEDI-small.png"/></a>
	</div>
	
	<div id="Date">
		 <a id="gaucheDate"  href="../ControleurAdminHome/AnneeMoins"><img alt="" src="../../assets/images/DateGauche.png"></a>
		
		 <label id="centreDate" value="<?php echo $Date;?>"><?php echo $Date;?></label>
		 
		 <a id="droiteDate"  href="../ControleurAdminHome/AnneePlus"><img alt="" src="../../assets/images/DateDroite.png"></a>
	</div>
	
	<p id="deconnexion">
		<a href="../ControleurConnexion/deconnect">D&eacute;connexion</a>
	</p>
	
	
</header>
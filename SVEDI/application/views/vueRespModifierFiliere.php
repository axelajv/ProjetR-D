
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
		 <a id="gaucheDate"  href="../ControleurRespModifierFiliere/AnneeMoins"><img alt="" src="../../assets/images/DateGaucheHeader.png"></a>
		
		 <label id="centreDate" value="<?php echo $Date;?>"><?php echo $Date;?></label>
		 
		 <a id="droiteDate"  href="../ControleurRespModifierFiliere/AnneePlus"><img alt="" src="../../assets/images/DateDroiteHeader.png"></a>
	</div>
	
	<p id="deconnexion">
		<a href="../ControleurConnexion/deconnect">D&eacute;connexion</a>
	</p>
	
	
</header>
<div id="content">
	<h4>Modification de la filière "<?php echo $FiliereNom; ?>"</h4>
	<div id="Resp">
		<p>Nom de la filière : <input type="text" id="FNom" value="<?php echo $FiliereNom;?>"/><input type="submit" value="Changer nom" id="saveBtn"/>

		<br/>
		</p>

						<h5>Liste des matières</h5>
						<table>
							<tr>
								<th width="200px">Nom</th>
								<th width="120px">Heures de cours</th>
								<th width="120px">Heures de TD</th>
								<th width="120px">Heures de TP</th>
								<th width="80px">Semestre</th>
								<th width="50px">Modif.</th>
								<th width="50px">Suppr.</th>
							</tr>
							<?php 
								for($i=0;$i < sizeof($Matieres);$i++){
							?>
							<tr>
								<td><?php echo $Matieres[$i]['M_Nom'];?></td>
								<td><?php echo $Matieres[$i]['M_HC'];?></td>
								<td><?php echo $Matieres[$i]['M_HTD'];?></td>
								<td><?php echo $Matieres[$i]['M_HTP'];?></td>
								<td>S<?php echo $Matieres[$i]['M_Semestre'];?></td>
								<td>
									<input type ="hidden" value="<?php echo $Matieres[$i]['M_Nom'];?>" id="M<?php echo $Matieres[$i]['M_ID'];?>-Nom"/>
									<input type ="hidden" value="<?php echo $Matieres[$i]['M_HC'];?>" id="M<?php echo $Matieres[$i]['M_ID'];?>-HC"/>
									<input type ="hidden" value="<?php echo $Matieres[$i]['M_HTD'];?>" id="M<?php echo $Matieres[$i]['M_ID'];?>-HTD"/>
									<input type ="hidden" value="<?php echo $Matieres[$i]['M_HTP'];?>" id="M<?php echo $Matieres[$i]['M_ID'];?>-HTP"/>
									<input type ="hidden" value="<?php echo $Matieres[$i]['M_Semestre'];?>" id="M<?php echo $Matieres[$i]['M_ID'];?>-Semestre"/>
									<img id="MM<?php echo $Matieres[$i]['M_ID'];?>" src="../../assets/images/iconeModifier.png"/></td>
								<td><img id="MS<?php echo $Matieres[$i]['M_ID'];?>" src="../../assets/images/iconeSupprimer.png"/></td>
							</tr>
							<?php 
								}
							?>
						</table>
						<h6 id="addMatiereResp"><a href="">Ajouter une matière <img id="addMatiereRespImg" src="../../assets/images/addFiliere.png" alt="add" /></a></h6>

						<p class="log respLog" id="Log"><?php echo @$Log;?></p>
		</div>
</div>



<div id="modal">
	<div id="popUpMatiere">
		<p class="popUpTitle"><span id="Title"></span><span class="closePopUp">X</span></p>
		<p class="contentPopUp">

			<input id="popUpID" type="hidden" />
			Nom : </br><input id="popUpNom" type="text" /></br></br>
			Heures de cours : </br><input id="popUpHC"  onkeyup="this.value=this.value.replace(/[^\d]/,'')"  type="text" /></br></br>
			Heures de TD : </br><input id="popUpHTD"  onkeyup="this.value=this.value.replace(/[^\d]/,'')" type="text" /></br></br>
			Heures de TP : </br><input id="popUpHTP" onkeyup="this.value=this.value.replace(/[^\d]/,'')"  type="text" /></br></br>
			Semestre : <select id="popUpSemestre"><option value="1">S1</option><option value="2">S2</option></select>
		</p>
		<p class="log" id="msgInfo"></p>
			<p class="center"><input class="button" type="submit" value="Modifier" id="validerMM"/><input class="button" type="submit" value="Créer" id="validerMA"/></p>
	</div>
</div>
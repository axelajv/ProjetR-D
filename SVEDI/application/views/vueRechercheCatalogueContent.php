
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
		 <a id="gaucheDate"  href="../controleurRechercheCatalogue/AnneeMoins"><img alt="" src="../../assets/images/DateGaucheHeader.png"></a>
		
		 <label id="centreDate" value="<?php echo $Date;?>"><?php echo $Date;?></label>
		 
		 <a id="droiteDate"  href="../controleurRechercheCatalogue/AnneePlus"><img alt="" src="../../assets/images/DateDroiteHeader.png"></a>
	</div>
	
	<p id="deconnexion">
		<a href="../ControleurConnexion/deconnect">D&eacute;connexion</a>
	</p>
	
	
</header>

<div id="content">
	<input type="hidden" id="baseUrl" value="<?php echo base_url();?>"/>
	
	<?php 
		if (sizeof($Resultats) > 0){
echo "<h4>Liste de mati&egrave;res de la fili&egrave;re \"".$Keywords." ".$Date."\"</h4>";
echo "<div><p><a href=\"".base_url()."controleurRechercheCatalogue/\">Retour au catalogue</a><br/><br/></p></div>";

			$i = 0;

			for($i = 0; $i < sizeof($Resultats); $i++){

				if($Resultats[$i]['U_Sexe']=="M"){
					$prefixe = "Mr";
				}else{
					$prefixe = "Mme";
				}

				if($Resultats[$i]['M_SumHTP'] >= $Resultats[$i]['HTP']){
					if($Resultats[$i]['M_SumHTP'] == $Resultats[$i]['HTP']){
						$ClasseTPFull = "gras";
					}else{
						$ClasseTPFull = "full";
					}
				}else{
					$ClasseTPFull = "";
				}

				if($Resultats[$i]['M_SumHTD'] >= $Resultats[$i]['HTD']){
					if($Resultats[$i]['M_SumHTD'] == $Resultats[$i]['HTD']){
						$ClasseTDFull = "gras";
					}else{
						$ClasseTDFull = "full";
					}
				}else{
					$ClasseTDFull = "";
				}

				if($Resultats[$i]['M_SumHC'] >= $Resultats[$i]['HC']){
					if($Resultats[$i]['M_SumHC'] == $Resultats[$i]['HC']){
						$ClasseCoursFull = "gras";
					}else{
						$ClasseCoursFull = "full";
					}
				}else{
					$ClasseCoursFull = "";
				}


	 ?>
	<div class="resultSearch">
		<table>
			<tr>
				<td>Heure de TP :</td>
				<td class="<?php echo $ClasseTPFull;?>"><?php echo $Resultats[$i]['M_SumHTP']."/".$Resultats[$i]['HTP'];?></td>
				<td rowspan="3"><img class="ImgInscription" alt="inscription" src="../../assets/images/inscription.png"/></td>
			</tr>
			<tr>
				<td>Heure de TD :</td>
				<td class="<?php echo $ClasseTDFull;?>"><?php echo $Resultats[$i]['M_SumHTD']."/".$Resultats[$i]['HTD'];?></td>
			</tr>
			<tr>
				<td>Heure de cours :</td>
				<td class="<?php echo $ClasseCoursFull;?>"><?php echo $Resultats[$i]['M_SumHC']."/".$Resultats[$i]['HC'];?></td>
			</tr>
		</table>
		<h6 id="<?php echo $Resultats[$i]['M_ID'];?>"> <span class="bleu"><?php echo $Resultats[$i]['F_Nom']."</span> (".$prefixe." ".$Resultats[$i]['U_Nom'];?>
			<a href="mailto:<?php  echo $Resultats[$i]['U_Mail']; ?>"><img class="mailIcon" alt="mail" src="../../assets/images/mailIcon.png" /></a>)</h6>

			<input type="hidden" id="<?php echo $Resultats[$i]['M_ID'];?>-HC" value="<?php if($Resultats[$i]['HC']-$Resultats[$i]['M_SumHC'] > 0){ echo $Resultats[$i]['HC']-$Resultats[$i]['M_SumHC'];}else{echo "0";}?>"/>
			<input type="hidden" id="<?php echo $Resultats[$i]['M_ID'];?>-HCMAX" value="<?php echo $Resultats[$i]['HC'];?>"/>
			<input type="hidden" id="<?php echo $Resultats[$i]['M_ID'];?>-HTD" value="<?php if($Resultats[$i]['HTD']-$Resultats[$i]['M_SumHTD'] > 0){ echo $Resultats[$i]['HTD']-$Resultats[$i]['M_SumHTD'];}else{echo "0";}?>"/>
			<input type="hidden" id="<?php echo $Resultats[$i]['M_ID'];?>-HTDMAX" value="<?php echo $Resultats[$i]['HTD'];?>"/>
			<input type="hidden" id="<?php echo $Resultats[$i]['M_ID'];?>-HTP" value="<?php if($Resultats[$i]['HTP']-$Resultats[$i]['M_SumHTP'] > 0){ echo $Resultats[$i]['HTP']-$Resultats[$i]['M_SumHTP'];}else{echo "0";}?>"/>
			<input type="hidden" id="<?php echo $Resultats[$i]['M_ID'];?>-HTPMAX" value="<?php echo $Resultats[$i]['HTP'];?>"/>

		<p id="NomMatiere<?php echo $Resultats[$i]['M_ID'];?>"><?php echo $Resultats[$i]['M_Nom'];?></p>
	</div>
	<?php 
			}

		}else{
				echo "<h4>L'URL de la page a été modifiée.</h4>";
		}
	?>
</div>


<div id="modal">
<div id="popUp">
	<div id="inscriptionDiv">
	<input type="hidden" id="ID_Matiere" value="" />
<p class="popUpTitle">Inscription &agrave; <span id="popUpTitleMatiere"></span><span class="closePopUp">X</span></p>
<table>
<tr>
	<td colspan="3">Etat actuel</td>
	<td colspan="2">Demande</td>
</tr>
<tr>
	<td>Heures de TP</td>
	<td>Heures de TD</td>
	<td>Heures de cours</td>
	<td>TP : <input tabindex="1" type="text"  onkeyup="this.value=this.value.replace(/[^\d]/,'')" id="inputHTP"/></td>
	<td rowspan="3" class="submitCell"><input tabindex="4" type="submit" value="Valider" id="validerPopUp" class="button"/></td>
</tr>
<tr>
	<td>Disponibles : <span id="TP_dispo"></span>h</td>
	<td>Disponibles : <span id="TD_dispo"></span>h</td>
	<td>Disponibles : <span id="cours_dispo"></span>h</td>
	<td>TD :  <input  tabindex="2" type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" id="inputHTD"/></td>
	
</tr>
<tr>
	<td>Maximum : <span id="TP_max"></span>h</td>
	<td>Maximum : <span id="TD_max"></span>h</td>
	<td>Maximum : <span id="cours_max"></span>h</td>
	<td>Cours :  <input tabindex="3" type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" id="inputHC"/></td>
</tr>
</table>
<p id="msgConflit">Attention, votre saisie entrainera un dépassement du cotat maximal. Tout les enseignants concernés par cette matière en seront informés, ainsi que le responsable de la filière qui arbitrera le conflit.</p>
</div>
<div id="confirmationDiv">
	<p class="popUpTitle">Information<span class="closePopUp">X</span></p>
	<br/>
	<p id="msgInfo"></p>
	<p class="center"><input class="button" type="submit" value="Retour" id="retourBtn"/></p>
</div>
</div>
</div>
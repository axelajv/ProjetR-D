
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
		 <a id="gaucheDate"  href="../ControleurRespEtatGeneral/AnneeMoins"><img alt="" src="../../assets/images/DateGaucheHeader.png"></a>
		
		 <label id="centreDate" value="<?php echo $Date;?>"><?php echo $Date;?></label>
		 
		 <a id="droiteDate"  href="../ControleurRespEtatGeneral/AnneePlus"><img alt="" src="../../assets/images/DateDroiteHeader.png"></a>
	</div>
	
	<p id="deconnexion">
		<a href="../ControleurConnexion/deconnect">D&eacute;connexion</a>
	</p>
	
	
</header>
<div id="content">
		<p id="UserTypeLink"><a  href="../ControleurRespEtatGeneral/ExportExcel"> Exporter l'&eacute;tat de la fili&egrave;re<img src="../../assets/images/exportCSV.png" /></a></p>

	<h4>Etat des inscriptions par mati&egrave;res concernant la fili&egrave;re "<?php echo $FiliereNom." ".$Date; ?>"</h4>
<div id="etatFiliere">
	<?php

	$idCurrentMatiere = "-1";
	$first = true;
	$i = 0;
	$HC = 0;
	$HTP = 0;
	$HTD = 0;
	$HCcurrMAX = 0;
	$HTPcurrMAX = 0;
	$HTDcurrMAX = 0;

	$classTOTTP = "";
	$classTOTTD = "";
	$classTOTC = "";

	if (!empty($data)){
	
	
	foreach ($data as $row) {
	
		

		if ($row['MID'] <> $idCurrentMatiere){
			$idCurrentMatiere = $row['MID'] ;

			if($first){
				$first = false;
				echo "<table>";
				echo "<tr><th>Mati&egrave;re</th><th>Inscrit</th><th>TP</th><th>TD</th><th>Cours</th></tr>";
				echo "<tr class=\"trBleu\"><td><b>".$row['MNom']." (S".$row['MSemestre'].")</b></td><td></td><td class=\"MAX\">".$row['HTPMAX']."</td><td class=\"MAX\">".$row['HTDMAX']."</td><td class=\"MAX\">".$row['HCMAX']."</td></tr>";
				$HCcurrMAX = intval($row['HCMAX']);
				$HTPcurrMAX = intval($row['HTPMAX']);
				$HTDcurrMAX = intval($row['HTDMAX']);
			} else {
			
			//on definit si les case doivent etre color&eacute; en fonction du cotat d'heure max
			if ($HTP > $HTPcurrMAX) {$classTOTTP = "conflitTD";} else { if ($HTP == $HTPcurrMAX) {$classTOTTP = "fullTD";} else {$classTOTTP = "MoiteTD";} }
			if ($HTD > $HTDcurrMAX) {$classTOTTD = "conflitTD";} else { if ($HTD == $HTDcurrMAX) {$classTOTTD = "fullTD";} else {$classTOTTD = "MoiteTD";} }
			if ($HC > $HCcurrMAX) {$classTOTC = "conflitTD";} else { if ($HC == $HCcurrMAX) {$classTOTC = "fullTD";} else {$classTOTC = "MoiteTD";} }

				echo "<tr class=\"trBleu\"><td>Total</td><td></td><td class=\"heure ".$classTOTTP."\">".$HTP."</td><td class=\"heure ".$classTOTTD."\">".$HTD."</td><td class=\"heure ".$classTOTC."\">".$HC."</td></tr>";
				echo "</table></br><br/><table>";
				echo "<tr><th>Mati&egrave;re</th><th>Inscrit</th><th>TP</th><th>TD</th><th>Cours</th></tr>";
				echo "<tr class=\"trBleu\"><td><b>".$row['MNom']." (S".$row['MSemestre'].")</b></td><td></td><td class=\"MAX\">".$row['HTPMAX']."</td><td class=\"MAX\">".$row['HTDMAX']."</td><td class=\"MAX\">".$row['HCMAX']."</td></tr>";

			//on remet les compteurs à zero
			$HC = 0;
			$HTP = 0;
			$HTD = 0;
			$HCcurrMAX = intval($row['HCMAX']);
			$HTPcurrMAX = intval($row['HTPMAX']);
			$HTDcurrMAX = intval($row['HTDMAX']);
			}
		}

		if($row['UNom'] != ""){
			echo "<tr><td></td><td>".$row['UNom']." ".$row['UPrenom']."</td><td class=\"heure\">".$row['HTP']."</td><td class=\"heure\">".$row['HTD']."</td><td class=\"heure\">".$row['HC']."</td></tr>";
			$HC = $HC + intval($row['HC']);
			$HTP = $HTP + intval($row['HTP']);
			$HTD = $HTD + intval($row['HTD']);
		}
		
		$i = $i++;
		
		
	}

	//on definit si les case doivent etre color&eacute; en fonction du cotat d'heure max
			if ($HTP > $HTPcurrMAX) {$classTOTTP = "conflitTD";} else { if ($HTP == $HTPcurrMAX) {$classTOTTP = "fullTD";} else {$classTOTTP = "MoiteTD";} }
			if ($HTD > $HTDcurrMAX) {$classTOTTD = "conflitTD";} else { if ($HTD == $HTDcurrMAX) {$classTOTTD = "fullTD";} else {$classTOTTD = "MoiteTD";} }
			if ($HC > $HCcurrMAX) {$classTOTC = "conflitTD";} else { if ($HC == $HCcurrMAX) {$classTOTC = "fullTD";} else {$classTOTC = "MoiteTD";} }

		echo "<tr class=\"trBleu\"><td>Total</td><td></td><td class=\"heure ".$classTOTTP."\">".$HTP."</td><td class=\"heure ".$classTOTTD."\">".$HTD."</td><td class=\"heure ".$classTOTC."\">".$HC."</td></tr>";
		echo "</table>";
		
		
		
		} else {
		
			echo "<p>Aucun r&egrave;sultat ,aucune  mati&egrave;res n'est affect&egrave; &agrave; cette fili&egrave;re  </p>";
		
		}

	?>
</div>
<br/>
</div>

<div id="content">
		<p id="UserTypeLink"><a  href="../ControleurRespEtatGeneral/ExportExcel"> Exporter l'&eacute;tat de la fili&egrave;re<img src="../../assets/images/exportCSV.png" /></a></p>

	<h4>Etat des inscriptions par mati&egrave;res concernant la fili&egrave;re "<?php echo $FiliereNom; ?>"</h4>
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
			if ($HTP > $HTPcurrMAX) {$classTOTTP = "conflitTD";} else { if ($HTP == $HTPcurrMAX) {$classTOTTP = "fullTD";} else {$classTOTTP = "";} }
			if ($HTD > $HTDcurrMAX) {$classTOTTD = "conflitTD";} else { if ($HTD == $HTDcurrMAX) {$classTOTTD = "fullTD";} else {$classTOTTD = "";} }
			if ($HC > $HCcurrMAX) {$classTOTC = "conflitTD";} else { if ($HC == $HCcurrMAX) {$classTOTC = "fullTD";} else {$classTOTC = "";} }

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
			if ($HTP > $HTPcurrMAX) {$classTOTTP = "conflitTD";} else { if ($HTP == $HTPcurrMAX) {$classTOTTP = "fullTD";} else {$classTOTTP = "";} }
			if ($HTD > $HTDcurrMAX) {$classTOTTD = "conflitTD";} else { if ($HTD == $HTDcurrMAX) {$classTOTTD = "fullTD";} else {$classTOTTD = "";} }
			if ($HC > $HCcurrMAX) {$classTOTC = "conflitTD";} else { if ($HC == $HCcurrMAX) {$classTOTC = "fullTD";} else {$classTOTC = "";} }

		echo "<tr class=\"trBleu\"><td>Total</td><td></td><td class=\"heure ".$classTOTTP."\">".$HTP."</td><td class=\"heure ".$classTOTTD."\">".$HTD."</td><td class=\"heure ".$classTOTC."\">".$HC."</td></tr>";
		echo "</table>";

	?>
</div>
<br/>
</div>

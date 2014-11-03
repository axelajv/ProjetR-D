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
<script type="text/javascript">
		
 		function test(){
			if(document.getElementById('ajoutFiliereYes').checked){
				var valeur = document.getElementById('ajoutFiliereYes').value;
				document.getElementById('FNom').style.display = "inline"
				document.getElementById('ListeF').style.display = "none"
				} else { // si ce n'est pas l'un, c'est l'autre
				var valeur = document.getElementById('ajoutFiliereNo').value;
				document.getElementById('FNom').style.display = "none"
				document.getElementById('ListeF').style.display = "inline"
			}
			
		}
 
 		
</script>
<body>

<header>
	
	<div id="logo">
		<a href="../controleurAdminhome/"><img alt="svedi" src="../../assets/images/SVEDI-small.png"/></a>
	</div>
	
	<div id="Date">
		 <a id="gaucheDate"  href="../ControleurAdminModifierFiliere/AnneeMoins"><img alt="" src="../../assets/images/DateGauche.png"></a>
		
		 <label id="centreDate" value="<?php echo $this->session->userdata('Date');?>"><?php echo $this->session->userdata('Date');?></label>
		 
		 <a id="droiteDate"  href="../ControleurAdminModifierFiliere/AnneePlus"><img alt="" src="../../assets/images/DateDroite.png"></a>
	</div>
	
	<p id="deconnexion">
		<a href="../ControleurConnexion/deconnect">D&eacute;connexion</a>
	</p>
	
	
</header>
<div id="content" class="decal">
	<p id="retourAdminLink"><a href="../ControleurAdminHome/">Retour au panneau d'administration</a></p>
<?php 

	if ($FiliereNom != false){
		echo '<h4>Modification de la filière '.$FiliereNom.'</h4>';

	?>

<input type="hidden" id="FID" value="<?php echo @$FID;?>"/>
	<div id="Resp">
		<p>Nom de la filière : <input type="text" id="FNom" value="<?php echo $FiliereNom;?>"/><input type="submit" value="Changer nom" id="saveBtn"/></p>
		<p>Responsable : <?php echo $SelectResp;?><input type="submit" value="Changer responsable" id="saveBtnResp"/></p>

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
								for($i=0;$i < sizeof(@$Matieres);$i++){
							?>
							<tr>
								<td><?php echo $Matieres[$i]['M_Nom'];?></td>
								<td><?php echo $Matieres[$i]['M_HC'];?>h</td>
								<td><?php echo $Matieres[$i]['M_HTD'];?>h</td>
								<td><?php echo $Matieres[$i]['M_HTP'];?>h</td>
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


	<?php
	}else{
		echo '<h4>Création d\'une filière</h4>';
		?>
		
		
		

		<div id="Resp">
			<p>Voulez vous ajouter une nouvelle filière ? 
			<INPUT type="radio" id="ajoutFiliereYes" name="ajoutFiliere" value="oui" onchange="test();"><label>Oui</label>
			<INPUT type="radio" id="ajoutFiliereNo" name="ajoutFiliere" value="non" onchange="test();" checked><label>Non</label>
			</p>			
			<p>Nom de la filière : <input type="text" id="FNom" value="<?php echo $FiliereNom;?>"/><span id="ListeF"><?php echo $SelectResp;?></span></p>
			<p>Responsable : <?php echo $SelectResp;?></p>
			
			<p><input type="submit" value="Créer" id="newF"/></p>
			</div>
	</div>

		<?php
	}

?>



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
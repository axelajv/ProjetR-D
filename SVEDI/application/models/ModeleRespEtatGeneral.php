<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ModeleRespEtatGeneral extends CI_Model
{

	public function __construct()
	{
		//	Obligatoire
		parent::__construct();
		
		//	Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->database();
	
	}
	

	public function GetFiliereNom($id){

		 $i=0;
	   
		$sql =	   "SELECT Nom FROM Filiere where ID_Utilisateur = ".$id ;
			 
		$query = $this->db->query($sql);	
	
		$ligne = $query->result_array();

		return $ligne[0]['Nom'];

	}

	public function GetFiliereID($id){

		 $i=0;
	   
		$sql =	   "SELECT ID FROM Filiere where ID_Utilisateur = ".$id ;
			 
		$query = $this->db->query($sql);	
	
		$ligne = $query->result_array();

		return $ligne[0]['ID'];

	}

	public function GetAllInfos($id){
		$sql = "SELECT m.Nom as MNom,
					   m.semestre as MSemestre,
					   m.id as MID,
					   u.Nom as UNom, 
					   u.Prenom as UPrenom, 
					   i.NbHeuresTP as HTP, 
					   i.NbHeuresTD as HTD, 
					   i.NbHeuresCours as HC, 
					   m.maxheuresTP as HTPMAX, 
					   m.maxheuresTD as HTDMAX,
					   m.maxHeuresCours as HCMAX
				from matiere m 
				left outer join inscription i on i.ID_matiere = m.id 
				left outer join utilisateur u on i.ID_Utilisateur = u.ID 
				where ID_filiere = ".$id."
				order by m.semestre, m.nom";

		$query = $this->db->query($sql);	
	
		return $query->result_array();
	}	


	public function genCSV($IDFiliere){

	
	 $q = " SELECT DISTINCT m.nom As NomMatiere, u.nom as NomUtilisateur,u.prenom as PrenomUtilisateur, i.NbHeuresCours,i.NbHeuresTD, i.NbHeuresTP, f.Nom as NomFiliere,u.Type as Type, m.Semestre as Semestre		FROM filiere as f, matiere as m, inscription as i, utilisateur as u,typeutilisateur as t
				WHERE f.ID =".$IDFiliere." AND f.ID = m.ID_filiere AND m.ID = i.ID_matiere AND u.ID = i.ID_utilisateur
				AND u.ID = i.ID_utilisateur AND m.ID = i.ID_matiere";
			

	$q = $this->db->query($q);
	 
	//load new PHPExcel library
	$this->load->library('excel');

	$this->excel->setActiveSheetIndex(0);

	$this->excel->getProperties()->setTitle("Etat Filiere");

	$NomFiliere = " ";
        
		$this->excel->getActiveSheet()->setCellValue("A1","Filiere");
		$this->excel->getActiveSheet()->setCellValue("A2", "intitule de l'enseignement");
		$this->excel->getActiveSheet()->setCellValue("B2", "Discipline");
		$this->excel->getActiveSheet()->setCellValue("C2", "CM");
		$this->excel->getActiveSheet()->setCellValue("D2", "TD");
		$this->excel->getActiveSheet()->setCellValue("E2", "TP");
		$this->excel->getActiveSheet()->setCellValue("F2", "Heure Equivalent TD");
		$this->excel->getActiveSheet()->setCellValue("G2", "cout Filiere");
		$this->excel->getActiveSheet()->setCellValue("H2", "Nom de l'enseignant");
		$this->excel->getActiveSheet()->setCellValue("I2", "Prenom");
		$this->excel->getActiveSheet()->setCellValue("J2", "Statut");
		$this->excel->getActiveSheet()->setCellValue("K2", "1er semestre");
		$this->excel->getActiveSheet()->setCellValue("L2", "2nd semestre");
		
		$r = 3;

$sumS1 = 0;
$sumS2 = 0;

foreach ($q->result() as $row) {
    $this->excel->getActiveSheet()->setCellValue('A'.$r, $row->NomMatiere)
								  ->setCellValue('B'.$r, "informatique")
								  ->setCellValue('C'.$r, $row->NbHeuresCours)
								  ->setCellValue('D'.$r, $row->NbHeuresTD)
								  ->setCellValue('E'.$r, $row->NbHeuresTP)
								  ->setCellValue('F'.$r, number_format(($row->NbHeuresCours)*1.5+$row->NbHeuresTD+($row->NbHeuresTP)/3*2,1))
								  ->setCellValue('G'.$r, number_format(($row->NbHeuresCours)*1.5+$row->NbHeuresTD+($row->NbHeuresTP)/3*2,1))
                                  ->setCellValue('H'.$r, $row->NomUtilisateur)
                                  ->setCellValue('I'.$r, $row->PrenomUtilisateur)
								  ->setCellValue('J'.$r, $row->Type);
								  
	if($row->Semestre == '1')
	{
    $this->excel->getActiveSheet()->setCellValue('K'.$r, number_format(($row->NbHeuresCours)*1.5+$row->NbHeuresTD+($row->NbHeuresTP)/3*2,1));
	$sumS1 = $sumS1 +($row->NbHeuresCours)*1.5+$row->NbHeuresTD+($row->NbHeuresTP)/3*2;
	}
	else
	{
		$this->excel->getActiveSheet()->setCellValue('L'.$r, number_format(($row->NbHeuresCours)*1.5+$row->NbHeuresTD+($row->NbHeuresTP)/3*2,1));
		$sumS2 =  $sumS2+($row->NbHeuresCours)*1.5+$row->NbHeuresTD+($row->NbHeuresTP)/3*2;
	}
		$NomFiliere=$row->NomFiliere;
		$r++;
	}
		$this->excel->getActiveSheet()->setCellValue("B1",$NomFiliere);
		$this->excel->getActiveSheet()->setCellValue('F'.$r,number_format($sumS1+$sumS2,1));
		$this->excel->getActiveSheet()->setCellValue('G'.$r,number_format($sumS1+$sumS2,1));
		$this->excel->getActiveSheet()->setCellValue('K'.$r,number_format($sumS1,1));
		$this->excel->getActiveSheet()->setCellValue('L'.$r,number_format($sumS2,1));
		
		$this->excel->setActiveSheetIndex(0);
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'CSV');
		$objWriter->setDelimiter(';');
       
        return $objWriter;
	}
}?>
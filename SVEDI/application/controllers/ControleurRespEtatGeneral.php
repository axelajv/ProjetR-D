<?php
class ControleurRespEtatGeneral extends CI_Controller
{

	public function index()
	{
		
		$this->load->model('ModeleConnexion');
	    if($this->ModeleConnexion->isLoggedIn()){
			$Date=$this->session->userdata('Date');
			$this->accueil($Date);
		}else{
			$this->load->view('VueConnexion/vueHeader');
  			$this->load->view('VueConnexion/vueConnexionInactive');
			$this->load->view('VueConnexion/vueFooter');
		}	}

	public function accueil($Date)
	{
		$data = array();
		
	
		$Id=$this->session->userdata('Id_user');

		$this->load->model('ModeleRespEtatGeneral');
		$data['FiliereNom']=$this->ModeleRespEtatGeneral->GetFiliereNom($Id);
		$data['Date']=$Date;
		$data['resp'] = "Y";

		$this->load->view('vueHeader',$data);
		
		$data['Notification']=$this->RemplirInfoNotification($Id,$Date);
		$this->load->view('vueNav',$data);

		$data['data'] = $this->GetAllInfos($this->ModeleRespEtatGeneral->GetFiliereNom($Id),$Date);
		
		$this->load->view('vueRespEtatGeneral',$data);
		
		$this->load->view('vueFooter');
	
	}
	
	
	public function AnneeMoins(){
		
		$DateActuelle=$this->session->userdata('Date');
		$Date= $DateActuelle - 1 ;
		$this->session->set_userdata("Date", $Date);
		$this->accueil($Date);
		
	}
	
	
	public function AnneePlus(){
		
		$DateActuelle=$this->session->userdata('Date');
		$Date= $DateActuelle + 1 ;
		$this->session->set_userdata("Date", $Date);
		$this->accueil($Date);
	}
	
	
	
	
	public function RemplirInfoNotification($Id,$Date){	
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id,$Date);
				
		return ($Info);
	}

	public function GetAllInfos($Nom,$Date){
		$this->load->model('ModeleRespEtatGeneral');
		$Info=$this->ModeleRespEtatGeneral->GetAllInfos($Nom,$Date);

		return ($Info);
	}

	
	public function ExportExcel()
	{
	
	$Id=$this->session->userdata('Id_user');

	$this->load->model('ModeleRespEtatGeneral');
	
	$Date=$this->session->userdata('Date');
	$Nom=$this->ModeleRespEtatGeneral->GetFiliereNom($Id);
	
	
	
	$IDFiliere = $this->ModeleRespEtatGeneral->GetFiliereID($Id);
	
	 $q = " SELECT DISTINCT m.nom As NomMatiere, u.nom as NomUtilisateur,u.prenom as PrenomUtilisateur, i.NbHeuresCours,i.NbHeuresTD, i.NbHeuresTP, f.Nom as NomFiliere,u.Type as Type, m.Semestre as Semestre	
			FROM filiere as f, matiere as m, inscription as i, utilisateur as u,typeutilisateur as t
			WHERE f.Nom ='".$Nom."' AND f.DateFiliere =".$Date."  AND f.ID = m.ID_filiere AND m.ID = i.ID_matiere AND u.ID = i.ID_utilisateur
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
	Else
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
       
        header("Content-type: text/csv");
        header('Content-Disposition: attachment;filename="Etat Filiere_'.$NomFiliere."_".date('dMy').'.csv"');
        header('Cache-Control: max-age=0');
 
        $objWriter->save('php://output');           

    }

}
?>
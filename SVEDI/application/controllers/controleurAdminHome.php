<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controleurAdminHome extends CI_Controller
{

	public function loadView()
	{
		$dataHead['Key'] = $this->input->get('search');
		$dataHead['Date'] = $this->getDate();
		$data['Id_user']=$this->session->userdata('Id_user');
		$data['Users']= $this->getListUser();
		$data['Filieres']=$this->getListFiliere();
		$data['Roles'] = $this->getListRoles();
		$data['Types'] = $this->getListTypes();
		$data['IsStatut'] = false;

		$this->load->view('vueHeaderAdmin',$dataHead);
		$this->load->view('vueAdminHome',$data);
		$this->load->view('vueFooter');
		
	}


	public function index()
	{	
		
		$this->load->model('ModeleConnexion');
	    if($this->ModeleConnexion->isLoggedIn()){
			$this->loadView();
		}else{
			$this->load->view('VueConnexion/vueHeader');
  			$this->load->view('VueConnexion/vueConnexionInactive');
			$this->load->view('VueConnexion/vueFooter');
		}	
	}

	public function log(){
		$dataHead['Key'] = $this->input->get('search');
		$data['Id_user']=$this->session->userdata('Id_user');
		$data['Users']= $this->getListUser();
		$data['Filieres']=$this->getListFiliere();
		$data['Roles'] = $this->getListRoles();
		$data['Types'] = $this->getListTypes();
				$data['IsStatut'] = false;


		if($this->input->get('UM')){
			$data['Log'] = "Modification effectuée";
		}
		if($this->input->get('UA')){
			$data['Log'] = "Compte utilisateur crée";
		}

		$this->load->view('vueHeaderAdmin',$dataHead);
		$this->load->view('vueAdminHome',$data);
		$this->load->view('vueFooter');
	}
	

	public function AnneePlus(){
		
		$DateActuelle= $this->input->get('id');
	
		$dataHead['Key'] = $this->input->get('search');
		$dataHead['Date'] = $DateActuelle + 1 ;
		$this->load->view('vueHeaderAdmin',$dataHead);
		
	}
	
	public function getDate(){
		
		return  date("Y");
	}

	public function getListUser(){
		$this->load->model('ModeleAdminHome');
		$Info=$this->ModeleAdminHome->getListUser();
		return $Info;
	}

	public function getListFiliere(){
		$this->load->model('ModeleAdminHome');
		$Info=$this->ModeleAdminHome->getListFiliere();
		return $Info;
	}

	public function getListRoles(){
		$this->load->model('ModeleAdminHome');
		$Info=$this->ModeleAdminHome->getRoles();

		$str ='<select id="popUpRole">';
		foreach ($Info as $role) {
			$str = $str.'<option value="'.$role['ID'].'" >'.$role['Nom'].'</option>';
		}
		$str = $str ."</select>";

		return $str;
	}


	public function getListTypes(){
		$this->load->model('ModeleAdminHome');
		$Info=$this->ModeleAdminHome->getTypes();

		$str ='<select id="popUpType">';
		foreach ($Info as $type) {
			$str = $str.'<option value="'.$type['code'].'" >'.$type['libelle'].'</option>';
		}
		$str = $str ."</select>";

		return $str;
	}



	public function UM()
	{
		$this->load->model('ModeleAdminHome');
		$Info=$this->ModeleAdminHome->UtilisateurModification($this->input->get('id'),$this->input->get('Prenom'),$this->input->get('Nom'),$this->input->get('Mail'),$this->input->get('Sexe'),$this->input->get('Tel'),$this->input->get('Login'),$this->input->get('Mdp'),$this->input->get('Role'),$this->input->get('Type'));

	 return null;
	}

	public function US()
	{
		$this->load->model('ModeleAdminHome');
		$Info=$this->ModeleAdminHome->UtilisateurSuppression($this->input->get('id'));
		echo $Info;
	}

	public function UA()
	{
		$this->load->model('ModeleAdminHome');
		$Info=$this->ModeleAdminHome->UtilisateurAdd($this->input->get('Prenom'),$this->input->get('Nom'),$this->input->get('Mail'),$this->input->get('Sexe'),$this->input->get('Tel'),$this->input->get('Login'),$this->input->get('Mdp'),$this->input->get('Role'),$this->input->get('Type'));

		return null;
	}

	public function FS()
	{
		$this->load->model('ModeleAdminHome');
		$Info=$this->ModeleAdminHome->FiliereSuppression($this->input->get('id'));
		echo $Info;

	}

	public function FM()
	{
		return null;
	}


	public function FE()
	{
		
	$q = " SELECT DISTINCT m.nom As NomMatiere, u.nom as NomUtilisateur,u.prenom as PrenomUtilisateur, i.NbHeuresCours,i.NbHeuresTD, i.NbHeuresTP, f.Nom as NomFiliere,u.Type as Type, m.Semestre as Semestre		FROM filiere as f, matiere as m, inscription as i, utilisateur as u,typeutilisateur as t
				WHERE f.ID =".intval($this->input->get('id'))." AND f.ID = m.ID_filiere AND m.ID = i.ID_matiere AND u.ID = i.ID_utilisateur
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
	



	


};
?>
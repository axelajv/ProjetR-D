<?php  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

class ControleurRespModifierFiliere extends CI_Controller
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
		}
	}

	public function accueil($Date)
	{
		$data = array();

		$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleRespModifierFiliere');
		$data['Date'] =$Date;
		$data['FiliereNom']=$this->ModeleRespModifierFiliere->GetFiliereNom($Id);
		$data['resp'] = "Y";

		//$this->load->view('vueHeader',$data);

		$data['Notification']=$this->RemplirInfoNotification($Id ,$Date);
		$this->load->view('vueNav',$data);
		
		$data['Matieres'] = $this->getListM($Date,$this->ModeleRespModifierFiliere->GetFiliereNom($Id));
		//$data['SelectResp'] = $this->getListR();
		$this->load->view('vueRespModifierFiliere',$data);
		
		$this->load->view('vueFooter');
	
	}
	
	public function AnneeMoins(){
		
		$DateActuelle=$this->session->userdata('Date');
		
		if($DateActuelle > Date("Y")){
			$Date= $DateActuelle - 1 ;
			$this->session->set_userdata("Date", $Date);
			$this->accueil($Date);
		} else {
			
			$this->accueil($DateActuelle);
		
		}
		
	}
	
	
	public function AnneePlus(){
		
		$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleRespInscrEns');
		$this->load->model('ModeleHome');
		$NomF=$this->ModeleRespInscrEns->GetFiliereNom($Id);
		
		$AMax=$this->ModeleHome->AnneeMax($NomF);
	
		
		$DateActuelle=$this->session->userdata('Date');
		$Date= $DateActuelle;
		
		if($AMax>=$DateActuelle + 1 ){
		
			$Date= $DateActuelle + 1 ;
			$this->session->set_userdata("Date", $Date);
		
		}
		
		$this->accueil($Date);
	}
	

	public function log()
	{
	
		$data = array();
		
		$Date=$this->session->userdata('Date');
		$data['Date'] =$Date;
		$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleRespModifierFiliere');

		$data['FiliereNom']=$this->ModeleRespModifierFiliere->GetFiliereNom($Id);
		$data['resp'] = "Y";



		$data['Notification']=$this->RemplirInfoNotification($Id ,$Date);
		$this->load->view('vueNav',$data);
		
		if($this->input->get('MM')){
			$data['Log'] = "Modification effectuée";
		}
		if($this->input->get('MA')){
			$data['Log'] = "Matière créée";
		}

		$data['Matieres'] = $this->getListM($Date,$this->ModeleRespModifierFiliere->GetFiliereNom($Id));
		//$data['SelectResp'] = $this->getListR();
		$this->load->view('vueRespModifierFiliere',$data);
		
		$this->load->view('vueFooter');
	
	}



	public function RemplirInfoNotification($Id ,$Date)
	{	

		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id ,$Date);
		return ($Info);
		
	}	

	public function getListM($Date,$Nom)
	{	

		$this->load->model('ModeleRespModifierFiliere');
		$Info=$this->ModeleRespModifierFiliere->getListMatiere($Date,$Nom);
			
		
		return ($Info);
	}	

	public function getIdF($Date,$Nom){
		$this->load->model('ModeleRespModifierFiliere');
		$Info=$this->ModeleRespModifierFiliere->GetFiliereID($Date,$Nom);		
		return ($Info);
	}

	public function getListR(){
		$this->load->model('ModeleRespModifierFiliere');

	//	$ListUser = $this->ModeleRespModifierFiliere->GetListResp();	

		$select ='<select id="selectResp">';
		$select = $select .'<option  disabled selected></option>';
		foreach ($ListUser as $u) {
			$select = $select.'<option value="'.$u['ID'].'" > '.$u['Nom'].'</option>';
		}
		$select = $select ."</select>";

		return $select;
	}

	public function modifierM(){
		$this->load->model('ModeleRespModifierFiliere');
		$this->ModeleRespModifierFiliere->MM($this->input->get('id'),$this->input->get('nom'),$this->input->get('HC'),$this->input->get('HTD'),$this->input->get('HTP'),$this->input->get('semestre'));	
	

		$this->load->model('ModeleMajConflit');
		$this->ModeleMajConflit->maj($this->input->get('id'));
	}

	public function ajouterM(){
		$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleRespModifierFiliere');
		
		$Date=$this->session->userdata('Date');
		$Nom=$this->ModeleRespModifierFiliere->GetFiliereNom($Id);
		$idF = $this->getIdF($Date,$Nom);
		 echo $idF;
		$this->ModeleRespModifierFiliere->MA($this->input->get('nom'),$this->input->get('HC'),$this->input->get('HTD'),$this->input->get('HTP'),$this->input->get('semestre'),$idF);	

	}

	public function supprM(){
		$this->load->model('ModeleRespModifierFiliere');
		$Info=$this->ModeleRespModifierFiliere->supprM($this->input->get('id'));
	}


}
?>
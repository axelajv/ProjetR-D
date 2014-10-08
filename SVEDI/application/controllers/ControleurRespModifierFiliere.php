<?php  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

class ControleurRespModifierFiliere extends CI_Controller
{

	public function index()
	{

		$this->load->model('ModeleConnexion');
	    if($this->ModeleConnexion->isLoggedIn()){
	    	$this->accueil();
		}else{
			$this->load->view('VueConnexion/vueHeader');
  			$this->load->view('VueConnexion/vueConnexionInactive');
			$this->load->view('VueConnexion/vueFooter');
		}
	}

	public function accueil()
	{
		$data = array();
		
	
		$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleRespModifierFiliere');

		$data['FiliereNom']=$this->ModeleRespModifierFiliere->GetFiliereNom($Id);
		$data['resp'] = "Y";

		$this->load->view('vueHeader',$data);

		$data['Notification']=$this->RemplirInfoNotification($Id);
		$this->load->view('vueNav',$data);
		
		$data['Matieres'] = $this->getListM($this->getIdF($Id));
		$data['SelectResp'] = $this->getListR();
		$this->load->view('vueRespModifierFiliere',$data);
		
		$this->load->view('vueFooter');
	
	}
	


	public function log()
	{
		$data = array();
		
	
		$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleRespModifierFiliere');

		$data['FiliereNom']=$this->ModeleRespModifierFiliere->GetFiliereNom($Id);
		$data['resp'] = "Y";

		$this->load->view('vueHeader',$data);

		$data['Notification']=$this->RemplirInfoNotification($Id);
		$this->load->view('vueNav',$data);
		
		if($this->input->get('MM')){
			$data['Log'] = "Modification effectuée";
		}
		if($this->input->get('MA')){
			$data['Log'] = "Matière créée";
		}

		$data['Matieres'] = $this->getListM($this->getIdF($Id));
		$data['SelectResp'] = $this->getListR();
		$this->load->view('vueRespModifierFiliere',$data);
		
		$this->load->view('vueFooter');
	
	}



	public function RemplirInfoNotification($Id)
	{	

		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id);
			
		
		return ($Info);
	}	

	public function getListM($Id)
	{	

		$this->load->model('ModeleRespModifierFiliere');
		$Info=$this->ModeleRespModifierFiliere->getListMatiere($Id);
			
		
		return ($Info);
	}	

	public function getIdF($id){
		$this->load->model('ModeleRespModifierFiliere');
		$Info=$this->ModeleRespModifierFiliere->GetFiliereID($id);		
		return ($Info);
	}

	public function getListR(){
		$this->load->model('ModeleRespModifierFiliere');

		$ListUser = $this->ModeleRespModifierFiliere->GetListResp();	

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
		$idF = $this->getIdF($Id);

		$this->load->model('ModeleRespModifierFiliere');
		$this->ModeleRespModifierFiliere->MA($this->input->get('nom'),$this->input->get('HC'),$this->input->get('HTD'),$this->input->get('HTP'),$this->input->get('semestre'),$idF);	
	}

	public function supprM(){
		$this->load->model('ModeleRespModifierFiliere');
		$Info=$this->ModeleRespModifierFiliere->supprM($this->input->get('id'));
	}


}
?>
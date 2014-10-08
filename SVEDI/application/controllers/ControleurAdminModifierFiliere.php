<?php
class ControleurAdminModifierFiliere extends CI_Controller
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
		$this->load->model('ModeleAdminModifierFiliere');

		
		$id=$this->input->get('id');

		$this->load->view('vueHeaderAdmin',$data);

		if($this->input->get('id')){
			if($id == "new"){
				$data['FID'] = $this->ModeleAdminModifierFiliere->GetNewFiliere();
				$id = $data['FID'];
				$data['Matieres'] = $this->getListM($id);
				$data['SelectResp'] = $this->getListRselect($this->GetFiliereResp($id));
				$data['FiliereNom']=$this->ModeleAdminModifierFiliere->GetFiliereNom($id);
			}else{
				$data['FID']=$id;
				$data['Matieres'] = $this->getListM($id);
				$data['SelectResp'] = $this->getListRselect($this->GetFiliereResp($id));
				$data['FiliereNom']=$this->ModeleAdminModifierFiliere->GetFiliereNom($id);
			}
			

		}else{
			$data['SelectResp'] = $this->getListR();
			$data['FiliereNom']=false;

		}

		
		$this->load->view('vueAdminModifierFiliere',$data);
		$this->load->view('vueFooter');
	
	}
	


	public function log()
	{

		if($this->input->get('MM')){
			$data['Log'] = "Modification effectuée";
		}
		if($this->input->get('MA')){
			$data['Log'] = "Matière créée";
		}

		$data = array();
		$this->load->model('ModeleAdminModifierFiliere');

		
		$id=$this->input->get('id');

		$this->load->view('vueHeaderAdmin',$data);

		if($this->input->get('id')){
			if($id == "new"){
				$data['FID'] = $this->ModeleAdminModifierFiliere->GetNewFiliere();
				$id = $data['FID'];
				$data['Matieres'] = $this->getListM($id);
				$data['SelectResp'] = $this->getListRselect($this->GetFiliereResp($id));
				$data['FiliereNom']=$this->ModeleAdminModifierFiliere->GetFiliereNom($id);
			}else{
				$data['FID']=$id;
				$data['Matieres'] = $this->getListM($id);
				$data['SelectResp'] = $this->getListRselect($this->GetFiliereResp($id));
				$data['FiliereNom']=$this->ModeleAdminModifierFiliere->GetFiliereNom($id);
			}
			

		}else{
			$data['SelectResp'] = $this->getListR();
			$data['FiliereNom']=false;

		}

		
		$this->load->view('vueAdminModifierFiliere',$data);
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

	public function GetFiliereResp($id){
		$this->load->model('ModeleRespModifierFiliere');
		$Info=$this->ModeleRespModifierFiliere->GetFiliereResp($id);		
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

	public function getListRselect($id){
		$this->load->model('ModeleRespModifierFiliere');

		$ListUser = $this->ModeleRespModifierFiliere->GetListResp();	

		$select ='<select id="selectResp">';

		foreach ($ListUser as $u) {
			if($u['ID'] == $id){
				$selected = "selected";
			}else{
				$selected = "";
			}

			$select = $select.'<option '.$selected.' value="'.$u['ID'].'" > '.$u['Nom'].'</option>';
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

		$this->load->model('ModeleRespModifierFiliere');
		$this->ModeleRespModifierFiliere->MA($this->input->get('nom'),$this->input->get('HC'),$this->input->get('HTD'),$this->input->get('HTP'),$this->input->get('semestre'),$this->input->get('id'));	
	}

	public function supprM(){
		$this->load->model('ModeleRespModifierFiliere');
		$Info=$this->ModeleRespModifierFiliere->supprM($this->input->get('id'));
	}

	public function creerF(){
		$this->load->model('ModeleAdminModifierFiliere');
		$Info=$this->ModeleAdminModifierFiliere->creerF($this->input->get('nom'),$this->input->get('rid'));
	} 


}
?>
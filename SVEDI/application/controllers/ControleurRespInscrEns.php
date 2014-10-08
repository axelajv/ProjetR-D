<?php
class ControleurRespInscrEns extends CI_Controller
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
		}	}

	public function accueil()
	{
		$data = array();
		
	
		$Id=$this->session->userdata('Id_user');
		
		$this->load->model('ModeleRespInscrEns');
		$data['FiliereNom']=$this->ModeleRespInscrEns->GetFiliereNom($Id);

		$data['resp'] = "Y";

		$this->load->view('vueHeader',$data);

		$data['Notification']=$this->RemplirInfoNotification($Id);
		$this->load->view('vueNav',$data);
		
		$data['listM'] = $this->getListM($this->getIdF($Id));
		$data['listE'] = $this->getListE();
		$this->load->view('vueRespInscrEns',$data);
		
		$this->load->view('vueFooter');
	
	}
	
	public function RemplirInfoNotification($Id)
	{	

		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id);
			
		
		return ($Info);
	}

	public function getListM($id){
		$this->load->model('ModeleRespInscrEns');
		$Info=$this->ModeleRespInscrEns->GetListMatieres($id);		

		$str ='<select id="selectMatiere">';
		$str = $str .'<option disabled selected></option>';
		foreach ($Info as $m) {
			$str = $str.'<option value="'.$m['id'].'" >'.$m['Nom'].'</option>';
		}
		$str = $str ."</select>";
		return $str;
	}

	public function getListE(){
		$this->load->model('ModeleRespInscrEns');

		$ListUser = $this->ModeleRespInscrEns->GetListEnseignants();	

		$select ='<p><select size=10 class="selectRespInscr" id="selectEnseignants">';
		$select = $select .'<option disabled value="-1">Liste scrollable</option>';
		foreach ($ListUser as $u) {
			$select = $select.'<option value="'.$u['ID'].'" > '.$u['Nom'].'</option>';
		}
		$select = $select ."</select></p>";

		return $select;
	}

	public function getIdF($id){
		$this->load->model('ModeleRespInscrEns');
		$Info=$this->ModeleRespInscrEns->GetFiliereID($id);		
		return ($Info);
	}

	public function inscr(){
		$this->load->model('ModeleRespInscrEns');
		$Info=$this->ModeleRespInscrEns->Inscrire($this->input->get('Eid'),$this->input->get('Mid'),$this->input->get('HC'),$this->input->get('HTD'),$this->input->get('HTP'));

		$this->load->model('ModeleMajConflit');
		$this->ModeleMajConflit->Maj($this->input->get('Mid'));

		return ($Info);
	}


}
?>
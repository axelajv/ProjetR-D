<?php
class ControleurRespInscrEns extends CI_Controller
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
		
		$this->load->model('ModeleRespInscrEns');
		$data['FiliereNom']=$this->ModeleRespInscrEns->GetFiliereNom($Id);

		$data['resp'] = "Y";
		$data['Date'] =$Date;
	
		//	$this->load->view('vueHeader',$data);

		$data['Notification']=$this->RemplirInfoNotification($Id ,$Date);
		$this->load->view('vueNav',$data);
		
		$data['listM'] = $this->getListM($Date,$this->ModeleRespInscrEns->GetFiliereNom($Id));
		$data['listE'] = $this->getListE($Date);
		$this->load->view('vueRespInscrEns',$data);
		
		
	
		
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

	public function RemplirInfoNotification($Id ,$Date)
	{	

		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id ,$Date);
		return ($Info);
		
	}	

	public function getListM($Date,$Nom){
		$this->load->model('ModeleRespInscrEns');
		$Info=$this->ModeleRespInscrEns->GetListMatieres($Date,$Nom);		

		$str ='<select id="selectMatiere">';
		$str = $str .'<option disabled selected></option>';
		foreach ($Info as $m) {
			$str = $str.'<option value="'.$m['id'].'" >'.$m['Nom'].'</option>';
		}
		$str = $str ."</select>";
		return $str;
	}

	public function getListE($Date){
		$this->load->model('ModeleRespInscrEns');

		$ListUser = $this->ModeleRespInscrEns->GetListEnseignants($Date);	

		$select ='<p><select size=10 class="selectRespInscr" id="selectEnseignants">';
		$select = $select .'<option disabled value="-1">Liste scrollable</option>';
		foreach ($ListUser as $u) {
			$select = $select.'<option value="'.$u['ID'].'" > '.$u['Nom'].'</option>';
		}
		$select = $select ."</select></p>";

		return $select;
	}

	public function getIdF($Date,$Nom){
		$this->load->model('ModeleRespInscrEns');
		$Info=$this->ModeleRespInscrEns->GetFiliereID($Date,$Nom);		
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
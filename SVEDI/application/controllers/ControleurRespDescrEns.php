<?php
class ControleurRespDescrEns extends CI_Controller
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
		
		$this->load->model('ModeleRespDescrEns');
		$data['FiliereNom']=$this->ModeleRespDescrEns->GetFiliereNom($Id);
		$data['Visible'] = 'Invisible';
		$data['resp'] = "Y";
		$data['Date'] =$Date;
	

		//$this->load->view('vueHeader',$data);

		$data['Notification']=$this->RemplirInfoNotification($Id ,$Date);
		$this->load->view('vueNav',$data);
		
	
		$data['listE'] = $this->getListE($Date);
		$this->load->view('vueRespDescrEns',$data);
		
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
	
		
	public function Tableau()
	{
		$data = array();
		
		$Id=$this->input->get('id');
		
		$data['Visible'] = 'Visible';
		$Date=$this->session->userdata('Date');
		
		$data['Date'] =$Date;
		$IdRF=$this->session->userdata('Id_user');
		
		$this->load->model('ModeleRespDescrEns');
		$data['FiliereNom']=$this->ModeleRespDescrEns->GetFiliereNom($IdRF);

		$data['resp'] = "Y";

		

		$data['Notification']=$this->RemplirInfoNotification($Id,$Date);
		$this->load->view('vueNav',$data);
		
		$data['Inscription']=$this->RemplirInfoInscription($Id,$Date);
		$data['Conflit']=$this->RemplirConflit($Id,$Date);
		
		$data['listE'] = $this->getListE($Date);
		$this->load->view('vueRespDescrEns',$data);
		
		$this->load->view('vueFooter');
	
	
	}
	
	
	public function RemplirInfoNotification($Id,$Date)
	{	
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id,$Date);
		return ($Info);
	}



	public function getListE($Date){
		$this->load->model('ModeleRespDescrEns');

		$ListUser = $this->ModeleRespDescrEns->GetListEnseignants($Date);	

		$select ='<p><select size=10 class="selectRespInscr" id="selectEnseignantsD">';
		$select = $select .'<option disabled value="-1">Liste scrollable</option>';
		foreach ($ListUser as $u) {
			$select = $select.'<option value="'.$u['ID'].'" > '.$u['Nom'].'</option>';
		}
		$select = $select ."</select></p>";

		return $select;
	}

	public function getIdF($id){
		$this->load->model('ModeleRespDescrEns');
		$Info=$this->ModeleRespDescrEns->GetFiliereID($id);		
		return ($Info);
	}

	
	public function RemplirInfoInscription($Id,$Date)
	{	
	//	$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Inscription($Id,$Date);
		return ($Info);
	
	}
	
	public function RemplirConflit($Id,$Date)
	{	
			
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Conflit($Id,$Date);
		return ($Info);
	}

}
?>
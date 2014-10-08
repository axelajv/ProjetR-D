<?php
class ControleurRespDescrEns extends CI_Controller
{

	public function index()
	{
		$this->accueil();
	}

	public function accueil()
	{
		$data = array();
		
	
		$Id=$this->session->userdata('Id_user');
		
		$this->load->model('ModeleRespDescrEns');
		$data['FiliereNom']=$this->ModeleRespDescrEns->GetFiliereNom($Id);
		$data['Visible'] = 'Invisible';
		$data['resp'] = "Y";

		$this->load->view('vueHeader',$data);

		$data['Notification']=$this->RemplirInfoNotification($Id);
		$this->load->view('vueNav',$data);
		
	
		$data['listE'] = $this->getListE();
		$this->load->view('vueRespDescrEns',$data);
		
		$this->load->view('vueFooter');
	
	}
	
	
	
		
	public function Tableau()
	{
		$data = array();
		
		$Id=$this->input->get('id');
		
		$data['Visible'] = 'Visible';
		
		$IdRF=$this->session->userdata('Id_user');
		
		$this->load->model('ModeleRespDescrEns');
		$data['FiliereNom']=$this->ModeleRespDescrEns->GetFiliereNom($IdRF);

		$data['resp'] = "Y";

		$this->load->view('vueHeader',$data);

		$data['Notification']=$this->RemplirInfoNotification($IdRF);
		$this->load->view('vueNav',$data);
		
		$data['Inscription']=$this->RemplirInfoInscription($Id);
		$data['Conflit']=$this->RemplirConflit($Id);
		
		$data['listE'] = $this->getListE();
		$this->load->view('vueRespDescrEns',$data);
		
		$this->load->view('vueFooter');
	
	
	}
	
	
	public function RemplirInfoNotification($Id)
	{	

		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id);
			
		
		return ($Info);
	}



	public function getListE(){
		$this->load->model('ModeleRespDescrEns');

		$ListUser = $this->ModeleRespDescrEns->GetListEnseignants();	

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

	
	public function RemplirInfoInscription($Id)
	{	
	//	$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Inscription($Id);
		return ($Info);
	
	}
	
	public function RemplirConflit($Id)
	{	
			
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Conflit($Id);
		return ($Info);
	}

	
	

	
	
	
	
	
	
}
?>
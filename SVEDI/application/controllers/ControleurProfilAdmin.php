<?php 
class ControleurProfilAdmin extends CI_Controller
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
		$data['Date']=$Date;
		
		$data['DP']=$this->RemplirFormulaireDP($Id);
		$this->load->view('vueProfilAdminContent',$data);
		
		$this->load->view('vueFooter');
	
	}
	
	public function ModificationDP()
	{		
		$Id=$this->session->userdata('Id_user');
		$Nom = $this->input->post('Nom');
		$Prenom = $this->input->post('Prenom');
		$Mail = $this->input->post('Mail');
		$Tel = $this->input->post('Tel');
		$Sexe = $this->input->post('Sexe');
		
		$this->load->model('ModeleProfilUtilisateur');
		$this->ModeleProfilUtilisateur->Modification_DP($Id,$Nom,$Prenom,$Mail,$Tel,$Sexe);
		
	    $this->accueil();
	}
	
	public function ModificationMDP()
	{	
		$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleProfilUtilisateur');
		
		$AMdp = $this->input->post('AMdp');
		$Mdp1 = $this->input->post('Mdp1');
		$Mdp2 = $this->input->post('Mdp2');
		
		//echo $AMdp.$Mdp1.$Mdp2 ;
		
		if($Mdp1 == $Mdp2) $this->ModeleProfilUtilisateur->Modification_MDP($Id,$Mdp2);
		
		$this->accueil();
	}

	public function RemplirFormulaireDP($Id)
	{		
		$this->load->model('ModeleProfilUtilisateur');
		$Info=$this->ModeleProfilUtilisateur->Get_FormulaireDP($Id);
		return ($Info);
	}
	
	

	


}
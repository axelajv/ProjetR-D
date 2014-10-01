<?php

class ControleurProfilUtilisateur extends CI_Controller
{

	public function index()
	{
		$this->accueil();
	}

	public function accueil()
	{
		$data = array();
		
		$Id=$this->session->userdata('Id_user');
		$this->load->view('VueProfilUtilisateur\vueHeader');
		
		$data['Notification']=$this->RemplirInfoNotification($Id);
		$this->load->view('VueProfilUtilisateur\vueNav',$data);
		
		$data['DP']=$this->RemplirFormulaireDP($Id);
		$this->load->view('VueProfilUtilisateur\vueProfilUtilisateurContent',$data);
		
		$this->load->view('VueProfilUtilisateur\vueFooter');
	
	}
	
	public function ModificationDP()
	{		
		$Id=$this->session->userdata('Id_user');
		$Nom = $this->input->post('Nom');
		$Prenom = $this->input->post('Prenom');
		$Mail = $this->input->post('Mail');
		$Tel = $this->input->post('Tel');
		
		$this->load->model('ModeleProfilUtilisateur');
		$this->ModeleProfilUtilisateur->Modification_DP($Id,$Nom,$Prenom,$Mail,$Tel);
		
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
	
	
	public function RemplirInfoNotification($Id)
	{		
		$this->load->model('ModeleProfilUtilisateur');
		$Info=$this->ModeleProfilUtilisateur->Get_Notification($Id);
		return ($Info);
	}
	


}
<?php

class ControleurHome extends CI_Controller
{

	public function index()
	{
		$this->accueil();
	}

	public function accueil()
	{
		$data = array();
		
	
		$Id=$this->session->userdata('Id_user');
		
		$data['Nom']=$this->session->userdata('Nom');
		
		$this->load->view('VueHomeUtilisateur\vueHeader');
		
		$data['Notification']=$this->RemplirInfoNotification($Id);
		$this->load->view('VueHomeUtilisateur\vueNav',$data);
		
		$data['Inscription']=$this->RemplirInfoInscription($Id);
		$data['Conflit']=$this->RemplirConflit($Id);
		$this->load->view('VueHomeUtilisateur\vueHomeContent',$data);
		
		$this->load->view('VueHomeUtilisateur\vueFooter');
	
	}
	
	public function RemplirInfoNotification($Id)
	{	

	//	$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id);
			
		
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
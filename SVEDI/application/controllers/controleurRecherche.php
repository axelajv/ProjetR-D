<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controleurRecherche extends CI_Controller
{


	public function loadView($Date)
	{
		$Id=$this->session->userdata('Id_user');

		$data['Date'] =$Date; 
		
		$data['Key'] = $this->input->get('search');
		$data['Resultats']=$this->getResultSearch($this->input->get('search'),$Date);
		$data['Keywords'] = $this->input->get('search');
		$data['Notification']=$this->RemplirInfoNotification($Id,$Date);

		//$this->load->view('vueHeader',$dataHead);
		$this->load->view('vueNav',$data);
		$this->load->view('vueRechercheContent',$data);
		$this->load->view('vueFooter');
		
	}


	public function index()
	{	

		
		$this->load->model('ModeleConnexion');
	    if($this->ModeleConnexion->isLoggedIn()){
			$Date=$this->session->userdata('Date');
			$this->loadView($Date);
		}else{
			$this->load->view('VueConnexion/vueHeader');
  			$this->load->view('VueConnexion/vueConnexionInactive');
			$this->load->view('VueConnexion/vueFooter');
		}
	}

	public function AnneeMoins(){
		
		$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleRespInscrEns');
		$this->load->model('ModeleHome');
		$NomF=$this->ModeleRespInscrEns->GetFiliereNom($Id);
		
		$AMin=$this->ModeleHome->AnneeMin($NomF);
	
		
		$DateActuelle=$this->session->userdata('Date');
		$Date= $DateActuelle;
		
		if($AMin<=$DateActuelle - 1 ){
		
			$Date= $DateActuelle - 1 ;
			$this->session->set_userdata("Date", $Date);
		
		}
		
		$this->loadView($Date);
		
		
		
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
		
		$this->loadView($Date);
	}
	
	
	
	
	
	
	public function RemplirInfoNotification($Id,$Date)
	{	

	//	$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id,$Date);
			
		
		return ($Info);
	}

	public function getResultSearch($var ,$Date){
		$this->load->model('ModeleRecherche');
		$Info=$this->ModeleRecherche->getResultSearch($var ,$Date);
		return $Info;
	}


}

?>
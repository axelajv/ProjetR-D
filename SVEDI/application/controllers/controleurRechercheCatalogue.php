<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controleurRechercheCatalogue extends CI_Controller
{


	public function loadView($Date)
	{

		if ($this->input->get('id')){
			$dataHead['Key'] = $this->input->get('search');
		}else{
			$dataHead['Key'] = "";
		}

		$data['Date'] =$Date; 
		$Id=$this->session->userdata('Id_user');
		$data['Notification']=$this->RemplirInfoNotification($Id,$Date);


		
		$this->load->view('vueNav',$data);

		
		if ($this->input->get('id')){

			$data['Resultats'] = $this->getData($this->input->get('id'));
			$data['Keywords'] = $this->getLabelFiliere($this->input->get('id'));
			
			$this->load->view('vueRechercheCatalogueContent',$data);
		}else{
			$data['Resultats'] = $this->getList($Date);

			$this->load->view('vueRechercheCatalogueListe',$data);
		}

		$this->load->view('vueFooter');
		
		
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
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id,$Date);
			
		return ($Info);
	}

	public function getLabelFiliere($var){
		$this->load->model('ModeleRechercheCatalogue');
		$Info=$this->ModeleRechercheCatalogue->getLabelFiliere($var);
		return $Info;
	}	

	public function getData($var){
		$this->load->model('ModeleRechercheCatalogue');
		$Info=$this->ModeleRechercheCatalogue->getDetail($var);
		return $Info;
	}

	public function getList($Date){
		$this->load->model('ModeleRechercheCatalogue');
		$Info=$this->ModeleRechercheCatalogue->getList($Date);
		return $Info;
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
		}	}



}

?>
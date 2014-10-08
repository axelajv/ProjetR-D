<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controleurRechercheCatalogue extends CI_Controller
{


	public function loadView()
	{

		if ($this->input->get('id')){
			$dataHead['Key'] = $this->input->get('search');
		}else{
			$dataHead['Key'] = "";
		}

		$Id=$this->session->userdata('Id_user');
		$data['Notification']=$this->RemplirInfoNotification($Id);


		$this->load->view('vueHeader',$dataHead);
		$this->load->view('vueNav',$data);

		
		if ($this->input->get('id')){

			$data['Resultats'] = $this->getData($this->input->get('id'));
			$data['Keywords'] = $this->getLabelFiliere($this->input->get('id'));
			$this->load->view('vueRechercheCatalogueContent',$data);
		}else{
			$data['Resultats'] = $this->getList();

			$this->load->view('vueRechercheCatalogueListe',$data);
		}

		$this->load->view('vueFooter');
		
		
	}

	public function RemplirInfoNotification($Id)
	{	
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id);
			
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

	public function getList(){
		$this->load->model('ModeleRechercheCatalogue');
		$Info=$this->ModeleRechercheCatalogue->getList();
		return $Info;
	}



	public function index()
	{	
		
		$this->load->model('ModeleConnexion');
	    if($this->ModeleConnexion->isLoggedIn()){
			$this->loadView();
		}else{
			$this->load->view('VueConnexion/vueHeader');
  			$this->load->view('VueConnexion/vueConnexionInactive');
			$this->load->view('VueConnexion/vueFooter');
		}	}



}

?>
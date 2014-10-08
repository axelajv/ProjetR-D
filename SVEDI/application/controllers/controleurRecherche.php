<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controleurRecherche extends CI_Controller
{


	public function loadView()
	{
		$Id=$this->session->userdata('Id_user');

		$dataHead['Key'] = $this->input->get('search');
		$data['Resultats']=$this->getResultSearch($this->input->get('search'));
		$data['Keywords'] = $this->input->get('search');
		$data['Notification']=$this->RemplirInfoNotification($Id);

		$this->load->view('vueHeader',$dataHead);
		$this->load->view('vueNav',$data);
		$this->load->view('vueRechercheContent',$data);
		$this->load->view('vueFooter');
		
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
		}
	}

	public function RemplirInfoNotification($Id)
	{	

	//	$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id);
			
		
		return ($Info);
	}

	public function getResultSearch($var){
		$this->load->model('ModeleRecherche');
		$Info=$this->ModeleRecherche->getResultSearch($var);
		return $Info;
	}


}

?>
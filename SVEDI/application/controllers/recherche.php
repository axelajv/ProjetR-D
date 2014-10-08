<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recherche extends CI_Controller
{

	public function __construct()
	{
		//	Obligatoire
		parent::__construct();
		
		//	Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->model('rechercheModel');
	
	}


	public function loadView()
	{
		$data = array();
		$data['pseudo'] = 'faitpastapince';
		$data['prenom'] = 'Nico';

		$this->load->view('vueHeader');
		$this->load->view('vueNav');
		$this->load->view('vueRechercheContent');
		$this->load->view('vueFooter');
	}


	public function index()
	{	
		//echo $this->input->get('tst');
		$this->loadView();
		//this->wtf();
	}
}

?>
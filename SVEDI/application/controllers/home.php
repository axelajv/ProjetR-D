<?php

class Home extends CI_Controller
{
	
	public function index()
	{
	$data = array();
		$data['pseudo'] = 'faitpastapince';
		$data['prenom'] = 'Nico';
$dataHead['Key'] = $this->input->get('search');
		$this->load->view('vueHeader',$dataHead);
		$this->load->view('vueNav');
		$this->load->view('vueHomeContent');
		$this->load->view('vueFooter');
	}
}

?>
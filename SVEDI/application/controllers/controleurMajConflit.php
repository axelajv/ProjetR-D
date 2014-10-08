<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controleurMajConflit extends CI_Controller
{


	public function maj($IDm){
		$this->load->model('ModeleMajConflit');
		$this->ModeleMajConflit->maj($IDm);
	}


}

?>
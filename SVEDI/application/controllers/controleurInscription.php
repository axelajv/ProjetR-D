<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controleurInscription extends CI_Controller
{



	public function inscription($Id_Matiere,$HC,$HTD,$HTP){

		$this->load->model('ModeleInscription');
		$this->load->model('ModeleMajConflit');
		$Info=$this->ModeleInscription->inscription($Id_Matiere,$HC,$HTD,$HTP);
		$this->ModeleMajConflit->maj($Id_Matiere);
		
		return $Info;
	}


}

?>
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModeleSession extends CI_Model
{

	public function __construct()
	{
		//	Obligatoire
		parent::__construct();
		
		//	Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
				
		if($this->session->userdata('logged_in') == False){
			 header("Location: ../ControleurConnexion/");
		}
	
	}
	

}?>
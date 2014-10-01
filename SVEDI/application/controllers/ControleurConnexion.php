<?php

class ControleurConnexion extends CI_Controller {

     //constructeur de la classe
    public function __construct()
	{
		parent::__construct();
        $this->load->model('ModelConnexion');
     }


public function index()
	{
		$this->load->view('VueConnexion/vueConnexionContent');
		$this->load->view('VueConnexion/vueHeader');
		$this->load->view('VueConnexion/vueFooter');
		
}

function Deconnect()
{

	$this->ModelConnexion->deconnect();

}

function login(){

          //on charge la validation de formulaires
          $this->load->library('form_validation');
			
          //on définit les règles de succès
          $this->form_validation->set_rules('login','Login','required');
          $this->form_validation->set_rules('password','Mot de passe','required');
			
          //si la validation a échouée on redirige vers le formulaire de login
          if(!$this->form_validation->run()){
              $data['test'] ="NOK";
			  $this->load->view('VueConnexion/vueHeader',$data);
              $this->load->view('VueConnexion/vueConnexionContent',$data);
          } else {
               $username = $this->input->post('login');
               $password = $this->input->post('password');
               $validCredentials = $this->ModelConnexion->validCredentials($username,$password);
            
              if($validCredentials){
			
              		header('Location: http://localhost/SVEDI/index.php/ControleurHome/');      
				//	$this->load->view('VueHomeUtilisateur\vueHeader');
					
               } else {
                    $data['error_credentials'] =  'Login / Mot de Passe incorrect';
					$this->load->view('VueConnexion/vueConnexionContent',$data);
					$this->load->view('VueConnexion/vueHeader');
               }
          }
    
}


}

?>
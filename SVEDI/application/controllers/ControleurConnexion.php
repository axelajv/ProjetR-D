<?php 
class ControleurConnexion extends CI_Controller {

     //constructeur de la classe
    public function __construct()
	{
		parent::__construct();
        $this->load->model('ModeleConnexion');
     }


public function index()
	{
		$this->load->view('VueConnexion/vueHeader');
    $this->load->view('VueConnexion/vueConnexionContent');
		$this->load->view('VueConnexion/vueFooter');
		
}

function recupMdp(){



$email = $this->input->post('mailRecup');


$info = $this->ModeleConnexion->getInfoRecupMail($email);

if($info == null){
   $data['error_credentials'] =  'E-Mail incorrect';

    $this->load->view('VueConnexion/vueHeader');
    $this->load->view('VueConnexion/vueConnexionContent',$data);

   $this->load->view('VueConnexion/vueFooter');
}else{

$this->load->library('email');

$this->email->from('belkmoh@gmail.com', 'SVEDI app.');
$this->email->to($email);

$this->email->subject('Récupération de mot de passe');

if($info[0]['Sexe'] == "M"){
  $prefix = "M";
}else{
  $prefix = "Mme";
}

$this->email->message($prefix." ".$info[0]['Nom'].",\n\nVoici votre mot de passe : ".$info[0]['motDePasse']."\nVous pouvez maintenant vous reconnecter avec votre Login : ".$info[0]['Login']."\n\nCet E-Mail est générer automatiquement, merci de ne pas y répondre.");  

$ret = $this->email->send();

if($ret == true){
  $data['error_credentials'] =  'Votre mot de passe vous a &eacute;t&eacute; renvoy&eacute;.';
  $this->load->view('VueConnexion/vueHeader');
  $this->load->view('VueConnexion/vueConnexionContent',$data);
  $this->load->view('VueConnexion/vueFooter');
}else{
  $data['error_credentials'] =  'Une &eacute;rreur innatendue est survenue';
  $this->load->view('VueConnexion/vueHeader');
  $this->load->view('VueConnexion/vueConnexionContent',$data);
  $this->load->view('VueConnexion/vueFooter');
}

   
}



}

function Deconnect()
{

	$this->ModeleConnexion->deconnect();

}

function login(){

          //on charge la validation de formulaires
          $this->load->library('form_validation');
			
          //on définit les règles de succès
          $this->form_validation->set_rules('login','Login','required');
          $this->form_validation->set_rules('password','Mot de passe','required');
			
          //si la validation a échouée on redirige vers le formulaire de login
          if(!$this->form_validation->run()){
              //$data['test'] ="NOK";
			            $this->load->view('VueConnexion/vueHeader');
                  $this->load->view('VueConnexion/vueConnexionContent');
                  $this->load->view('VueConnexion/vueFooter');
          } else {
               $username = $this->input->post('login');
               $password = $this->input->post('password');
               $validCredentials = $this->ModeleConnexion->validCredentials($username,$password);
            
              if($validCredentials){
			
                if($this->session->userdata('Role') == 3){
                  header('Location: http://localhost/SVEDI/index.php/ControleurAdminHome/');   
                }else{
                  header('Location: http://localhost/SVEDI/index.php/ControleurHome/');   
                }

					
               } else {
                    $data['error_credentials'] =  'Login / Mot de Passe incorrect';

                $this->load->view('VueConnexion/vueHeader');
					      $this->load->view('VueConnexion/vueConnexionContent',$data);

               $this->load->view('VueConnexion/vueFooter');
               }
          }  
  }
}
?>
<?php

class ModelConnexion extends CI_Model {

     function ModelConnexion()
	 {	 
          parent::__Construct();

     }
	 
	 function validCredentials($username,$password){


     //requête préparée, beaucoup plus sécurisé
     $q = " SELECT utilisateur.Nom As Nom_user ,Login, MotDePasse, utilisateur.ID AS ID_user, role.Nom AS nomRole
			FROM utilisateur, roleutilisateur, role
			WHERE Login =  ?
			AND MotDePasse =  ?
			AND role.ID = roleutilisateur.ID_role
			AND roleutilisateur.ID_utilisateur = utilisateur.ID ";

     $data = array($username,$password);
     $q = $this->db->query($q,$data);

     if($q->num_rows() == 1){
          $r = $q->result();
          $sessiondata = array(
                   'Id_user'  => $r[0]->ID_user,
          		   'role' => $r[0]->nomRole,
				   'Nom' => $r[0]->Nom_user,
                   'logged_in' => TRUE
               );
			   
          $this->session->set_userdata($sessiondata);
         
          return true;
        } 
      
              else { return false; }
}

function isLoggedIn(){
     if($this->session->userdata('logged_in'))
     { return true; } else { return false; }
}

function deconnect()
{
	$this->session->sess_destroy();
	$this->load->view('VueConnexion/vueConnexionContent');
	$this->load->view('VueConnexion/vueHeader');
}

}
?>
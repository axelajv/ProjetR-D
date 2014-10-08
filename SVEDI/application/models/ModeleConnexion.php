<?php
class ModeleConnexion extends CI_Model {

     function ModeleConnexion()
	 {	 
          parent::__Construct();

     }


	 
	 function validCredentials($username,$password){


     //requête préparée, beaucoup plus sécurisé
     $q = " SELECT utilisateur.Nom As Nom_user ,Login, MotDePasse, utilisateur.ID AS ID_user, role.Nom AS nomRole, Sexe, Role, t.nbHeure as nbHeures
			FROM utilisateur, role, typeUtilisateur t
			WHERE Login =  ?
			AND MotDePasse =  ?
			AND utilisateur.role =  role.ID
      and utilisateur.Type = t.code";

     $data = array($username,$password);

     $q = $this->db->query($q,$data);

     if($q->num_rows() == 1){
          $r = $q->result();
          $sessiondata = array(
                   'Id_user'  => $r[0]->ID_user,
          	  	   'role' => $r[0]->nomRole,
				           'Nom' => $r[0]->Nom_user,
                   'logged_in' => TRUE,
                   'Sexe'  => $r[0]->Sexe,
                   'Role' => intval($r[0]->Role),
                   'nbHeures' => intval($r[0]->nbHeures)
               );

          $this->session->set_userdata($sessiondata);
          return true;
        } 
        else 
        { return false; }
}

function isLoggedIn(){
     if($this->session->userdata('logged_in'))
     { return true; } else { return false; }
}

function deconnect()
{
	$this->session->sess_destroy();
  $this->load->view('VueConnexion/vueHeader');
	$this->load->view('VueConnexion/vueConnexionContent');
  $this->load->view('VueConnexion/vueFooter');
}


function getInfoRecupMail($mail){
  //requête préparée, beaucoup plus sécurisé
     $sql = "SELECT ID, Nom, Prenom, motDePasse, Sexe, Login from utilisateur where mail ='".$mail."'";
    $query = $this->db->query($sql);
if($query->num_rows() == 1){
  return $query->result_array(); 
}else{
  return null;
}

  }

}
?>
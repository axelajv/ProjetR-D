<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModeleInscription extends CI_Model {


	public function __construct()
	{
		//	Obligatoire
		parent::__construct();
		
		//	Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->database();
	
	}



	private function dejaInscrit($ID_Matiere) {
		$idUtilisateur=$this->session->userdata('Id_user');
		
		$sql =	   "SELECT 'X'
	   				FROM inscription i 
	   				where ID_Utilisateur =".$idUtilisateur." and ID_Matiere = ".$ID_Matiere;
			 
		$query = $this->db->query($sql);	

		$ligne = $query->result_array();

		if ($ligne != null){ return true;}

		return false;
	}

	public function inscription($ID_Matiere,$HC,$HTD,$HTP,$Date){
		$idUtilisateur=$this->session->userdata('Id_user');

		if($this->dejaInscrit($ID_Matiere)){
		
			echo "Vous etes déjà inscrit à cette matière. Inscrition annulée.";
			
		}else{

			$sql =	   "INSERT INTO inscription values(null,".$Date.",".$HC.",".$HTD.",".$HTP.",".$idUtilisateur.",".$ID_Matiere.",'false')";

			$query = $this->db->query($sql);	

			$sql =	   "INSERT INTO notification values(null,'Inscription',NOW(),false,".$idUtilisateur.",'INS',(select MAX(ID_Inscription) from inscription))";

			$query = $this->db->query($sql);	

			echo "Inscription effectuée avec succés.";
			
		}

	}

}

?>
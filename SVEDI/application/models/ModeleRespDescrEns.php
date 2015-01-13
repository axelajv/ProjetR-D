<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModeleRespDescrEns extends CI_Model
{

	public function __construct()
	{
		//	Obligatoire
		parent::__construct();
		
		//	Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->database();
	
	}
	

	public function GetFiliereNom($id){

		 $i=0;
	   
		$sql =	   "SELECT Nom FROM Filiere where ID_Utilisateur = ".$id ;
			 
		$query = $this->db->query($sql);	
	
		$ligne = $query->result_array();

		return $ligne[0]['Nom'];

	}

	public function GetFiliereID($id){

		 $i=0;
	   
		$sql =	   "SELECT ID FROM Filiere where ID_Utilisateur = ".$id ;
			 
		$query = $this->db->query($sql);	
	
		$ligne = $query->result_array();

		return $ligne[0]['ID'];

	}

	public function GetListMatieres($idF){
		
		$sql = "SELECT id,concat(nom,' (S',semestre,')') as Nom from matiere where ID_Filiere = ".$idF." order by Nom";
		$query = $this->db->query($sql);	
	
		$lignes = $query->result_array();

		return $lignes;
	}

	public function GetMatiereInfo($idM){
		$sql = "SELECT m.ID as M_ID,m.MaxHeuresCours as HCM,m.MaxHeuresTD as HTDM, m.MaxHeuresTP as HTPM, sum(nbHeuresTD) as NBHTD,sum(nbHeuresTP) as NBHTP, sum(nbHeuresCours) as NBHC
				FROM matiere m inner join inscription i on i.ID_Matiere = m.ID
				where m.ID = ".$idM;

		$query = $this->db->query($sql);	
	
		$ligne = $query->result_array();

		return $ligne[0];
	}

	public function getListEnseignants($Date){
		$sql = "SELECT ID, concat(nom,' ',prenom,' (',mail,')') as Nom from utilisateur where role in(1,2) and DateUtilisateur=".$Date." order by Nom";
		$query = $this->db->query($sql);	
	
		$lignes = $query->result_array();

		return $lignes;
	}


	private function dejaInscrit($ID_Matiere,$idUtilisateur) {
	   $sql =	   "SELECT 'X'
	   				FROM inscription i 
	   				where ID_Utilisateur =".$idUtilisateur." and ID_Matiere = ".$ID_Matiere;
			 
		$query = $this->db->query($sql);	

		$ligne = $query->result_array();

		if ($ligne != null){ return true;}

		return false;
	}


	public function Inscrire($Eid,$Mid,$HC,$HTD,$HTP){

		if($this->dejaInscrit($Mid,$Eid)){
			echo "Cet enseignant est d&eacute;j&agrave; inscrit &agrave; cette mati&egrave;re. Inscrition annul&eacute;e.";
		}else{
			$sql =	   "INSERT INTO inscription values(null,NOW(),".$HC.",".$HTD.",".$HTP.",".$Eid.",".$Mid.",'false')";

			$query = $this->db->query($sql);	

			$sql =	   "INSERT INTO notification values(null,'Inscription',NOW(),false,".$Eid.",'INS',(select MAX(ID_Inscription) from inscription))";

			$query = $this->db->query($sql);	

			echo "Inscription effectu&eacute;e avec succ&eacute;s.";
		}
	}
	
	
}

?>
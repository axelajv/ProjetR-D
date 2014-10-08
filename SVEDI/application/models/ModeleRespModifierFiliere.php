<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModeleRespModifierFiliere extends CI_Model
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

	public function getListResp(){
		$sql = "SELECT ID, concat(nom,' ',prenom,' (',mail,')') as Nom from utilisateur where role in(2) order by Nom";
		$query = $this->db->query($sql);	
	
		$lignes = $query->result_array();

		return $lignes;
	}
	

	public function getListMatiere($id)
	{
	   $data = array();

	   $i=0;

	   $sql =	   "SELECT ID as M_ID, Nom as M_Nom, maxHeuresCours as M_HC, maxHeuresTD as M_HTD, maxHeuresTP as M_HTP, Semestre as M_Semestre
	   				FROM matiere 
	   				WHERE ID_Filiere =".$id."
	   				ORDER BY Nom";
			 
		$query = $this->db->query($sql);	

		foreach($query->result_array() as $ligne)
		{
			
			$data[$i]['M_ID']= $ligne['M_ID'] ;
			$data[$i]['M_Nom']= $ligne['M_Nom'] ;
			$data[$i]['M_HC'] = $ligne['M_HC'] ;
			$data[$i]['M_HTD']= $ligne['M_HTD'] ;
			$data[$i]['M_HTP']= $ligne['M_HTP'] ;
			$data[$i]['M_Semestre']= $ligne['M_Semestre'] ;


			$i = $i+1;
		}

		return ($data);

	}

	public function GetFiliereID($id){

		 $i=0;
	   
		$sql = "SELECT ID FROM Filiere where ID_Utilisateur = ".$id ;
			 
		$query = $this->db->query($sql);	
	
		$ligne = $query->result_array();

		return $ligne[0]['ID'];

	}

	public function GetFiliereResp($id){
		$sql = "SELECT ID_Utilisateur FROM Filiere where ID = ".$id ;
			 
		$query = $this->db->query($sql);	
	
		$ligne = $query->result_array();

		return $ligne[0]['ID_Utilisateur'];
	}

	public function changeNom($id,$nom){
		$sql = "UPDATE Filiere set nom = '".addslashes($nom)."' WHERE ID =".$id;
		$query = $this->db->query($sql);	
	}

	public function changeResp($rid,$fid){
		$sql = "UPDATE Filiere set ID_Utilisateur = ".$rid." WHERE ID = ".$fid;
		$query = $this->db->query($sql);	
	}

	public function MM($id,$nom,$HC,$HTD,$HTP,$s){

		$sql = "UPDATE matiere set nom = '".addslashes($nom)."', maxHeuresCours = ".$HC.", maxHeuresTD = ".$HTD.", maxHeuresTP = ".$HTP.", semestre = ".$s." where ID = ".$id;
		$query = $this->db->query($sql);	

	}

	public function MA($nom,$HC,$HTD,$HTP,$s,$idF){

		$sql = "INSERT INTO matiere VALUES(null,'".addslashes($nom)."',".$HC.",".$HTD.",".$HTP.",".$idF.",".$s.")";
		$query = $this->db->query($sql);	

	}

	public function supprM($idM){

 		$sqlNotifs="SELECT distinct(n.ID) as ID 
 					from matiere m 
					inner join inscription i on i.ID_Matiere = m.ID 
					inner join notification n on n.ID_Inscription = i.ID_Inscription
					where m.ID = ".$idM;
			 
		$query = $this->db->query($sqlNotifs);	
		$listIdNotifs = $query->result_array();

		foreach ($listIdNotifs as $id) {
			$sqlDelNotif = "delete from notification where ID = ".$id['ID'];
			$qry = $this->db->query($sqlDelNotif);	
		}


		$sql = "DELETE from inscription where ID_Matiere = ".$idM;
		$query = $this->db->query($sql);	

		$sql = "DELETE from matiere where ID = ".$idM;
		$query = $this->db->query($sql);	


	}

	
}
?>
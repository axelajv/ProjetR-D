<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ModeleTypeUtilisateur extends CI_Model {

	public function __construct()
	{
		//	Obligatoire
		parent::__construct();
		
		//	Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->database();
	
	}


public function getTypes(){
	$data =array();
	$i=0;
	$sql =	   "SELECT ID,Code,Libelle,NbHeure from TypeUtilisateur";
			 
		$query = $this->db->query($sql);

		foreach($query->result_array() as $ligne)
		{
			$data[$i]['ID']= $ligne['ID'] ;
			$data[$i]['Code']= $ligne['Code'] ;
			$data[$i]['Libelle']= $ligne['Libelle'] ;
			$data[$i]['NbHeure'] = $ligne['NbHeure'] ;
			$i = $i+1;
		}		
		return ($data);

	}
public function TypesAdd($Code, $Libele,$NbHeure){

	$sql =	"insert into typeutilisateur values(null,'".$Code."','".$Libele."','".$NbHeure."')";
	$query = $this->db->query($sql);	
	}
	
	
public function TypesSuppression($id){

	$sql = "Delete from typeutilisateur where ID = ".$id;
	$query = $this->db->query($sql);

	return "le Statut de l'enseignant a été supprimé";
	}

public function TypesModification($id, $Code, $Libelle,$NbHeure){

	$sql = "update typeutilisateur set Code = '".$Code."', Libelle = '".$Libelle."', NbHeure = '".$NbHeure."' where ID = ".$id;
	$query = $this->db->query($sql);	
		

	}	
}
?>
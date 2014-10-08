<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModeleAdminHome extends CI_Model {


	public function __construct()
	{
		//	Obligatoire
		parent::__construct();
		
		//	Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->database();
	
	}



//---------------------------------------------------------//
//------------------- Get users ---------------------------//
//---------------------------------------------------------//
	public function getListUser()
	{
	   $data = array();

	   $i=0;

	   $sql =	   "SELECT u.ID as U_ID,
	   					   u.Nom as U_Nom,
	   					   u.Prenom as U_Pre,
	   					   u.mail as U_Mail,
	   					   u.sexe as U_Sexe,
	   					   u.tel as U_Tel,
	   					   u.login as U_Login,
	   					   u.MotDePasse as U_Mdp,
	   					   u.role as U_Role,
	   					   u.type as U_Type
	   				FROM  utilisateur u
	   				ORDER BY U_Nom";
			 
		$query = $this->db->query($sql);	

		foreach($query->result_array() as $ligne)
		{
			
			$data[$i]['U_ID']= $ligne['U_ID'] ;
			$data[$i]['U_Nom']= $ligne['U_Nom'] ;
			$data[$i]['U_Pre'] = $ligne['U_Pre'] ;
			$data[$i]['U_Mail']= $ligne['U_Mail'] ;
			$data[$i]['U_Tel']= $ligne['U_Tel'] ;
			$data[$i]['U_Login']= $ligne['U_Login'] ;
			$data[$i]['U_Mdp'] = $ligne['U_Mdp'] ;
			$data[$i]['U_Role']= $ligne['U_Role'] ;
			$data[$i]['U_Sexe']= $ligne['U_Sexe'] ;
			$data[$i]['U_Type']= $ligne['U_Type'] ;

			$i = $i+1;
		}

		return ($data);

	}


//---------------------------------------------------------//
//------------------- Get filiere ---------------------------//
//---------------------------------------------------------//
	public function getListFiliere()
	{
	   $data = array();

	   $i=0;

	   $sql =	   "SELECT f.ID as F_ID,
	   					   f.Nom as F_Nom,
	   					   (SELECT count(*) from matiere where ID_Filiere = F_ID) as F_Nbm,
	   					   (SELECT count(distinct(ID_Utilisateur)) from matiere m inner join inscription i on i.ID_Matiere = m.ID where m.ID_Filiere = F_ID) as F_Nbi

	   				FROM filiere f 
	   				ORDER BY F_Nom";
			 
		$query = $this->db->query($sql);	

		foreach($query->result_array() as $ligne)
		{
			
			$data[$i]['F_ID']= $ligne['F_ID'] ;
			$data[$i]['F_Nom']= $ligne['F_Nom'] ;
			$data[$i]['F_Nbm'] = $ligne['F_Nbm'] ;
			$data[$i]['F_Nbi']= $ligne['F_Nbi'] ;

			$i = $i+1;
		}

		return ($data);

	}



public function FiliereSuppression($ID_Filiere){
	$ID_Filiere = intval($ID_Filiere);

	    $sqlNotifs =	   "SELECT distinct(n.ID) as ID from filiere f 
	    			inner join matiere m on f.ID = m.ID_Filiere 
					inner join inscription i on i.ID_Matiere = m.ID 
					inner join notification n on n.ID_Inscription = i.ID_Inscription
					where f.ID = ".$ID_Filiere;
			 
		$query = $this->db->query($sqlNotifs);	
		$listIdNotifs = $query->result_array();


		$sqlInscriptions =	   "SELECT distinct(i.ID_Inscription) as ID from filiere f 
	    			inner join matiere m on f.ID = m.ID_Filiere 
					inner join inscription i on i.ID_Matiere = m.ID 
					inner join notification n on n.ID_Inscription = i.ID_Inscription
					where f.ID = ".$ID_Filiere;
			 
		$query = $this->db->query($sqlInscriptions);	
		$listIdInscriptions = $query->result_array();


		$sqlMatieres =	   "SELECT distinct(m.ID) as ID from filiere f 
	    			inner join matiere m on f.ID = m.ID_Filiere 
					inner join inscription i on i.ID_Matiere = m.ID 
					inner join notification n on n.ID_Inscription = i.ID_Inscription
					where f.ID = ".$ID_Filiere;
			 
		$query = $this->db->query($sqlMatieres);	
		$listIdMatieres = $query->result_array();


		foreach ($listIdNotifs as $id) {
			//echo "\n\ndelete from notification where ID = ".$id['ID'];

			$sqlDelNotif = "delete from notification where ID = ".$id['ID'];
			$qry = $this->db->query($sqlDelNotif);	
		}

		
		foreach ($listIdInscriptions as $id) {
			//echo "\n\ndelete from inscription where ID_Inscription = ".$id['ID'];

			$sqlDelInscriptions = "delete from inscription where ID_Inscription = ".$id['ID'];
			$qry = $this->db->query($sqlDelInscriptions);	
		}

		foreach ($listIdMatieres as $id) {
			//echo "\n\rdelete from matiere where ID = ".$id['ID'];

			$sqlDelMatiere = "delete from matiere where ID = ".$id['ID'];
			$qry = $this->db->query($sqlDelMatiere);	
		}

		//echo "\n\ndelete from Filiere where ID = ".$ID_Filiere."wtf";
		$sqlDelFiliere = "delete from Filiere where ID = ".$ID_Filiere;
		$qry = $this->db->query($sqlDelFiliere);


		return "Filière supprimée";
}

public function UtilisateurModification($ID,$Prenom,$Nom,$Mail,$Sexe,$Tel,$Login,$Mdp,$Role,$Type){

	$sql = "update utilisateur set Prenom = '".$Prenom."', Nom = '".$Nom."', Mail = '".$Mail."', Sexe ='".$Sexe."', Tel = ".$Tel.", Login = '".$Login."', MotDePasse = '".$Mdp."', Role =".$Role.", Type ='".$Type."' where ID = ".$ID;
	$qry = $this->db->query($sql);

	}


public function UtilisateurAdd($Prenom,$Nom,$Mail,$Sexe,$Tel,$Login,$Mdp,$Role,$Type){

	$sql = "insert into utilisateur values(null,'".$Nom."','".$Prenom."','".$Sexe."','".$Login."','".$Mdp."','".$Mail."','".$Tel."',".$Role.",'".$Type."')";
	$qry = $this->db->query($sql);

	}

public function getRoles(){

	$sql =	   "SELECT ID,Nom from role";
			 
		$query = $this->db->query($sql);	
		return $query->result_array();

	}


public function getTypes(){

	$sql =	   "SELECT code,libelle from TypeUtilisateur";
			 
		$query = $this->db->query($sql);	
		return $query->result_array();

	}

public function UtilisateurSuppression($ID_Utilisateur){
/*
 		$sql =	   "";
			 
		$query = $this->db->query($sql);*/

		$ID_Utilisateur = intval($ID_Utilisateur);

	    $sqlDelNotifs = "Delete from notification where ID_Utilisateur = ".$ID_Utilisateur;			 
		$query = $this->db->query($sqlDelNotifs);	

		$sqlDelInscriptions = "Delete from inscription where ID_Utilisateur = ".$ID_Utilisateur;			 
		$query = $this->db->query($sqlDelInscriptions);

		$sqlDelUtilisateur = "Delete from utilisateur where ID = ".$ID_Utilisateur;			 
		$query = $this->db->query($sqlDelUtilisateur);

	
		

		return "Utilisateur supprimée";
}
	

};?>
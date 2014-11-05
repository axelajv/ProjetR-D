<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModeleHome extends CI_Model
{

	public function __construct()
	{
		//	Obligatoire
		parent::__construct();
		
		//	Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->database();
	
	}
	
	
	
	
	
	public function SuppInscription($ID){
	
		$data = array();
		
		$sql0=" Select id_matiere
				From inscription
				WHERE ID_Inscription =".$ID.";" ;
    	
	    $sql1 = "DELETE 
				FROM notification 
				WHERE ID_Inscription =".$ID.";" ;
		
		
	    $sql2 = "DELETE 
				FROM inscription 
				WHERE ID_Inscription =".$ID.";";
		
		$query0 = $this->db->query($sql0); 
		$query1 = $this->db->query($sql1);	
		$query2 = $this->db->query($sql2);	

		
		foreach($query0->result_array()  as $ligne)
		{
			
			$data[0]= $ligne['id_matiere'] ;
		    
		}
		
		$this->load->model('ModeleMajConflit');
		$this->ModeleMajConflit->maj($data[0]);
		
		return("Désinscription effectuée");
	
	}
	
	
//---------------------------------------------------------//
//-------------------Get Conflit---------------------------//
//---------------------------------------------------------//


	public function Get_Conflit($ID,$Date)
	{
	   $data = array();
	   $i=0;
	   
	   $sql =	   "SELECT M.Nom AS 'NomM', F.Nom AS 'NomF', NbHeuresTD, NbHeuresTP, NbHeuresCours , Conflit, semestre , I.ID_Inscription as 'ID_Inscription'
					FROM Matiere AS M, Filiere AS F, Utilisateur AS U, Inscription AS I 
					WHERE U.ID = ?
					AND I.DateInscription=?
					AND I.ID_Utilisateur = U.ID
					AND I.ID_Matiere = M.ID
					AND M.ID_Filiere = F.ID
					AND Conflit=true " ;
			 
	
		$param = array($ID,$Date);	 
		$query = $this->db->query($sql,$param);	
		
		foreach($query->result_array()  as $ligne)
		{
		    $data[$i][0]= $ligne['NomM']." (S".$ligne['semestre'].")" ;
            $data[$i][1]= $ligne['NomF'] ;
		    $data[$i][2]= $ligne['NbHeuresTP'] ;
		    $data[$i][3]= $ligne['NbHeuresTD'] ;
		    $data[$i][4]= $ligne['NbHeuresCours'] ;
			$data[$i][5]= number_format($ligne['NbHeuresTD']+ ($ligne['NbHeuresTP']*(2/3)) + $ligne['NbHeuresCours']*1.5,1) ;
			$data[$i][6]= $ligne['ID_Inscription'] ;
		    $i=$i+1;
		}
		
		return ($data);
	}
	
//---------------------------------------------------------//
//-------------------Get Notification----------------------//
//---------------------------------------------------------//
	
	
	public function Get_Notification($ID,$Date)
	{
	   $dataN = array();
	   $i=0;
	   
	   $sqlN =	   "SELECT Texte, DateNotification, Lu, TypeNotif, M.Nom AS 'NomM', F.Nom AS 'NomF', NbHeuresTD, NbHeuresTP, NbHeuresCours ,N.ID As 'Id_Notif'
					FROM Notification AS N, Matiere AS M, Filiere AS F, Inscription AS I
					WHERE N.ID_Utilisateur = ?
					AND F.DateFiliere = ?
					AND I.ID_Inscription = N.ID_Inscription
					AND I.ID_Matiere = M.ID
					AND M.ID_Filiere = F.ID 
					order by  DateNotification desc ;" ;
			 
		
		$param = array($ID,$Date);	 
		$queryN = $this->db->query($sqlN,$param);	
		
		foreach($queryN->result_array()  as $ligneN)
		{
		    $dataN[$i][0]= $ligneN['Texte'] ;
            $dataN[$i][1]= $ligneN['DateNotification'] ;
		    $dataN[$i][2]= $ligneN['Lu'] ;
			switch ($ligneN['TypeNotif']) {
				case 'CON':
					$dataN[$i][3]='Conflit';
					break;
				case 'INS':
					$dataN[$i][3]='Inscription';
					break;
			}
			$dataN[$i][4]= $ligneN['NomM'] ;
			$dataN[$i][5]= $ligneN['NomF'] ;
			$dataN[$i][6]= $ligneN['NbHeuresTP'] ;
			$dataN[$i][7]= $ligneN['NbHeuresTD'] ;
			$dataN[$i][8]= $ligneN['NbHeuresCours'] ;
			$dataN[$i][9]= $ligneN['Id_Notif'] ;
		    $i=$i+1;
		}
		

	    $sqlD =	"SELECT Texte, DateNotification, Lu, TypeNotif
					FROM Notification 
					WHERE ID_Utilisateur = ".$ID."
					AND TypeNotif = 'DES'" ;
			 
	 
		$queryD = $this->db->query($sqlD);	
		
		foreach($queryD->result_array()  as $ligneN)
		{
		    $dataN[$i][0]= $ligneN['Texte'] ;
            $dataN[$i][1]= $ligneN['DateNotification'] ;
		    $dataN[$i][2]= $ligneN['Lu'] ;
			$dataN[$i][3]='Desinscription';
		    $i=$i+1;
		}
		
		return ($dataN);
	}
	
	
	
	public function NotifSuppression($ID){
	
	    $sql = "DELETE 
				FROM notification 
				WHERE ID =".$ID.";";
		
	
		$query = $this->db->query($sql);	
	
	}
	

	
	
//---------------------------------------------------------//
//-------------------Get Inscription-----------------------//
//---------------------------------------------------------//
	
	public function Get_Inscription($ID ,$Date)
	{
	    $data = array();
	    $i=0;
	   
			 
	   $sql =	   "SELECT M.Nom AS 'NomM', F.Nom AS 'NomF', NbHeuresTD, NbHeuresTP, NbHeuresCours , semestre , I.ID_Inscription AS 'ID_Inscription'
					FROM Matiere AS M, Filiere AS F, Utilisateur AS U, Inscription AS I 
					WHERE U.ID = ?
					AND I.DateInscription= ?
					AND I.ID_Utilisateur = U.ID
					AND I.ID_Matiere = M.ID
					AND M.ID_Filiere = F.ID
					AND Conflit= false" ;
			 
		$param = array($ID,$Date);	 
		$query = $this->db->query($sql,$param);	
	
			foreach($query->result_array()  as $ligne)
			{
			
				
				$data[$i][0]= $ligne['NomM']." (S".$ligne['semestre'].")" ;
				$data[$i][1]= $ligne['NomF'] ;
				$data[$i][2]= $ligne['NbHeuresTD'] ;
				$data[$i][3]= $ligne['NbHeuresTP'] ;
				$data[$i][4]= $ligne['NbHeuresCours'] ;
			    $data[$i][5]= number_format($ligne['NbHeuresTD']+ ($ligne['NbHeuresTP']*(2/3)) + $ligne['NbHeuresCours']*1.5,1) ;
				$data[$i][6]= $ligne['ID_Inscription'] ;
				$i=$i+1;
			}
		
		return ($data);
	}

	public function GetPrefix($id){

		 $i=0;
	   
		$sql =	   "SELECT Sexe FROM Utilisateur where ID = ".$id ;
			 
		$query = $this->db->query($sql);	
	
		$ligne = $query->result_array();

		if($ligne[0]['Sexe'] == "M"){
			return "M.";
		}else{
			return "Mme.";
		}

	}

	public function GetActualHours($id,$Date){

		 $i=0;
	   
		$sql = "SELECT SUM((nbHeuresCours*1.5)+NbHeuresTD+(NbHeuresTP*(2/3))) as nb from inscription where DateInscription=".$Date." AND ID_Utilisateur =".$id ;
			 
		$query = $this->db->query($sql);	
	
		$ligne = $query->result_array();

		return $ligne[0]['nb'];

		}
	
	
}

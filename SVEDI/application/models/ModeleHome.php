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
	
//---------------------------------------------------------//
//-------------------Get Conflit---------------------------//
//---------------------------------------------------------//
	public function Get_Conflit($ID)
	{
	   $data = array();
	   $i=0;
	   
	   $sql =	   "SELECT M.Nom AS 'NomM', F.Nom AS 'NomF', NbHeuresTD, NbHeuresTP, NbHeuresCours , Conflit
					FROM Matiere AS M, Filiere AS F, Utilisateur AS U, Inscription AS I 
					WHERE U.ID = ?
					AND I.ID_Utilisateur = U.ID
					AND I.ID_Matiere = M.ID
					AND M.ID_Filiere = F.ID
					AND Conflit='0' " ;
			 
	
		$param = array($ID);	 
		$query = $this->db->query($sql,$param);	
		
		foreach($query->result_array()  as $ligne)
		{
		    $data[$i][0]= $ligne['NomM'] ;
            $data[$i][1]= $ligne['NomF'] ;
		    $data[$i][2]= $ligne['NbHeuresTD'] ;
		    $data[$i][3]= $ligne['NbHeuresTP'] ;
		    $data[$i][4]= $ligne['NbHeuresCours'] ;
			$data[$i][5]= $ligne['NbHeuresTD']+ $ligne['NbHeuresTP'] + $ligne['NbHeuresCours'] ;
		    $i=$i+1;
		}
		
		return ($data);
	}
	
//---------------------------------------------------------//
//-------------------Get Notification-----------------------//
//---------------------------------------------------------//
	
	
/* SELECT Texte, DateNotification, Lu, TypeNotif, M.Nom AS 'NomM', F.Nom AS 'NomF', NbHeuresTD, NbHeuresTP, NbHeuresCours
FROM Notification AS N, Matiere AS M, Filiere AS F, Inscription AS I
WHERE N.ID_Utilisateur = '1'
AND I.ID_Inscription = N.ID_Inscription
AND I.ID_Matiere = M.ID
AND M.ID_Filiere = F.ID
	*/
	
	
	
	
	
	public function Get_Notification($ID)
	{
	   $dataN = array();
	   $i=0;
	   
	   $sqlN =	   "SELECT Texte, DateNotification, Lu, TypeNotif, M.Nom AS 'NomM', F.Nom AS 'NomF', NbHeuresTD, NbHeuresTP, NbHeuresCours
					FROM Notification AS N, Matiere AS M, Filiere AS F, Inscription AS I
					WHERE N.ID_Utilisateur = ?
					AND I.ID_Inscription = N.ID_Inscription
					AND I.ID_Matiere = M.ID
					AND M.ID_Filiere = F.ID ;" ;
			 
		
		$param = array($ID);	 
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
			$dataN[$i][6]= $ligneN['NbHeuresTD'] ;
			$dataN[$i][7]= $ligneN['NbHeuresTP'] ;
			$dataN[$i][8]= $ligneN['NbHeuresCours'] ;
		    $i=$i+1;
		}
		
		return ($dataN);
	}
	
	
//---------------------------------------------------------//
//-------------------Get Inscription-----------------------//
//---------------------------------------------------------//
	
	public function Get_Inscription($ID)
	{
	    $data = array();
	    $i=0;
	   
			 
		$sql =	   "SELECT M.Nom AS 'NomM', F.Nom AS 'NomF', NbHeuresTD, NbHeuresTP, NbHeuresCours
					FROM Matiere AS M, Filiere AS F, Utilisateur AS U, Inscription AS I 
					WHERE U.ID = ?
					AND I.ID_Utilisateur = U.ID
					AND I.ID_Matiere = M.ID
					AND M.ID_Filiere = F.ID
					AND Conflit='1'" ;
			 
		$param = array($ID);	 
		$query = $this->db->query($sql,$param);	
	
			foreach($query->result_array()  as $ligne)
			{
			
				
				$data[$i][0]= $ligne['NomM'] ;
				$data[$i][1]= $ligne['NomF'] ;
				$data[$i][2]= $ligne['NbHeuresTD'] ;
				$data[$i][3]= $ligne['NbHeuresTP'] ;
				$data[$i][4]= $ligne['NbHeuresCours'] ;
				$data[$i][5]= $ligne['NbHeuresTD']+ $ligne['NbHeuresTP'] + $ligne['NbHeuresCours'] ;
				$i=$i+1;
			}
		
		return ($data);
	}
	
	
}
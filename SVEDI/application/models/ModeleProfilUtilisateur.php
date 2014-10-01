<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModeleProfilUtilisateur extends CI_Model
{

	public function __construct()
	{
		//	Obligatoire
		parent::__construct();
		
		//	Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->database();
	
	}
	
//---------------------------------------------------------//
//-------------------Get Notification-----------------------//
//---------------------------------------------------------//
	
	public function Get_Notification($Id)
	{
	   $dataN = array();
	   $i=0;
	   
	   $sqlN =	   "SELECT Texte, DateNotification, Lu, TypeNotif, M.Nom AS 'NomM', F.Nom AS 'NomF', NbHeuresTD, NbHeuresTP, NbHeuresCours
					FROM Notification AS N, Matiere AS M, Filiere AS F, Inscription AS I
					WHERE N.ID_Utilisateur = ?
					AND I.ID_Inscription = N.ID_Inscription
					AND I.ID_Matiere = M.ID
					AND M.ID_Filiere = F.ID ;" ;
			 
		$param = array($Id);	 
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
	
	public function Get_FormulaireDP($Id)
	{
	   
	   $sql =  "SELECT Nom, Prenom, Mail, Tel , MotDePasse
				FROM utilisateur
				WHERE ID = ? ;" ;
					
		
		$param = array($Id);	 
		$query = $this->db->query($sql,$param);	
		
		foreach($query->result_array()  as $ligne)
		{
		    $data[0]= $ligne['Nom'] ;
            $data[1]= $ligne['Prenom'] ;
		    $data[2]= $ligne['Mail'] ;
			$data[3]= $ligne['Tel'] ;
			$data[4]= $ligne['MotDePasse'] ;
		}
		
		return ($data);
		
	}
	
		
	public function Modification_DP($Id,$Nom,$Prenom,$Mail,$Tel)
	{

	   $sql = "UPDATE utilisateur SET Nom = '" .$Nom."' ,
				Prenom = '".$Prenom."',
				Mail = '".$Mail."' ,
				Tel='".$Tel."' WHERE ID = ? ;" ;
		
		$param = array($Id);	 
		$query = $this->db->query($sql,$param);	

		return($query);
	
	}

	
	public function Modification_MDP($Id,$Mdp2)
	{
		
	   $sql = "UPDATE utilisateur SET MotDePasse = '" .$Mdp2."'  WHERE ID = ?;" ;
				
		$param = array($Id);	 
		$query = $this->db->query($sql,$param);	
		
	
	}
	
}
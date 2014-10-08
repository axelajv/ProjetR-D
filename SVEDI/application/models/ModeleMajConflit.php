<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModeleMajConflit extends CI_Model {


	public function __construct()
	{
		//	Obligatoire
		parent::__construct();
		
		//	Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->database();
	
	}



	public function maj($ID_Matiere) {

		

 		$sql = "SELECT ID_Inscription, ID_Utilisateur, nom 
 				FROM inscription i inner join matiere m on i.ID_Matiere = m.ID 
 				where ID_Matiere = ".$ID_Matiere."  
 				and (  (select sum(nbHeuresCours) from inscription where ID_Matiere = m.ID) > MaxHeuresCours 
 					or (select sum(nbHeuresTD) from inscription where ID_Matiere = m.ID) > MaxHeuresTD 
 					or (select sum(nbHeuresTP) from inscription where ID_Matiere = m.ID) > MaxHeuresTP)";

		$query = $this->db->query($sql);	
		$result = $query->result_array();
		$numRows = $query->num_rows();

		//s'il n'y a pas de conflit : conflit -> false
		if($numRows == 0){
			$sqlUp = "UPDATE inscription SET conflit = false where ID_Matiere = ".$ID_Matiere;

			$this->db->query($sqlUp);	

		}else{
			//s'il y a conflit, on envoi une notif a tout les concerné et on passe le boolean conflit a true dans la table des inscriptions
			
		for($i=0;$i<$query->num_rows();$i++)
		{
			$sqlNotif =	   "INSERT INTO notification 
							values(null,'Conflit détecter concernant la matière ".addslashes($result[$i]["nom"])."',NOW()-2,false,".$result[$i]["ID_Utilisateur"].",'CON',".$result[$i]["ID_Inscription"].")";

			$this->db->query($sqlNotif);	
		}


 		$sqlFin = "UPDATE inscription SET conflit = true where ID_Inscription in (select ID_Inscription from (SELECT ID_Inscription 
	 				FROM inscription i inner join matiere m on i.ID_Matiere = m.ID 
	 				where ID_Matiere = ".$ID_Matiere."  
	 				and (  (select sum(nbHeuresCours) from inscription where ID_Matiere = m.ID) > MaxHeuresCours 
	 					or (select sum(nbHeuresTD) from inscription where ID_Matiere = m.ID) > MaxHeuresTD 
	 					or (select sum(nbHeuresTP) from inscription where ID_Matiere = m.ID) > MaxHeuresTP)) as tmp)";

			$this->db->query($sqlFin);

			$sql = "SELECT u.mail as mail from utilisateur u inner join filiere f on f.ID_utilisateur = u.id inner join matiere m on m.ID_filiere = f.ID where m.ID = ".$ID_Matiere;
			$resQry = $this->db->query($sql);
			$mail = $resQry->result_array();


			$this->load->library('email');
			$this->email->from('nicolasmar91@gmail.com', 'SVEDI app.');
			$this->email->to($mail[0]['mail']);
			$this->email->subject('Conflit detecter');

			$sql = "select Nom from matiere where id = ".$ID_Matiere;
			$resQry = $this->db->query($sql);
			$nom = $resQry->result_array();

			$this->email->message("Bonjour,\n\nUn conflit à été detecter concernant la matière".$nom[0]["Nom"].".\n\nVeuillez vous connecter à l'application pour plus de détail :\n\n".base_url()."ControleurConnexion/\n\nCet E-Mail est générer automatiquement, merci de ne pas y répondre.");  

			$ret = $this->email->send();


		}

	}



}

?>
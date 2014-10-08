<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModeleRecherche extends CI_Model {


	public function __construct()
	{
		//	Obligatoire
		parent::__construct();
		
		//	Maintenant, ce code sera exécuté chaque fois que ce contrôleur sera appelé.
		$this->load->database();
	
	}



//---------------------------------------------------------//
//-------------------Get results---------------------------//
//---------------------------------------------------------//
	public function getResultSearch($keyword)
	{
	   $data = array();

if ($keyword == ''){ return $data;}


	   $i=0;

	   $sql =	   "SELECT m.ID as M_ID,
	   					   m.nom as M_Nom, 
	   					   m.MaxHeuresCours as HC, 
	   					   m.MaxHeuresTD as HTD, 
	   					   m.MaxHeuresTP as HTP, 
	   					   f.ID as F_ID, 
	   					   f.nom as F_Nom,
	   					   u.Nom as U_Nom,
	   					   u.mail as U_Mail,
	   					   u.sexe as U_Sexe
	   				FROM matiere m inner join filiere f on m.ID_Filiere = f.ID inner join utilisateur u on f.ID_Utilisateur = u.ID
	   				WHERE m.nom like('%".$keyword."%')
	   				ORDER BY F_Nom";
			 
		$query = $this->db->query($sql);	

		foreach($query->result_array() as $ligne)
		{
			
			$data[$i]['M_ID']= $ligne['M_ID'] ;
			$data[$i]['M_Nom']= $ligne['M_Nom'] ;
			$data[$i]['HC'] = $ligne['HC'] ;
			$data[$i]['HTD']= $ligne['HTD'] ;
			$data[$i]['HTP']= $ligne['HTP'] ;
			$data[$i]['F_ID']= $ligne['F_ID'] ;
			$data[$i]['F_Nom']= $ligne['F_Nom'] ;
			$data[$i]['U_Nom']= $ligne['U_Nom'] ;
			$data[$i]['U_Mail']= $ligne['U_Mail'] ;
			$data[$i]['U_Sexe']= $ligne['U_Sexe'] ;

			    $sqlBis =	   "SELECT ID_Matiere,
			   						   sum(nbHeuresCours) as M_SumHC,
			   						   sum(nbHeuresTD) as M_SumHTD,
			   						   sum(nbHeuresTP) as M_SumHTP 
			   					from inscription 
			   					where ID_Matiere = '".$ligne['M_ID']."' group by ID_Matiere";
					 
				$queryBis = $this->db->query($sqlBis);	

				foreach($queryBis->result_array() as $ligneBis){
					$data[$i]['M_SumHC']= $ligneBis['M_SumHC'] ;
					$data[$i]['M_SumHTD']= $ligneBis['M_SumHTD'] ;
					$data[$i]['M_SumHTP']= $ligneBis['M_SumHTP'] ;
				}

				if (!isset($data[$i]['M_SumHC']) ){
					$data[$i]['M_SumHC']= 0 ;
					$data[$i]['M_SumHTD']= 0 ;
					$data[$i]['M_SumHTP']= 0 ;
				}

			$i = $i+1;
		}

		return ($data);

	}

}

?>
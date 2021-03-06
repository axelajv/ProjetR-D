﻿<?php
class ControleurAdminModifierFiliere extends CI_Controller
{
	public function index()
	{
		$Date=$this->session->userdata('Date');
		
		$this->load->model('ModeleConnexion');
	    if($this->ModeleConnexion->isLoggedIn()){
	    	$this->accueil($Date);
		}else{
			$this->load->view('VueConnexion/vueHeader');
  			$this->load->view('VueConnexion/vueConnexionInactive');
			$this->load->view('VueConnexion/vueFooter');
		}
	}

	public function accueil($Date)
	{
		$data = array();
		$this->load->model('ModeleAdminModifierFiliere');

		$id = $this->input->get('id');
		
		$data = $this->prepareViewAdminModifierFiliere($id);
		
		$data['Date'] =$Date;
		
		$this->load->view('vueAdminModifierFiliere',$data);
		$this->load->view('vueFooter');
	
	}
	
	public function AnneePlus()
	{	
		$Date= $this->session->userdata('Date');
        $Date = $Date+1;
        $this->session->set_userdata("Date", $Date);
        
        $id = $this->input->get('id');
        
        $data = $this->prepareViewAdminModifierFiliere($id);
        
        
    	$this->load->view('vueAdminModifierFiliere',$data);
		$this->load->view('vueFooter');
		
			
	}
    
    public function AnneeMoins()
    {

	$DateActuelle=$this->session->userdata('Date');
		
		if($DateActuelle > Date("Y")){
			$Date= $DateActuelle - 1 ;
			$this->session->set_userdata("Date", $Date);
			$id = $this->input->get('id');
			$data = $this->prepareViewAdminModifierFiliere($id);
			$this->load->view('vueAdminModifierFiliere',$data);
			$this->load->view('vueFooter');
		} else {
			
			$id = $this->input->get('id');
			$data = $this->prepareViewAdminModifierFiliere($id);
			$this->load->view('vueAdminModifierFiliere',$data);
			$this->load->view('vueFooter');
			
		}
	
       
        
        
   

    }
    
    public function prepareViewAdminModifierFiliere($id)
    {

    	 if($this->input->get('id')){
			if($id == "new"){
				$data['FID'] = $this->ModeleAdminModifierFiliere->GetNewFiliere();
				$id = $data['FID'];
				$data['Matieres'] = $this->getListM($id);
				$data['SelectResp'] = $this->getListRselect($this->GetFiliereResp($id));
				$data['FiliereNom']=$this->ModeleAdminModifierFiliere->GetFiliereNom($id);
				$data['SelectFiliere']=$this->getListFselect($id);
			}else{
				$data['FID']=$id;
				$data['Matieres'] = $this->getListM($id);
				$data['SelectResp'] = $this->getListRselect($this->GetFiliereResp($id));
				$data['FiliereNom']=$this->ModeleAdminModifierFiliere->GetFiliereNom($id);
				$data['SelectFiliere']=$this->getListFselect($id);		
			}		
		}else{
			$data['SelectResp'] = $this->getListR();
			$data['FiliereNom']=false;
			$data['SelectFiliere']=$this->getListFselect($id);

		}
		
		if($this->input->get('error'))
		{
			$data['error'] = $this->input->get('error');
		}
		
		return $data;
    
    }


	public function log()
	{

		if($this->input->get('MM')){
			$data['Log'] = "Modification effectuée";
		}
		if($this->input->get('MA')){
			$data['Log'] = "Matière créée";
		}

		$data = array();
		$this->load->model('ModeleAdminModifierFiliere');

		
		$id=$this->input->get('id');


		if($this->input->get('id')){
			if($id == "new"){
				$data['FID'] = $this->ModeleAdminModifierFiliere->GetNewFiliere();
				$id = $data['FID'];
				$data['Matieres'] = $this->getListM($id);
				$data['SelectResp'] = $this->getListRselect($this->GetFiliereResp($id));
				$data['FiliereNom']=$this->ModeleAdminModifierFiliere->GetFiliereNom($id);
				$data['SelectFiliere']=$this->getListFselect($id);

			}else{
				$data['FID']=$id;
				$data['Matieres']=$this->getListM($id);
				$data['SelectResp']=$this->getListRselect($this->GetFiliereResp($id));
				$data['FiliereNom']=$this->ModeleAdminModifierFiliere->GetFiliereNom($id);
				$data['SelectFiliere']=$this->getListFselect($id);
			}
			

		}else{
			$data['SelectResp'] = $this->getListR();
			$data['SelectFiliere']=$this->getListFselect($id);
			$data['FiliereNom']=false;

		}
		
		$this->load->view('vueAdminModifierFiliere',$data);
		$this->load->view('vueFooter');
	
	}

	public function RemplirInfoNotification($Id)
	{	

		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id);
			
		
		return ($Info);
	}	

	public function getListM($Id)
	{	

		$this->load->model('ModeleRespModifierFiliere');
		$Info=$this->ModeleRespModifierFiliere->getListMatiereAdmin($Id);
			
		
		return ($Info);
	}	

	public function GetFiliereResp($id){
		$this->load->model('ModeleRespModifierFiliere');
		$Info=$this->ModeleRespModifierFiliere->GetFiliereResp($id);		
		return ($Info);
	}


	public function getIdF($id){
		$this->load->model('ModeleRespModifierFiliere');
		$Info=$this->ModeleRespModifierFiliere->GetFiliereID($id);		
		return ($Info);
	}


	public function getListR(){
	
		$Date= $this->session->userdata('Date');
		
		$this->load->model('ModeleRespModifierFiliere');

		$ListUser = $this->ModeleRespModifierFiliere->GetListResp($Date);	

		$select ='<select id="selectResp">';
		$select = $select .'<option  disabled selected></option>';
		foreach ($ListUser as $u) {
			$select = $select.'<option value="'.$u['ID'].'" > '.$u['Nom'].'</option>';
		}
		$select = $select ."</select>";

		return $select;
	}

	public function getListRselect($id){
		$this->load->model('ModeleRespModifierFiliere');
		
		$Date= $this->session->userdata('Date');
		
		$ListUser = $this->ModeleRespModifierFiliere->GetListResp($Date);	

		$select ='<select id="selectResp">';

		foreach ($ListUser as $u) {
			if($u['ID'] == $id){
				$selected = "selected";
			}else{
				$selected = "";
			}

			$select = $select.'<option '.$selected.' value="'.$u['ID'].'" > '.$u['Nom'].'</option>';
		}
		$select = $select ."</select>";
		return $select;
	}
	
	public function getListFselect($id){
	
		$this->load->model('ModeleRespModifierFiliere');
		
		$Date= $this->session->userdata('Date');

		$Date=$Date-1;
		
		$ListFiliere = $this->ModeleRespModifierFiliere->GetListFiliere($Date);	

		$select ='<select id="SelectFiliere">';

		if (is_array($ListFiliere))
		{
			foreach ($ListFiliere as $u) {
			if($u['ID'] == $id){
				$selected = "selected";
			}else{
				$selected = "";
			}

			$select = $select.'<option '.$selected.' value="'.$u['Nom'].'" > '.$u['Nom'].'</option>';
		}
		$select = $select ."</select>";

		}
		
		return $select;
	
	
	
	}

	/*public function duplicateFiliere(){

		//echo "ok ok ok ok ok";

	    $sql= "Select id_filiere 
	    	   From filiere
			   Where Nom =".$NomFiliere."";

		$id_filiere = $this->db->query($sql);

		$sql1="Select MAX(id) From Filiere";
			 
		// On récupère l'id de la filière qui viens d'être crée 
		$id_max_filiere = $this->db->query($sql);

		$sql2="Insert into matiere (`Nom`,`MaxHeuresCours`,`MaxHeuresTD`,`MaxHeuresTP`,`ID_Filiere`,`Semestre`)
			   Select `Nom`,`MaxHeuresCours`,`MaxHeuresTD`,`MaxHeuresTP`,". $id_max_filiere. "AS `ID_Filiere`,`Semestre`
			   From matiere
			   Where `ID_Filiere` = ".$id_filiere.";";



	
	}*/

	public function modifierM(){
		$this->load->model('ModeleRespModifierFiliere');
		$this->ModeleRespModifierFiliere->MM($this->input->get('id'),$this->input->get('nom'),$this->input->get('HC'),$this->input->get('HTD'),$this->input->get('HTP'),$this->input->get('semestre'));	
	

		$this->load->model('ModeleMajConflit');
		$this->ModeleMajConflit->maj($this->input->get('id'));
	}

	public function ajouterM(){

		$this->load->model('ModeleRespModifierFiliere');
		$this->ModeleRespModifierFiliere->MA($this->input->get('nom'),$this->input->get('HC'),$this->input->get('HTD'),$this->input->get('HTP'),$this->input->get('semestre'),$this->input->get('id'));	
	}

	public function supprM(){
		$this->load->model('ModeleRespModifierFiliere');
		$Info=$this->ModeleRespModifierFiliere->supprM($this->input->get('id'));
	}

	public function creerF(){
		$this->load->model('ModeleAdminModifierFiliere');
		$Info=$this->ModeleAdminModifierFiliere->creerF($this->input->get('nom'),$this->input->get('rid'),$this->session->userdata('Date'));
	} 

	public function creerF2(){
		$this->load->model('ModeleAdminModifierFiliere');
		$Info=$this->ModeleAdminModifierFiliere->creerF2($this->input->get('nom'),$this->input->get('rid'),$this->session->userdata('Date'));
	} 

	
	
	function importcsv()
	   {
	   
		$this->load->model('ModeleAdminModifierFiliere');
		$Date=$this->session->userdata('Date');
		$id = $this->input->get('id');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '10000';
 
        $this->load->library('upload', $config);
		$IdFiliere = $this->input->post('ID');
		$Matieres='';
		
		$listMatieres = $this->ModeleAdminModifierFiliere->GetMatieresNom($IdFiliere);
		
		
		// SI problème avec le fichier annuler l'import
        if (!$this->upload->do_upload()) 
		{
          
			redirect('../ControleurAdminModifierFiliere/?id='.$IdFiliere.'&error='.$this->upload->display_errors());

						
        }
		else  
		{
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
			if (($handle = fopen($file_path, 'r')) === false)
			{
					die('Error opening file');
			}
			$flag = true;
			while (($Matieres = fgetcsv($handle, 9000, ";")) !== FALSE) 
			{ 
				if($flag) {$flag = false; continue;}
				
				if(!in_array($data[0],$listMatieres))
				{			
					$this->ModeleAdminModifierFiliere->insert_csv($Matieres, $IdFiliere);
				}
				
				
			}
			
			fclose($handle);
            
			redirect('../ControleurAdminModifierFiliere/?id='.$IdFiliere.'&error=Import réalisé avec succès');
			
			
			
               
           
            }
 
        } 
}
?>
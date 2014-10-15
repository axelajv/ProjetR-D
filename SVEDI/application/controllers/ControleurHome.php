<?php 
class ControleurHome extends CI_Controller
{

	public function index()
	{
		$this->accueil();
	}

	public function accueil()
	{
		$data = array();
		
	
		$Id_user=$this->session->userdata('Id_user');
		
		$data['Nom']=$this->session->userdata('Nom');

		$this->load->model('ModeleHome');
		$data['Prefix']=$this->ModeleHome->GetPrefix($Id);
		
		$this->load->view('vueHeader');
		
		$data['Notification']=$this->RemplirInfoNotification($Id);
		$this->load->view('vueNav',$data);
		
		$data['actual']=$this->GetActualHours($Id);
		$data['todo']=$this->session->userdata('nbHeures');
		$data['Inscription']=$this->RemplirInfoInscription($Id);
		$data['Conflit']=$this->RemplirConflit($Id);
		$this->load->view('vueHomeContent',$data);
		
		$this->load->view('vueFooter');
	
	}
	
	public function RemplirInfoNotification($Id)
	{	

	//	$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id);

		return ($Info);
	}
	
	public function RemplirInfoInscription($Id)
	{	
	//	$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Inscription($Id);
		return ($Info);
	
	}

	public function GetActualHours($Id)
	{	
	//	$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->GetActualHours($Id);
		return ($Info);
	
	}
	
	public function RemplirConflit($Id)
	{	
			
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Conflit($Id);
		return ($Info);
	}
	
	public function Desinscription()
	{	
	
		
		
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->SuppInscription($this->input->get('id'));
		
		echo "Désinscription effectuée";

	

	}

/*	
	public function RefreshNav()
	{
				$this->load->view('vueHeader');
		
		$Id=$this->session->userdata('Id_user');
		$data['Notification']=$this->RemplirInfoNotification($Id);
		$this->load->view('vueNav',$data);
			
	}
*/	
	public function SuppNotif()
	{
		$this->load->model('ModeleHome');
		$this->ModeleHome->NotifSuppression($this->input->get('id'));
		
	//	$Id=$this->session->userdata('Id_user');
	//	$data['Notification']=$this->RemplirInfoNotification($Id);
	//	$this->load->view('vueNav',$data);
		
	}

	
	
	public function ExportPDF()
	 {
		$data = array();
		
	
		$Id=$this->session->userdata('Id_user');
		
		$data['Nom']=$this->session->userdata('Nom');

		$this->load->model('ModeleHome');
		$data['Prefix']=$this->ModeleHome->GetPrefix($Id);
		$data['actual']=$this->GetActualHours($Id);
		$data['todo']=$this->session->userdata('nbHeures');
		$data['Inscription']=$this->RemplirInfoInscription($Id);
		$data['Conflit']=$this->RemplirConflit($Id);
    
	    //Load the library
	    $this->load->library('html2pdf');
	    
	    //Set folder to save PDF to
	    $this->html2pdf->folder('./assets/pdfs/');
		
	    
	    //Set the filename to save/download as
	    $this->html2pdf->filename('Etat Enseignant_'.$data['Nom'].'_'.date('dMy').'.pdf');
	    
	    //Set the paper defaults
	    $this->html2pdf->paper('a4', 'portrait');
	   	    
	    //Load html view
	    $this->html2pdf->html($this->load->view('homeExportPDF', $data, true));
	    
	    if($this->html2pdf->create('download')) {
	    	//PDF was successfully saved or downloaded
	    	echo 'PDF saved';
	    }
	    
    } 
}
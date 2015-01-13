<?php 
class ControleurHome extends CI_Controller
{

	public function index()
	{
		$Date=$this->session->userdata('Date');
		$this->accueil($Date);
	}

	public function accueil($Date)
	{
		$data = array();
		
		$data['Date'] =$Date; 
		
		$Id=$this->session->userdata('Id_user');
		
		$data['Nom']=$this->session->userdata('Nom');

		$this->load->model('ModeleHome');
		$data['Prefix']=$this->ModeleHome->GetPrefix($Id);
		
		//$this->load->view('vueHeader',$dataHead);
		
		$data['Notification']=$this->RemplirInfoNotification($Id,$Date);
		$this->load->view('vueNav',$data);
		
		$data['actual']=$this->GetActualHours($Id ,$Date);
		$data['todo']=$this->session->userdata('nbHeures');
		$data['Inscription']=$this->RemplirInfoInscription($Id ,$Date);
		$data['Conflit']=$this->RemplirConflit($Id,$Date);
		$this->load->view('vueHomeContent',$data);
		
		$this->load->view('vueFooter');
	
	}
	
	public function AnneeMoins(){
	
		$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleRespInscrEns');
		$this->load->model('ModeleHome');
		$NomF=$this->ModeleRespInscrEns->GetFiliereNom($Id);
		
		$AMin=$this->ModeleHome->AnneeMin($NomF);
	
		
		$DateActuelle=$this->session->userdata('Date');
		$Date= $DateActuelle;
		
		if($AMin<=$DateActuelle - 1 ){
		
			$Date= $DateActuelle - 1 ;
			$this->session->set_userdata("Date", $Date);
		
		}
		
		$this->accueil($Date);
	}
	
	
	public function AnneePlus(){
		
		$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleRespInscrEns');
		$this->load->model('ModeleHome');
		$NomF=$this->ModeleRespInscrEns->GetFiliereNom($Id);
		
		$AMax=$this->ModeleHome->AnneeMax($NomF);
	
		
		$DateActuelle=$this->session->userdata('Date');
		$Date= $DateActuelle;
		
		if($AMax>=$DateActuelle + 1 ){
		
			$Date= $DateActuelle + 1 ;
			$this->session->set_userdata("Date", $Date);
		
		}
		
		$this->accueil($Date);
	}
	

	
	public function RemplirInfoNotification($Id,$Date)
	{	

	//	$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Notification($Id,$Date);

		return ($Info);
	}
	
	public function RemplirInfoInscription($Id ,$Date)
	{	
	//	$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Inscription($Id,$Date);
		return ($Info);
	
	}

	
	public function RemplirConflit($Id ,$Date)
	{	
			
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->Get_Conflit($Id,$Date);
		return ($Info);
	}
	
	
	public function GetActualHours($Id,$Date)
	{	
	//	$Id=$this->session->userdata('Id_user');
		$this->load->model('ModeleHome');
		$Info=$this->ModeleHome->GetActualHours($Id,$Date);
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
		
		$Date=$this->session->userdata('Date');
		
	
		$Id=$this->session->userdata('Id_user');
		
		$data['Nom']=$this->session->userdata('Nom');

		$this->load->model('ModeleHome');
		$data['Prefix']=$this->ModeleHome->GetPrefix($Id);
		$data['actual']=$this->GetActualHours($Id,$Date);
		$data['todo']=$this->session->userdata('nbHeures');
		$data['Inscription']=$this->RemplirInfoInscription($Id,$Date);
		$data['Conflit']=$this->RemplirConflit($Id,$Date);
    
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
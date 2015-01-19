<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controleurTypeUtilisateur extends CI_Controller
{

	public function loadView()
	{
		$dataHead['Key'] = $this->input->get('search');
		$data['Types']= $this->getListTypes();
		$dataHead['IsStatut'] = true;

		$this->load->view('vueHeaderAdmin',$dataHead);
		$this->load->view('vueTypeUtilisateur',$data);
		$this->load->view('vueFooter');
	
	}
		
	
	public function index()
	{	
		$this->loadView();
	}
	
	public function log(){
		$dataHead['Key'] = $this->input->get('search');
		$data['Types'] = $this->getListTypes();
		$dataHead['IsStatut'] = true;


		if($this->input->get('SM')){
			$data['Log'] = "Modification statut effectuée";
		}
		if($this->input->get('SA')){
			$data['Log'] = "Nouveau Statut crée";
		}

		$this->load->view('vueHeaderAdmin',$dataHead);
		$this->load->view('vueTypeUtilisateur',$data);
		$this->load->view('vueFooter');
	}
	
	public function getListTypes(){
		$this->load->model('ModeleTypeUtilisateur');
		$Info=$this->ModeleTypeUtilisateur->getTypes();
		return $Info;
	}
	
	public function SM()
	{
		$this->load->model('ModeleTypeUtilisateur');
		$Info=$this->ModeleTypeUtilisateur->TypesModification($this->input->get('ID'),$this->input->get('Code'),$this->input->get('Libelle'),$this->input->get('NbHeure'));
		return null;
	}

	public function SS()
	{
		$this->load->model('ModeleTypeUtilisateur');;
		$Info=$this->ModeleTypeUtilisateur->TypesSuppression($this->input->get('ID'));
		echo $Info;
	}

	public function SA()
	{
		$this->load->model('ModeleTypeUtilisateur');
		$Info=$this->ModeleTypeUtilisateur->TypesAdd($this->input->get('Code'),$this->input->get('Libelle'),$this->input->get('NbHeure'));

	 return null;
	}
	
}
?>
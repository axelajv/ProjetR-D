<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controleurAjax extends CI_Controller
{

	public function getInfoM($id){
		$this->load->model('ModeleRespInscrEns');
		$Info=$this->ModeleRespInscrEns->GetMatiereInfo($id);		

		$dispoTP = intval($Info['HTPM']-$Info['NBHTP'])."h";
		$dispoTD = intval($Info['HTDM']-$Info['NBHTD'])."h";
		$dispoC = intval($Info['HCM']-$Info['NBHC'])."h";

		if ($dispoTP <= 0) $dispoTP = "(Maximum atteint)";
		if ($dispoTD <= 0) $dispoTD = "(Maximum atteint)";
		if ($dispoC <= 0) $dispoC = "(Maximum atteint)";

		$str = '<p class="floatLeft">Nombre max d\'heures de cours :<b> '.$Info['HCM'].'h</b>
		<br/><br/>Nombre max d\'heures de TD :<b> '.$Info['HTDM'].'h</b>
		<br/><br/>Nombre max d\'heures de TP :<b> '.$Info['HTPM'].'h</b></p>';

		$str = $str.'<p><br/>Heures de cours disponibles :<b> '.$dispoC.'</b>
				<br/><br/>Heures de TD disponibles :<b> '.$dispoTD.'</b>
				<br/><br/>Heures de TP disponibles :<b> '.$dispoTP.'</b></p>';

		echo $str;
	}

	public function changeNom(){
		$nom = $this->input->get('nom');

		if($this->input->get('fid')){
			$this->load->model('ModeleRespModifierFiliere');
			$this->ModeleRespModifierFiliere->changeNom($this->input->get('fid'),$nom);	
			echo "Effectué.";
		}
		else
		{
			$this->load->model('ModeleRespModifierFiliere');
			$this->ModeleRespModifierFiliere->changeNom($this->ModeleRespModifierFiliere->GetFiliereID($this->session->userdata('Id_user')),$nom);	
			echo "Effectué.";
		}

	}


	public function changeResp(){
		$fid = $this->input->get('fid');
		$rid = $this->input->get('rid');

			$this->load->model('ModeleRespModifierFiliere');
			$this->ModeleRespModifierFiliere->changeResp($rid,$fid);	
			echo "Effectué.";
	
	}



}

?>
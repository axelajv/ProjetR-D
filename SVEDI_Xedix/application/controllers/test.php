<?php
class test extends Controller {

       function __construct()
       {
            parent::Controller();
   }
   
  public function index()
	{	
	$this->load->model('test');
	$this->load->view('test');
		}	
        
    public getInfos()
    {
       // $this->load->database();
$connect_array=array();
$serveur="http://localhost:5290" ;

   $connect_array = xedix_connect ( $serveur ) ;
   $cleSession = $connect_array[1];
   
   requete='john';
   

# On encode la requete pour la passer en argument

   $requete_url=my_encode2($requete) ;
   
    $select1='<all|0>';
    $flux = xedix_send ($connect_array[0],$serveur,$cleSession,$requete_url,$select_url) ;
        }
}
?>
<?php

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
  //  session_start();
    
	if ($_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  
 
  function index(){	
	$data['title'] = "Dashboard Home";
	$data['main'] = 'admin/admin_home';
	//$this->load->vars($data);
	$this->load->view('dashboard',$data);
  }
 
 function logout(){
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	$this->session->set_flashdata('error',"You've been logged out!");
	redirect('welcome/verify','refresh'); 	
 }
 
}
?>
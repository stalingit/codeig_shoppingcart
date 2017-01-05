<?php

class Orders extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
    session_start();
    
	if ($_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  
  
}


?>
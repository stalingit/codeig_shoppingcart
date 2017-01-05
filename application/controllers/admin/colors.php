<?php

class Colors extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
   // session_start();
		$this->load->model('MColors');
    
	if ($_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  

  function index(){
	$data['title'] = "Manage Colors";
	$data['main'] = 'admin/admin_colors_home';
	$data['colors'] = $this->MColors->getAllColors();
	//$this->load->vars($data);
	$this->load->view('dashboard',$data);  
  }
  

  
  function create(){
   	if ($this->input->post('name')){
  		$this->MColors->createColor();
  		$this->session->set_flashdata('message','Color created');
  		redirect('admin/colors/index','refresh');
  	}else{
		$data['title'] = "Create Color";
		$data['main'] = 'admin/admin_colors_create';
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('name')){
  		$this->MColors->updateColor();
  		$this->session->set_flashdata('message','Color updated');
  		redirect('admin/colors/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Color";
		$data['main'] = 'admin/admin_colors_edit';
		$data['color'] = $this->MColors->getColor($id);
		if (!count($data['color'])){
			redirect('admin/colors/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MColors->deleteColor($id);
	$this->session->set_flashdata('message','Color deleted');
	redirect('admin/colors/index','refresh');
  }

	
}//end class
?>
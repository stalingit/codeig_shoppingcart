<?php

class Categories extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MProducts');
		$this->load->model('MCats');
   // session_start();
		$this->load->helper('MY_security_helper');
    
	if ($_SESSION['userid'] < 1){
    	redirect('welcome/verify','refresh');
    }
  }
  

  function index(){
	$data['title'] = "Manage Categories";
	$data['main'] = 'admin/admin_cat_home';
	$data['categories'] = $this->MCats->getAllCategories();
	//$this->load->vars($data);
	$this->load->view('dashboard',$data);  
  }
  

  
  function create(){
   	if ($this->input->post('name')){
  		$this->MCats->addCategory();
  		$this->session->set_flashdata('message','Category created');
  		redirect('admin/categories/index','refresh');
  	}else{
		$data['title'] = "Create Category";
		$data['main'] = 'admin/admin_cat_create';
		$data['categories'] = $this->MCats->getTopCategories();
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('name')){
  		$this->MCats->updateCategory();
  		$this->session->set_flashdata('message','Category updated');
  		redirect('admin/categories/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Category";
		$data['main'] = 'admin/admin_cat_edit';
		$data['category'] = $this->MCats->getCategory($id);
		$data['categories'] = $this->MCats->getTopCategories();
		if (!count($data['category'])){
			redirect('admin/categories/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MCats->deleteCategory($id);
	$orphans = $this->MCats->checkOrphans($id);
	echo "<pre>";
	print_r($orphans);
	if (count($orphans)){
		$this->session->set_userdata('orphans',$orphans);
		redirect('admin/categories/reassign/'.$id,'refresh');	
	}else{
		$this->session->set_flashdata('message','Category deleted');
		redirect('admin/categories/index','refresh');
	}
  }

  function export(){
  	$this->load->helper('download');
  	$csv = $this->MCats->exportCsv();
  	$name = "category_export.csv";
  	force_download($name,$csv);

  }

	function reassign($id=0){
		if ($_POST){
			$this->MProducts->reassignProducts();
			$this->session->set_flashdata('message','Category deleted and products reassigned');
			redirect('admin/categories/index','refresh');
		}else{
			//$id = $this->uri->segment(4);
			$data['category'] = $this->MCats->getCategory($id);
			$data['title'] = "Reassign Products";
			$data['main'] = 'admin/admin_cat_reassign';
			$data['categories'] = $this->MCats->getCategoriesDropDown();
			$this->load->vars($data);
			$this->load->view('dashboard');    	
		}	
	}

	
}//end class
?>
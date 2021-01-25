<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inventory extends MX_Controller {
	 
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/admin_model');
	}
	
	public function index($page='')
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		
		if(empty($adminSession))
		{
			redirect('admin');
		}
		else if(!in_array('6',$admin_roles))
		{
			redirect('admin/dashboard');
		}
		else
		{
			$template = "admin";
			$record['title'] = 'Inventory';
			$record['inventorylist'] = $this->admin_model->getproductinventory();
			$record['viewFile'] = "inventorylist";
			$record['module'] = "inventory";
			echo modules::run('template/'.$template,$record);
		}
	}
}
?>
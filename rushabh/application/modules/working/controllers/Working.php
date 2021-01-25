<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Working extends MX_Controller {
	 
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/admin_model');
		$this->load->helper('url');
    }

    public function index($page='')
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		
		if(empty($adminSession))
		{
			redirect(base_url().'admin');
		}
		else if(!in_array('1',$admin_roles))
		{
			redirect(base_url().'admin/dashboard');
		}
		else
		{
			$template = "admin";
         	$record['title'] = 'Working';
			$record['s_list'] = $this->admin_model->getWhere('sites',array('site_working'=>'1'));
			$record['viewFile'] = "working";
			$record['module'] = "working";
			echo modules::run('template/'.$template,$record);
		}
    }
}
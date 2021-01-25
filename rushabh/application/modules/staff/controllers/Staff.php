<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Staff extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('stafflogin/Staff_model');

	}
	public function index()
	{

		$staffSession = $this->session->userdata('userid');
		if(!empty($staffSession) || $this->session->userdata('staffStatus')=='1')
		{
			redirect(base_url().'staff/dashboard');
		}
		else{

			redirect(base_url().'stafflogin');
		}
	}

	public function dashboard()
	{
		$staffSession = $this->session->userdata('userid');
		if(empty($staffSession) || $this->session->userdata('staffStatus')=='2')
		{
			redirect(base_url().'supervisorlogin');
		}
		else
		{
			$template = "staff";
			$record['title'] = 'Staff - Dashboard';
			$record['viewFile'] = "dashboard";
			$record['module'] = "staff";
			echo modules::run('template/'.$template,$record);
		}
	}

}
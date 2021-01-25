<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Supervisorlogin extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Supervisor_model');

	}
	public function index()
	{

		if($this->input->post('isAjax')=='1')
		{
			$this->form_validation->set_rules("username","Username","trim|required");
			$this->form_validation->set_rules("userpassword","Password","trim|required");
			if($this->form_validation->run()==FALSE):
				echo json_encode($this->form_validation->error_array());exit;
			else:
				$record = $this->input->post();

				$conditionArray = array('sup_mobile'=>strtolower($record['username']),'sup_password'=>$record['userpassword']);
				$logindata = $this->Supervisor_model->getWhere('supervisor',$conditionArray);

				if(!empty($logindata) && is_array($logindata)):
					$supervisorSession = array(
                        'isSupervisor' => 1,
                        'userid' => $logindata[0]->sup_id,
                        'supervisorStatus'=> $logindata[0]->sup_status,
                        'supervisorName'=>strtolower($logindata[0]->sup_name),
                        'supervisorRole'=>$logindata[0]->sup_role
					);
					$this->session->set_userdata($supervisorSession);
					echo 1;
				else:
					echo 2;
				endif;
			endif;
		}
		else
		{
			$supervisorSession = $this->session->userdata('userid');
			if(!empty($supervisorSession)|| $this->session->userdata('supervisorStatus')=='2')
			{
				redirect(base_url().'supervisor/dashboard');
			}
			else
			{

				$template = "supervisor"; //Template Controller function name
				$record['title'] = 'Supervisor - login';
				$record['viewFile'] = "supervisorlogin"; //Site controller's view file
				$record['module'] = "supervisorlogin"; //controller name
				echo modules::run('template/'.$template ,$record);
			}
		}
	}

	public function logout()
	{
		$isSupervisor = $this->session->userdata('isSupervisor');
		if(!empty($isSupervisor))
		{
			$supervisorSession = array('isSupervisor','userid','supervisorStatus','supervisorName','supervisorRole');
			$this->session->unset_userdata($supervisorSession);
			redirect(base_url().'supervisorlogin');
		}
		else
		{
			redirect(base_url().'supervisor/dashboard');
		}
	}

	public function changepassword()
	{
		$supervisorSession = $this->session->userdata('userid');
		if(empty($supervisorSession) || $this->session->userdata('adminStatus')=='2')
		{
			redirect('admin');
		}
		else
		{
			if($this->input->post('isAjax')=='1'):

				$this->form_validation->set_rules('opass','Old password','trim|required|xss_clean');
				$this->form_validation->set_rules('npass','New Password','trim|required|xss_clean');
				$this->form_validation->set_rules('cpass','Confirm Password','trim|required|matches[npass]|xss_clean');

				$this->form_validation->set_message('matches', 'New password and Confirm password dosent match');
				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					$username = $this->session->userdata('adminName');

					$record = $this->input->post();
					$opass = sha1($record['opass']);

					$npass = sha1($record['npass']);

					$user_details = $this->admin_model->getWhere('adminmaster',array('admin_name'=>$username,'admin_password'=>$opass));

					if(is_array($user_details)):
						$update_data = array('admin_password'=>$npass,'updated_date'=>date('Y-m-d h:i:s'));

						$this->db->update("adminmaster",$update_data,array('admin_name'=>$username));

						$data['result'] = 'success';
						$json = json_encode($data);
						echo $json;
					else:
						$data['result'] = 'fail';
						$json = json_encode($data);
						echo $json;
					endif;
				endif;
			else:

				$template = "admin";
				$record['title'] = 'Change Password';
				$record['viewFile'] = "changepassword";
				$record['module'] = "admin";
				echo modules::run('template/'.$template,$record);
			endif;
		}
	}
}
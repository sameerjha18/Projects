<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stafflogin extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('staff_model');

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

				$conditionArray = array('s_mobile'=>strtolower($record['username']),'s_password'=>$record['userpassword']);
				$logindata = $this->Staff_model->getWhere('staff',$conditionArray);

				if(!empty($logindata) && is_array($logindata)):
					$staffSession = array(
                        'isAdmin' => 1,
                        'userid' => $logindata[0]->s_id,
                        'staffStatus'=> $logindata[0]->s_status,
                        'staffName'=>strtolower($logindata[0]->s_name),
                        'staffRole'=>$logindata[0]->s_role
					);
					$this->session->set_userdata($staffSession);
					echo 1;
				else:
					echo 2;
				endif;
			endif;
		}
		else
		{
			$staffSession = $this->session->userdata('userid');
			if(!empty($staffSession)|| $this->session->userdata('staffStatus')=='2')
			{
				redirect(base_url().'staff/dashboard');
			}
			else
			{

				$template = "staff"; //Template Controller function name
				$record['title'] = 'Staff - login';
				$record['viewFile'] = "login"; //Site controller's view file
				$record['module'] = "stafflogin"; //controller name
				echo modules::run('template/'.$template ,$record);
			}
		}
	}

	// public function dashboard()
	// {
	// 	$staffSession = $this->session->userdata('userid');
	// 	if(empty($staffSession) || $this->session->userdata('staffStatus')=='2')
	// 	{
	// 		redirect(base_url().'stafflogin');
	// 	}
	// 	else
	// 	{
	// 		$template = "staff";
	// 		$record['title'] = 'staff - Dashboard';
	// 		$record['viewFile'] = "dashboard";
	// 		$record['module'] = "stafflogin";
	// 		echo modules::run('template/'.$template,$record);
	// 	}
	// }

	public function forgotpassword()
	{
		$adminSession = $this->session->userdata('userid');
		if(!empty($adminSession) || $this->session->userdata('adminStatus')=='2')
		{
			redirect(base_url().'admin/dashboard');
		}
		else
		{
			if($this->input->post('isAjax')=='1'):

				$this->form_validation->set_rules('email','Email','trim|required|xss_clean|valid_email');
				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					$details = $this->input->post();
					$conditionArray = array('admin_email'=>$details['email']);
					$user_detail = $this->admin_model->getWhere('adminmaster',$conditionArray);
					if(is_array($user_detail)):


						$userinsert['name'] = $user_detail[0]->admin_fullname;
						$userinsert['email'] = $user_detail[0]->admin_email;
						$userinsert['username'] = $user_detail[0]->admin_name;
						$userinsert['link'] = base_url();
						$userinsert['password'] =  mt_rand(100000, 999999);
						$data['userinsert'] = $userinsert;
						$message=$this->load->view('forgotpassword_email',$data,TRUE);

						$this->email->from('contact@drishyasolutions.com', 'Drishya Solutions');
						$this->email->to($userinsert['email']);
						$this->email->subject('Password is being Reset by your Development Team Drishya solutions');
						$this->email->set_mailtype("html");
						$this->email->message($message);
						if($this->email->send())
						{


							$data = array(
								'admin_password'=> sha1($userinsert['password']),
								'updated_date'=>date('y-m-d h:i:s'),
							);

							$this->db->update("adminmaster",$data,array('admin_email'=>$userinsert['email']));


							$data['result'] = 'success';

							$json = json_encode($data);

							print_r($json);
						}
						else
						{
							$data['result'] = 'fail';

							$json = json_encode($data);

							print_r($json);
						}
					else:

						$data['result'] = 'fail';

						$json = json_encode($data);
						print_r($json);
					endif;
				endif;
			else:
				$template = "admin";
				$record['viewFile'] = "recover_password";
				$record['title'] = "Admin Panel";
				$record['module'] = "admin";
				echo modules::run('template/'.$template,$record);
			endif;
		}
	}

	public function logout()
	{
		$isAdmin = $this->session->userdata('isAdmin');
		if(!empty($isAdmin))
		{
			$adminSession = array('isAdmin','userid','adminStatus','adminName','adminRole');
			$this->session->unset_userdata($adminSession);
			redirect(base_url());
		}
		else
		{
			redirect(base_url().'admin/dashboard');
		}
	}

	public function changepassword()
	{
		$adminSession = $this->session->userdata('userid');
		if(empty($adminSession) || $this->session->userdata('adminStatus')=='2')
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
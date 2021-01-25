<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Staffmanagement extends MX_Controller {
	 
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
			$record['title'] = 'Staff Management';
			$id = "s_id";
			$record['st_list'] = $this->admin_model->getallRec('staff',$id);
			$record['viewFile'] = "stafflist";
			$record['module'] = "staffmanagement";
			echo modules::run('template/'.$template,$record);
		}
	}
	
	public function update_staff($id)
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
			if($this->input->post('isAjax')=='1'):
				$this->form_validation->set_rules('sname','Staff name','trim|required|xss_clean');
				$this->form_validation->set_rules('saddress','Staff address','trim|required|xss_clean');
				$this->form_validation->set_rules('smobile','Staff mobile','trim|required|numeric|xss_clean');
				$this->form_validation->set_rules('salt','Staff alternate mobile','trim|numeric|xss_clean');
				$this->form_validation->set_rules('email','Staff email','trim|required|valid_email|xss_clean');
				$this->form_validation->set_rules('status','Status','trim|required|xss_clean');
				$this->form_validation->set_message('numeric', 'Mobile number should be numeric');

				$this->form_validation->set_message('numeric', 'Mobile number should be numeric');
				
				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					$record = $this->input->post();
					
					//check if rich customer exist or not
					$conditionArray = array('s_id'=>$id);
					$user_detail = $this->admin_model->getWhere('staff',$conditionArray);
					
					if(@$user_detail[0]->s_id=='')
					{
						echo 3;exit;
					}
					else
					{
						$data = array(
						's_name' => $record['sname'],
						's_address'=>$record['saddress'],
						's_mobile'=>$record['smobile'],
						's_alt'=>$record['salt'],
						's_email'=>$record['email'],
						's_status' => $record['status'],
						's_modifiedDate'=>date('y-m-d h:i:s'),
						);
						
						$this->db->update("staff",$data,array('s_id'=>@$id));
						$this->session->set_flashdata('Staffmsg',$data['s_name'].' details updated Successfully!!!');
					
						echo 1;exit;
					}
				endif;
			else:
				
				$staff = $this->admin_model->getWhere('staff',array('s_id'=>$id));
				if(is_array($staff)):
					$data = $staff[0];
					$data->result = 'success';
					$json = json_encode($data);
					echo $json;
					exit;
				else: 
					redirect(base_url().'staffmanagement');
				endif;
			endif;
		}
	}
	
	public function add_staff()
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
			if($this->input->post('isAjax')=='1'):
				$record = $this->input->post();

				$this->form_validation->set_rules('sname','Staff name','trim|required|xss_clean');
				$this->form_validation->set_rules('saddress','Staff address','trim|required|xss_clean');
				$this->form_validation->set_rules('smobile','Staff mobile','trim|required|numeric|xss_clean');
				$this->form_validation->set_rules('salt','Staff alternate mobile','trim|numeric|xss_clean');
				$this->form_validation->set_rules('email','Staff email','trim|required|valid_email|xss_clean');
				$this->form_validation->set_rules('status','Status','trim|required|xss_clean');
				$this->form_validation->set_message('numeric', 'Mobile number should be numeric');

				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					$data = array(
						's_name' => $record['sname'],
						's_address'=>$record['saddress'],
						's_mobile'=>$record['smobile'],
						's_alt'=>$record['salt'],
						's_email'=>$record['email'],
						's_password'=>sha1('123456'),
						's_role'=>'1,2,3,4,5,6,7,8,9,10',
						's_status' => $record['status'],
						's_modifiedDate'=>date('y-m-d h:i:s'),
						's_createdDate'=>date('y-m-d h:i:s')
					);
					$res = $this->db->insert('staff',$data);
					if($res){
						echo 1;
						$this->session->set_flashdata('Staffmsg',$data['s_name'].' details added Successfully!!!');
						exit;
					}
					else{
						echo 2;exit;
					}
				endif;
			else:
				redirect(base_url().'staffmanagement');
			endif;
		}
	}
}
?>
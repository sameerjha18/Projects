<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Supervisormanagement extends MX_Controller {
	 
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
			$record['title'] = 'Supervisor Management';
			$id = "sup_id";
			$record['s_list'] = $this->admin_model->getallRec('supervisor',$id);
			$record['viewFile'] = "supervisor";
			$record['module'] = "supervisormanagement";
			echo modules::run('template/'.$template,$record);
		}
	}
	
	public function update_supervisor($id)
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

				
				$this->form_validation->set_rules('supname','Supervisor name','trim|required|xss_clean');
				$this->form_validation->set_rules('supaddress','Supervisor address','trim|required|xss_clean');
				$this->form_validation->set_rules('supmobile','Supervisor mobile','trim|required|numeric|xss_clean');
				$this->form_validation->set_rules('supalt','Supervisor alternate mobile','trim|numeric|xss_clean');
				$this->form_validation->set_rules('supemail','Supervisor email','trim|required|valid_email|xss_clean');
				$this->form_validation->set_rules('supstatus','Supervisor','trim|required|xss_clean');
				$this->form_validation->set_message('numeric', 'Mobile number should be numeric');

				$this->form_validation->set_message('numeric', 'Mobile number should be numeric');
				
				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					
					
					//check if rich customer exist or not
					$conditionArray = array('sup_id'=>$id);
					$user_detail = $this->admin_model->getWhere('supervisor',$conditionArray);
					
					if(@$user_detail[0]->sup_id=='')
					{
						echo 3;exit;
					}
					else
					{
						$data = array(
						'sup_name' => $record['supname'],
						'sup_address'=>$record['supaddress'],
						'sup_mobile'=>$record['supmobile'],
						'sup_alt'=>$record['supalt'],
						'sup_email'=>$record['supemail'],
						'sup_status' => $record['supstatus'],
						'sup_modifiedDate'=>date('y-m-d h:i:s'),
						);
						
						$this->db->update("supervisor",$data,array('sup_id'=>@$id));
						$this->session->set_flashdata('Supervisormsg',$data['sup_name'].' details updated Successfully!!!');
					
						echo 1;exit;
					}
				endif;
			else:
				
				$supervisor = $this->admin_model->getWhere('supervisor',array('sup_id'=>$id));
				if(is_array($supervisor)):
					$data = $supervisor[0];
					$data->result = 'success';
					$json = json_encode($data);
					echo $json;
					exit;
				else: 
					redirect(base_url().'supervisormanagement');
				endif;
			endif;
		}
	}
	
	public function add_supervisor()
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
				// print_r($record);
				// exit;
				$this->form_validation->set_rules('supname','Supervisor name','trim|required|xss_clean');
				$this->form_validation->set_rules('supaddress','Supervisor address','trim|required|xss_clean');
				$this->form_validation->set_rules('supmobile','Supervisor mobile','trim|required|numeric|xss_clean');
				$this->form_validation->set_rules('supalt','Supervisor alternate mobile','trim|numeric|xss_clean');
				$this->form_validation->set_rules('supemail','Supervisor email','trim|required|valid_email|xss_clean');
				$this->form_validation->set_rules('supstatus','Status','trim|required|xss_clean');
				$this->form_validation->set_message('numeric', 'Mobile number should be numeric');

				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					$data = array(
						'sup_name' => $record['supname'],
						'sup_address'=>$record['supaddress'],
						'sup_mobile'=>$record['supmobile'],
						'sup_alt'=>$record['supalt'],
						'sup_email'=>$record['supemail'],
						'sup_password'=>sha1('123456'),
						'sup_role'=>'1,2,3,4,5,6,7,8,9,10',
						'sup_status' => $record['supstatus'],
						'sup_modifiedDate'=>date('y-m-d h:i:s'),
						'sup_createdDate'=>date('y-m-d h:i:s')
					);
					// print_r($data);
					// exit;
					$res = $this->db->insert('supervisor',$data);
					if($res){
						echo 1;
						$this->session->set_flashdata('Supervisormsg',$data['sup_name'].' details added Successfully!!!');
						exit;
					}
					else{
						echo 2;exit;
					}
				endif;
			else:
				redirect(base_url().'supervisormanagement');
			endif;
		}
	}
}
?>
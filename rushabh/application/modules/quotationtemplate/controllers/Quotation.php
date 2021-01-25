<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Quotationtemplate extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/admin_model');
		$this->load->helper('url');
	}

	public function index($page = '')
	{
		$admin_roles = explode(',', $this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');

		if (empty($adminSession)) 
		{
			redirect(base_url() . 'admin');
		} 
		else if (!in_array('1', $admin_roles)) {
			redirect(base_url() . 'admin/dashboard');
		} 
		else 
		{

		}
	}

	public function update_quotetemplate($id)
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
                    
                $this->form_validation->set_rules('temp_name', 'Template Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('desc', 'Template Description', 'trim|xss_clean');
                
                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:

                    //check if rich customer exist or not
                    $conditionArray = array('temp_id'=>$id);
                    $user_detail = $this->admin_model->getWhere('template',$conditionArray);
                    
                    if(@$user_detail[0]->temp_id=='')
                    {
                        echo 3;exit;
                    }
                    else
                    {
                       $data = array(
						'temp_name' => $record['temp_name'],						
						'temp_desc' => $record['desc'],
						'temp_status' => 1,
					);
                        $this->db->update("template",$data,array('temp_id'=>@$id));
                        $this->session->set_flashdata('productsuppliermsg',$data['temp_name'].' Template details updated Successfully!!!');
                    
                        echo 1;exit;
                    }
                endif;
            else:
                $t_details = $this->admin_model->getWhere('template',array('temp_id'=>$id));
                    if(is_array($t_details)):
                        $data = $t_details[0];
                        $data->result = 'success';
                        $json = json_encode($data);
                        echo $json;
                        exit;
                    else: 
                        redirect(base_url().'quotationtemplate/template');
                    endif;
            endif;
        }
    }

	public function template()
	{
		$admin_roles = explode(',', $this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');

		if (empty($adminSession)) {
			redirect(base_url() . 'admin');
		} else if (!in_array('1', $admin_roles)) {
			redirect(base_url() . 'admin/dashboard');
		} else {
			$template = "admin";
			$record['temp_list'] = $this->admin_model->getWhere('template',array('temp_status'=>'1'));
			$record['title'] = 'Quote management';
			$record['viewFile'] = "quote_template";			
			$record['module'] = "quotationtemplate";
			echo modules::run('template/' . $template, $record);
		}
	}

	public function add_template()
	{

		$admin_roles = explode(',', $this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		if (empty($adminSession)) {
			redirect(base_url() . 'admin');
		} else if (!in_array('1', $admin_roles)) {
			redirect(base_url() . 'admin/dashboard');
		} else {
			if ($this->input->post('isAjax') == '1') :
				$record = $this->input->post();

				$this->form_validation->set_rules('temp_name', 'Template Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('desc', 'Template Description', 'trim|xss_clean');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :
					$data = array(
						'temp_name' => $record['temp_name'],						
						'temp_desc' => $record['desc'],
						'temp_status' => 1,
					);
					$res = $this->db->insert('template', $data);
					if ($res) {
						echo 1;
						exit;
					} else {
						echo 2;
						exit;
					}
				endif;
			else :
				$template = "admin";
				$record['title'] = 'Quote management';
				$record['viewFile'] = "quote_template";
				$record['module'] = "quotationtemplate";
				echo modules::run('template/' . $template, $record);
			endif;
		}
	}

}

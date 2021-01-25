<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dimension extends MX_Controller {
	 
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
			$record['title'] = 'Dimension Management';
			$id = "d_id";
			$record['d_list'] = $this->admin_model->getallRec('dimension',$id);
			$record['viewFile'] = "dimension";
			$record['module'] = "dimension";
			echo modules::run('template/'.$template,$record);
		}
    }

    public function add_dimension()
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
                
				$this->form_validation->set_rules('dimension','dimension','trim|required');
				$this->form_validation->set_rules('status','Status','trim|required');

				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					$data = array(
						'd_size' => $record['dimension'],
                        'd_status' => $record['status'],
                        'd_modifiedDate'=>date('y-m-d h:i:s'),
						'd_createdDate'=>date('y-m-d h:i:s')
					);
					$res = $this->db->insert('dimension',$data);
					if($res){
						echo 1;
						$this->session->set_flashdata('dimensionmsg',$data['d_size'].' details added Successfully!!!');
						exit;
					}
					else{
						echo 2;exit;
					}
				endif;
			else:
				$template = "admin";
				$record['title'] = 'Dimension Management';
				$record['viewFile'] = "dimension";
				$record['module'] = "dimension";
				echo modules::run('template/'.$template,$record);
			endif;
		}
    }
    
    public function update_dimension($id)
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
                    // exit();
                    $this->form_validation->set_rules('dimension','Dimension name','trim|required');
                    $this->form_validation->set_rules('status','Status','trim|required');
                
                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:

                    //check if rich customer exist or not
                    $conditionArray = array('d_id'=>$id);
                    $user_detail = $this->admin_model->getWhere('dimension',$conditionArray);
                    
                    if(@$user_detail[0]->d_id=='')
                    {
                        echo 3;exit;
                    }
                    else
                    {
                       $data = array(
                        'd_size' => $record['dimension'],
                        'd_status' => $record['status'],
                        'd_modifiedDate'=>date('y-m-d h:i:s'),
                    );
                        $this->db->update("dimension",$data,array('d_id'=>@$id));
                        $this->session->set_flashdata('dimensionmsg',$data['d_size'].' details updated Successfully!!!');
                    
                        echo 1;exit;
                    }
                endif;
            else:
                $dimension = $this->admin_model->getWhere('dimension',array('d_id'=>$id));
                if(is_array($dimension)):
                    $data = $dimension[0];
                    $data->result = 'success';
                    $json = json_encode($data);
                    echo $json;
                    exit;
                else: 
                    redirect(base_url().'dimension');
                endif;
            endif;
        }
    }
}

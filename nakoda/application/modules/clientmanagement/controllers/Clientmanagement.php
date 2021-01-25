<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clientmanagement extends MX_Controller {
	 
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
            $record['title'] = 'client Management';
            $id = "client_id";
			$record['st_list'] = $this->admin_model->getallRec('client',$id);
			$record['viewFile'] = "clientlist";
			$record['module'] = "clientmanagement";
			echo modules::run('template/'.$template,$record);
		}
    }
    
    public function add_client()
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
//                print_r($record);
//                exit;
				$this->form_validation->set_rules('cname','client name','trim|required');
				$this->form_validation->set_rules('caddress1','client address','trim|required');
                $this->form_validation->set_rules('caddress2','client address','trim|required');
                $this->form_validation->set_rules('caddress3','client address','trim|required');
                $this->form_validation->set_rules('cstate','client state','trim|required');
                $this->form_validation->set_rules('ccity','client city','trim|required');
                $this->form_validation->set_rules('cpincode','client pincode','trim|required');
                $this->form_validation->set_rules('ccountry','client Country','trim|required');
				$this->form_validation->set_rules('cmobile','client mobile','trim|required|numeric');
                $this->form_validation->set_rules('caltmobile','client mobile','trim|required|numeric');
				$this->form_validation->set_rules('cemail','Client email','trim|required|valid_email|required');
				$this->form_validation->set_rules('status','Status','trim|required');
				$this->form_validation->set_message('numeric', 'Mobile number should be numeric');

				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					$data = array(
						'c_name' => $record['cname'],
						'c_address1'=>$record['caddress1'],
                        'c_address2'=>$record['caddress2'],
                        'c_address3'=>$record['caddress3'],
                        'c_state'=>$record['cstate'],
                        'c_city'=>$record['ccity'],
                        'c_pincode'=>$record['cpincode'],
                        'c_country'=>$record['ccountry'],
						'c_mobile'=>$record['cmobile'],
						'c_alt'=>$record['caltmobile'],
						'c_email'=>$record['cemail'],
						'c_status' => $record['status'],
						'c_modifiedDate'=>date('y-m-d h:i:s'),
						'c_createdDate'=>date('y-m-d h:i:s')
					);
					$res = $this->db->insert('client',$data);
					if($res){
						echo 1;
						$this->session->set_flashdata('clientmsg',$data['c_name'].' staff details added Successfully!!!');
						exit;
					}
					else{
						echo 2;exit;
					}
				endif;
			else:
				$template = "admin";
				$record['title'] = 'client Management';
				// $record['staff'] = $this->admin_model->getWhere('staff',array('s_status'=>'0'));
				$record['viewFile'] = "add_client";
				$record['module'] = "clientmanagement";
				echo modules::run('template/'.$template,$record);
			endif;
		}
	}

    public function update_client($id)
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
                $this->form_validation->set_rules('uname','client name','trim|required');
				$this->form_validation->set_rules('uaddress1','client address','trim|required');
                $this->form_validation->set_rules('uaddress2','client address','trim|required');
                $this->form_validation->set_rules('uaddress3','client address','trim|required');
                $this->form_validation->set_rules('ustate','client state','trim|required');
                $this->form_validation->set_rules('ucity','client city','trim|required');
                $this->form_validation->set_rules('upincode','client pincode','trim|required');
                $this->form_validation->set_rules('ucountry','client Country','trim|required');
				$this->form_validation->set_rules('umobile','client mobile','trim|required|numeric');
                $this->form_validation->set_rules('ualtmobile','client mobile','trim|required|numeric');
                $this->form_validation->set_rules('uemail','Staff email','trim|required|valid_email|required');
                $this->form_validation->set_rules('ustatus','Status','trim|required');
                $this->form_validation->set_message('numeric', 'Mobile number should be numeric');

                $this->form_validation->set_message('numeric', 'Mobile number should be numeric');

                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:
                    $record = $this->input->post();
//                    print_r($record);
//                    exit();
                    //check if rich customer exist or not
                    $conditionArray = array('client_id'=>$id);
                    $user_detail = $this->admin_model->getWhere('client',$conditionArray);

                    if(@$user_detail[0]->client_id=='')
                    {
                        echo 3;exit;
                    }
                    else
                    {
                        $data = array(
                            'c_name' => $record['uname'],
                            'c_address1'=>$record['uaddress1'],
                            'c_address2'=>$record['uaddress2'],
                            'c_address3'=>$record['uaddress3'],
                            'c_state'=>$record['ustate'],
                            'c_city'=>$record['ucity'],
                            'c_pincode'=>$record['upincode'],
                            'c_country'=>$record['ucountry'],
                            'c_mobile'=>$record['umobile'],
                            'c_alt'=>$record['ualtmobile'],
                            'c_email'=>$record['uemail'],
                            'c_status' => $record['ustatus'],
                            'c_modifiedDate'=>date('y-m-d h:i:s'),
                        );

                        $this->db->update("client",$data,array('client_id'=>@$id));
                        $this->session->set_flashdata('clientmsg',$data['c_name'].' staff details updated Successfully!!!');

                        echo 1;exit;
                    }
                endif;
            else:
                $template = "admin";
                $record['title'] = 'Update Category';
                $record['category'] = $this->admin_model->getWhere('client',array('client_id'=>$id));

                if(is_array($record['category'])):

                    $record['viewFile'] = "update_client";
                    $record['module'] = "clientmanagement";
                    echo modules::run('template/'.$template,$record);
                else:
                    redirect(base_url().'category');
                endif;
            endif;
        }
    }

    public function add_clientcontact($id)
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
             
                $this->form_validation->set_rules('ccname','Client Contact name','trim|required');
                $this->form_validation->set_rules('ccmobile','Client Contact mobile','trim|required|numeric');
                $this->form_validation->set_rules('ccemail','Client Contact email','trim|required|valid_email|required');
                $this->form_validation->set_rules('ccdesignation','Client Contact designation','trim|required');
                $this->form_validation->set_rules('ccstatus','Status','trim|required');
                $this->form_validation->set_message('numeric', 'Mobile number should be numeric');

                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:
                    $data = array(
                        'cc_name' => $record['ccname'],
                        'client_id'=>$id,
                        'cc_mobile'=>$record['ccmobile'],
                        'cc_email'=>$record['ccemail'],
                        'cc_designation'=>$record['ccdesignation'],
                        'cc_status' => $record['ccstatus'],
                        'cc_modifiedDate'=>date('y-m-d h:i:s'),
                        'cc_createdDate'=>date('y-m-d h:i:s')
                    );

                    $res = $this->db->insert('clientcontact',$data,array('client_id' => $id ));
//                    echo $this->db->lastquery();
                    if($res){
                        echo 1;
                        $this->session->set_flashdata('clientcontactmsg',$data['cc_name'].' client contact details added Successfully!!!');
                        exit;
                    }
                    else{
                        echo 2;exit;
                    }
                endif;
            else:
                $designation = $this->admin_model->getWhere('client',array('client_id'=>$id));
                $template = "admin";
                $record['title'] = 'Client Management';
                $record['viewFile'] = "clientcontact";
                $record['module'] = "clientmanagement";
                echo modules::run('template/'.$template,$record);
            endif;

        }
    }

    public function clientcontact($id)
    {
//		$admin_roles = explode(',',$this->session->userdata('adminRole'));
        $adminSession = $this->session->userdata('userid');

        if(empty($adminSession))
        {
            redirect(base_url().'admin');
        }
		/*else if(!in_array('1',$admin_roles))
		{
			redirect(base_url().'admin/dashboard');
		}*/
        else
        {
            $client = $this->admin_model->getWhere('client',array('client_id' =>$id ));
           
            if(is_array($client)):
               
                $template = "admin";

                $record['title'] = 'client Management';
                $record['cc_list'] =$this->admin_model->getWhere('clientcontact',array('client_id' =>$id));
                $record['id'] =$client[0]->client_id;
                $record['viewFile'] = "clientcontact";
                $record['module'] = "clientmanagement";
                echo modules::run('template/'.$template,$record);
            else:
                redirect(base_url().'admin/clientmanagement');
            endif;
        }
    }

        public function update_clientcontact($id)
        {

//      $admin_roles = explode(',',$this->session->userdata('adminRole'));
        $adminSession = $this->session->userdata('userid');
        if(empty($adminSession))
        {
            redirect(base_url().'admin');
        }
//      else if(!in_array('1',$admin_roles))
//      {
//          redirect(base_url().'admin/dashboard');
//      }
        else
        {
            
            if($this->input->post('isAjax')=='1'):
                $record = $this->input->post();
                    // print_r($record);
                    // exit();
                $this->form_validation->set_rules('uccname','Client Contact name','trim|required');
                $this->form_validation->set_rules('uccmobile','Client Contact mobile','trim|required|numeric');
                $this->form_validation->set_rules('uccemail','Client Contact email','trim|required|valid_email|required');
                $this->form_validation->set_rules('uccdesignation','Client Contact designation','trim|required');
                $this->form_validation->set_rules('uccstatus','Status','trim|required');
                $this->form_validation->set_message('numeric', 'Mobile number should be numeric');
                
                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:

                    //check if rich customer exist or not
                    $conditionArray = array('client_id'=>$id);
                    $user_detail = $this->admin_model->getWhere('clientcontact',$conditionArray);
                    
                    if(@$user_detail[0]->client_id=='')
                    {
                        echo 3;exit;
                    }
                    else
                    {
                       $data = array(
                        'cc_name' => $record['uccname'],
                        'client_id'=>$id,
                        'cc_mobile'=>$record['uccmobile'],
                        'cc_email'=>$record['uccemail'],
                        'cc_designation'=>$record['uccdesignation'],
                        'cc_status' => $record['uccstatus'],
                        'cc_modifiedDate'=>date('y-m-d h:i:s'),
                        'cc_createdDate'=>date('y-m-d h:i:s')
                    );
                        $this->db->update("clientcontact",$data,array('client_id'=>@$id));
                        $this->session->set_flashdata('Staffmsg',$data['cc_name'].' staff details updated Successfully!!!');
                    
                        echo 1;exit;
                    }
                endif;
            else:
                $staff = $this->admin_model->getWhere('clientcontact',array('cc_id'=>$id));
                if(is_array($staff)):
                    $data = $staff[0];
                    $data->result = 'success';
                    $json = json_encode($data);
                    echo $json;
                    exit;
                else: 
                    redirect(base_url().'clientmanagement');
                endif;
            endif;
        }
    }
}
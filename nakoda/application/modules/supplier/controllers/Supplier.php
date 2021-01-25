<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Supplier extends MX_Controller {
	 
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
            $record['title'] = 'Supplier Management';
            $id = "sp_id";
			$record['sp_list'] = $this->admin_model->getallRec('supplier',$id);
			$record['viewFile'] = "supplierlist";
			$record['module'] = "supplier";
			echo modules::run('template/'.$template,$record);
		}
    }
    
    public function add_supplier()
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
            //    print_r($record);
            //    exit;
				$this->form_validation->set_rules('sname','Supplier name','trim|required');
				$this->form_validation->set_rules('saddress1','Supplier address','trim|required');
                $this->form_validation->set_rules('saddress2','Supplier address','trim|required');
                $this->form_validation->set_rules('saddress3','Supplier address','trim|required');
                $this->form_validation->set_rules('state','Supplier state','trim|required');
                $this->form_validation->set_rules('scity','Supplier city','trim|required');
                $this->form_validation->set_rules('spincode','Supplier pincode','trim|required');
                $this->form_validation->set_rules('scountry','Supplier Country','trim|required');
				$this->form_validation->set_rules('smobile','Supplier mobile','trim|required|numeric');
                $this->form_validation->set_rules('saltmobile','Supplier mobile','trim|required|numeric');
				$this->form_validation->set_rules('semail','Supplier email','trim|required|valid_email|required');
				$this->form_validation->set_rules('status','Status','trim|required');
				$this->form_validation->set_message('numeric', 'Mobile number should be numeric');

				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					$data = array(
						'sp_name' => $record['sname'],
						'sp_address1'=>$record['saddress1'],
                        'sp_address2'=>$record['saddress2'],
                        'sp_address3'=>$record['saddress3'],
                        'state_id'=>$record['state'],
                        'sp_city'=>$record['scity'],
                        'sp_pincode'=>$record['spincode'],
                        'sp_country'=>$record['scountry'],
						'sp_mobile'=>$record['smobile'],
						'sp_alt'=>$record['saltmobile'],
						'sp_email'=>$record['semail'],
						'sp_status' => $record['status'],
						'sp_modifiedDate'=>date('y-m-d h:i:s'),
						'sp_createdDate'=>date('y-m-d h:i:s')
					);
					$res = $this->db->insert('supplier',$data);
					if($res){
						echo 1;
						$this->session->set_flashdata('Suppliermsg',$data['sp_name'].' Supplier details added Successfully!!!');
						exit;
					}
					else{
						echo 2;exit;
					}
				endif;
			else:
				$template = "admin";
                $record['title'] = 'Supplier Management';
                $id = "state_id";
				$record['state'] = $this->admin_model->getallRec('states',$id);
				$record['viewFile'] = "add_supplier";
				$record['module'] = "supplier";
				echo modules::run('template/'.$template,$record);
			endif;
		}
	}

    public function update_supplier($id)
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
                //    print_r($record);
                //    exit();
                    //check if rich customer exist or not
                    $conditionArray = array('sp_id'=>$id);
                    $user_detail = $this->admin_model->getWhere('supplier',$conditionArray);

                    if(@$user_detail[0]->sp_id=='')
                    {
                        echo 3;exit;
                    }
                    else
                    {
                        $data = array(
                            'sp_name' => $record['uname'],
                            'sp_address1'=>$record['uaddress1'],
                            'sp_address2'=>$record['uaddress2'],
                            'sp_address3'=>$record['uaddress3'],
                            'state_id'=>$record['ustate'],
                            'sp_city'=>$record['ucity'],
                            'sp_pincode'=>$record['upincode'],
                            'sp_country'=>$record['ucountry'],
                            'sp_mobile'=>$record['umobile'],
                            'sp_alt'=>$record['ualtmobile'],
                            'sp_email'=>$record['uemail'],
                            'sp_status' => $record['ustatus'],
                            'sp_modifiedDate'=>date('y-m-d h:i:s'),
                        );

                        $this->db->update("supplier",$data,array('sp_id'=>@$id));
                        $this->session->set_flashdata('Suppliermsg',$data['sp_name'].' Supplier details updated Successfully!!!');

                        echo 1;exit;
                    }
                endif;
            else:
                $template = "admin";
                $record['title'] = 'Update Supplier';
                $record['category'] = $this->admin_model->getWhere('supplier',array('sp_id'=>$id));

                if(is_array($record['category'])):

                    $record['viewFile'] = "update_supplier";
					$record['state'] = $this->admin_model->getWhere('states',array('state_id'=>'1'));
                    $record['module'] = "supplier";
                    echo modules::run('template/'.$template,$record);
                else:
                    redirect(base_url().'supplier');
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
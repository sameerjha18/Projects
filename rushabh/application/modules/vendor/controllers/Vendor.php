<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendor extends MX_Controller {
	 
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
            $record['title'] = 'vendor Management';
            $id = "v_id";
			$record['ven_list'] = $this->admin_model->getallRec('vendor',$id);
			$record['viewFile'] = "vendorlist";
			$record['module'] = "vendor";
			echo modules::run('template/'.$template,$record);
		}
    }
    
    public function add_vendor()
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
				$this->form_validation->set_rules('name','vendor name','trim|required|xss_clean');
				$this->form_validation->set_rules('address1','vendor address','trim|required|xss_clean');
                $this->form_validation->set_rules('address2','vendor address','trim|xss_clean');
                $this->form_validation->set_rules('address3','vendor address','trim|xss_clean');
                $this->form_validation->set_rules('state','vendor state','trim|xss_clean');
                $this->form_validation->set_rules('city','vendor city','trim|xss_clean');
                $this->form_validation->set_rules('pincode','vendor pincode','trim|xss_clean');
                $this->form_validation->set_rules('country','vendor Country','trim|xss_clean');
				$this->form_validation->set_rules('mobile','vendor mobile','trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('gstno','vendor gst no','trim|xss_clean');
				$this->form_validation->set_rules('panno','vendor pan no','trim|xss_clean');
                $this->form_validation->set_rules('altmobile','vendor mobile','trim|numeric|xss_clean');
				$this->form_validation->set_rules('email','vendor email','trim|valid_email|xss_clean');
				$this->form_validation->set_rules('status','Status','trim|xss_clean');
				$this->form_validation->set_message('numeric', 'Mobile number should be numeric');

				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					$data = array(
						'v_name' => $record['name'],
						'v_address1'=>$record['address1'],
                        'v_address2'=>$record['address2'],
                        'v_address3'=>$record['address3'],
                        'state_id'=>$record['state'],
                        'v_city'=>$record['city'],
                        'v_pincode'=>$record['pincode'],
                        'v_country'=>$record['country'],
						'v_mobile'=>$record['mobile'],
						'v_alt'=>$record['altmobile'],
						'v_gst'=>$record['gstno'],
						'v_pan'=>$record['panno'],
						'v_email'=>$record['email'],
						'v_status' => $record['status'],
						'v_modifiedDate'=>date('y-m-d h:i:s'),
						'v_createdDate'=>date('y-m-d h:i:s')
					);
					$res = $this->db->insert('vendor',$data);
					if($res){
						echo 1;
						$this->session->set_flashdata('vendormsg',$data['v_name'].' Details added Successfully!!!');
						exit;
					}
					else{
						echo 2;exit;
					}
				endif;
			else:
				$template = "admin";
				$record['title'] = 'vendor Management';
				$id = "state_id";
                $record['state'] = $this->admin_model->getallRec('states',$id);
				$record['viewFile'] = "add_vendor";
				$record['module'] = "vendor";
				echo modules::run('template/'.$template,$record);
			endif;
		}
	}

    public function update_vendor($id)
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
//                    print_r($record);
//                    exit();

                $this->form_validation->set_rules('uname','vendor name','trim|required|xss_clean');
				$this->form_validation->set_rules('uaddress1','vendor address','trim|required|xss_clean');
                $this->form_validation->set_rules('uaddress2','vendor address','trim|xss_clean');
                $this->form_validation->set_rules('uaddress3','vendor address','trim|xss_clean');
                $this->form_validation->set_rules('ustate','vendor state','trim|xss_clean');
                $this->form_validation->set_rules('ucity','vendor city','trim|xss_clean');
                $this->form_validation->set_rules('upincode','vendor pincode','trim|xss_clean');
                $this->form_validation->set_rules('ucountry','vendor Country','trim|xss_clean');
				$this->form_validation->set_rules('umobile','vendor mobile','trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('ualtmobile','vendor mobile','trim|numeric|xss_clean');
                $this->form_validation->set_rules('ugstno','vendor gst no','trim|xss_clean');
				$this->form_validation->set_rules('upanno','vendor pan no','trim|xss_clean');
                $this->form_validation->set_rules('uemail','vendor email','trim|valid_email|xss_clean');
                $this->form_validation->set_rules('ustatus','Status','trim|xss_clean');
                $this->form_validation->set_message('numeric', 'Mobile number should be numeric');

                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:
                    //check if rich customer exist or not
                    $conditionArray = array('v_id'=>$id);
                    $user_detail = $this->admin_model->getWhere('vendor',$conditionArray);

                    if(@$user_detail[0]->v_id=='')
                    {
                        echo 3;exit;
                    }
                    else
                    {
                        $data = array(
                            'v_name' => $record['uname'],
                            'v_address1'=>$record['uaddress1'],
                            'v_address2'=>$record['uaddress2'],
                            'v_address3'=>$record['uaddress3'],
                            'state_id'=>$record['ustate'],
                            'v_city'=>$record['ucity'],
                            'v_pincode'=>$record['upincode'],
                            'v_country'=>$record['ucountry'],
                            'v_mobile'=>$record['umobile'],
                            'v_alt'=>$record['ualtmobile'],
                            'v_gst'=>$record['ugstno'],
                            'v_pan'=>$record['upanno'],
                            'v_email'=>$record['uemail'],
                            'v_status' => $record['ustatus'],
                            'v_modifiedDate'=>date('y-m-d h:i:s'),
                        );

                        $this->db->update("vendor",$data,array('v_id'=>@$id));
                        $this->session->set_flashdata('venmsg',$data['v_name'].' Details updated Successfully!!!');

                        echo 1;exit;
                    }
                endif;
            else:
                $template = "admin";
                $record['title'] = 'Update vendor';
                $record['category'] = $this->admin_model->getWhere('vendor',array('v_id'=>$id));

                if(is_array($record['category'])):

                    $record['viewFile'] = "update_vendor";
                    $id = "state_id";
                    $record['state'] = $this->admin_model->getallRec('states',$id);
                    $record['module'] = "vendor";
                    echo modules::run('template/'.$template,$record);
                else:
                    redirect(base_url().'vendor');
                endif;
            endif;
        }
    }

    public function add_vendorcontact($id)
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
             
                $this->form_validation->set_rules('name','Client Contact name','trim|required|xss_clean');
                $this->form_validation->set_rules('mobile','Client Contact mobile','trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('email','Client Contact email','trim|required|valid_email|xss_clean');
                $this->form_validation->set_rules('designation','Client Contact designation','trim|required|xss_clean');
                $this->form_validation->set_rules('status','Status','trim|xss_clean');
                $this->form_validation->set_message('numeric', 'Mobile number should be numeric');

                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:
                    $data = array(
                        'vc_name' => $record['name'],
                        'v_id'=>$id,
                        'vc_mobile'=>$record['mobile'],
                        'vc_email'=>$record['email'],
                        'vc_designation'=>$record['designation'],
                        'vc_status' => $record['status'],
                        'vc_modifiedDate'=>date('y-m-d h:i:s'),
                        'vc_createdDate'=>date('y-m-d h:i:s')
                    );

                    $res = $this->db->insert('vendorcontact',$data,array('v_id' => $id ));
//                    echo $this->db->lastquery();
                    if($res){
                        echo 1;
                        $this->session->set_flashdata('vendorcontactmsg',$data['vc_name'].' vendor contact details added Successfully!!!');
                        exit;
                    }
                    else{
                        echo 2;exit;
                    }
                endif;
            else:
                $designation = $this->admin_model->getWhere('vendor',array('v_id'=>$id));
                $template = "admin";
                $record['title'] = 'vendor Management';
                $record['viewFile'] = "vendorcontact";
                $record['module'] = "vendor";
                echo modules::run('template/'.$template,$record);
            endif;

        }
    }

    public function vendorcontact($id)
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
            $client = $this->admin_model->getWhere('vendor',array('v_id' =>$id ));
           
            if(is_array($client)):
               
                $template = "admin";

                $record['title'] = 'vender Management';
                $record['vc_list'] =$this->admin_model->getWhere('vendorcontact',array('v_id' =>$id));
                $record['id'] =$client[0]->v_id;
                $record['v_name'] = $this->admin_model->getWhere('vendor', array('v_id' => $id));
                $record['viewFile'] = "vendorcontact";
                $record['module'] = "vendor";
                echo modules::run('template/'.$template,$record);
            else:
                redirect(base_url().'vendor');
            endif;
        }
    }

    public function update_vencontact($id)
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
                $this->form_validation->set_rules('uname','Client Contact name','trim|required|xss_clean');
                $this->form_validation->set_rules('umobile','Client Contact mobile','trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('uemail','Client Contact email','trim|required|valid_email|xss_clean');
                $this->form_validation->set_rules('udesignation','Client Contact designation','trim|required|xss_clean');
                $this->form_validation->set_rules('ustatus','Status','trim|xss_clean');
                $this->form_validation->set_message('numeric', 'Mobile number should be numeric');
                
                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:

                    //check if rich customer exist or not
                    $conditionArray = array('vc_id'=>$id);
                    $user_detail = $this->admin_model->getWhere('vendorcontact',$conditionArray);
                    
                    if(@$user_detail[0]->vc_id=='')
                    {
                        echo 3;exit;
                    }
                    else
                    {
                       $data = array(
                        'vc_name' => $record['uname'],
                        'vc_mobile'=>$record['umobile'],
                        'vc_email'=>$record['uemail'],
                        'vc_designation'=>$record['udesignation'],
                        'vc_status' => $record['ustatus'],
                        'vc_modifiedDate'=>date('y-m-d h:i:s'),
                        'vc_createdDate'=>date('y-m-d h:i:s')
                    );
                        $this->db->update("vendorcontact",$data,array('vc_id'=>@$id));
                        $this->session->set_flashdata('vendormsg',$data['vc_name'].' vendor details updated Successfully!!!');
                    
                        echo 1;exit;
                    }
                endif;
            else:
                $staff = $this->admin_model->getWhere('vendorcontact',array('vc_id'=>$id));
                if(is_array($staff)):
                    $data = $staff[0];
                    $data->result = 'success';
                    $json = json_encode($data);
                    echo $json;
                    exit;
                else: 
                    redirect(base_url().'vendor');
                endif;
            endif;
        }
    }

    public function productspecialized($id)
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
            $vendor = $this->admin_model->getWhere('vendor',array('v_id' =>$id ));
           
            if(is_array($vendor)):
               
                $template = "admin";

                $record['title'] = 'vender Management';
                $record['psp_list'] =$this->admin_model->getproductspecialized($id);
                $record['id'] =$vendor[0]->v_id;
                $record['v_name'] = $this->admin_model->getWhere('vendor', array('v_id' => $id));
                $record['product'] = $this->admin_model->getWhere('products', array('p_status' => 1));
                $record['viewFile'] = "productspecialized";
                $record['module'] = "vendor";
                echo modules::run('template/'.$template,$record);
            else:
                redirect(base_url().'vendor');
            endif;
        }
    }

    public function add_productspecialized($id)
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

                $this->form_validation->set_rules('product','Product supplier Product ','trim|required|xss_clean');
                $this->form_validation->set_rules('status','Status','trim|xss_clean');

                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:
                    $data = array(
                        'p_id' =>$record['product'],
                        'v_id'=>$id,
                        'psp_status' => $record['status'],
                        'psp_modifiedDate'=>date('y-m-d h:i:s'),
                        'psp_createdDate'=>date('y-m-d h:i:s')
                    );

                    $res = $this->db->insert('p_specialized',$data,array('v_id' => $id ));
//                    echo $this->db->lastquery();
                    if($res){
                        echo 1;
                        $this->session->set_flashdata('productspecializedmsg',$data['p_id'].' Products details added Successfully!!!');
                        exit;
                    }
                    else{
                        echo 2;exit;
                    }
                endif;
            else:
                $designation = $this->admin_model->getWhere('vendor',array('v_id'=>$id));
                $template = "admin";
                $record['title'] = 'Vendor Management';
                $record['viewFile'] = "productspecialized";
                $record['module'] = "vendor";
                echo modules::run('template/'.$template,$record);
            endif;

        }
    }

    public function update_productspecialized($id)
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
                    $this->form_validation->set_rules('product','Product supplier Product ','trim|required|xss_clean');
                $this->form_validation->set_rules('ustatus','Status','trim|xss_clean');
                
                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:

                    //check if rich customer exist or not
                    $conditionArray = array('psp_id'=>$id);
                    $user_detail = $this->admin_model->getWhere('p_specialized',$conditionArray);
                    
                    if(@$user_detail[0]->psp_id=='')
                    {
                        echo 3;exit;
                    }
                    else
                    {
                       $data = array(
                        'p_id' => $record['product'],
                        'psp_status' => $record['ustatus'],
                        'psp_modifiedDate'=>date('y-m-d h:i:s')
                    );
                        $this->db->update("p_specialized",$data,array('psp_id'=>@$id));
                        $this->session->set_flashdata('productsuppliermsg',$data['p_id'].' Supplier details updated Successfully!!!');
                    
                        echo 1;exit;
                    }
                endif;
            else:
                $p_specialized = $this->admin_model->getWhere('p_specialized',array('psp_id'=>$id));
                    if(is_array($p_specialized)):
                        $data = $p_specialized[0];
                        $data->result = 'success';
                        $json = json_encode($data);
                        echo $json;
                        exit;
                    else: 
                        redirect(base_url().'vendor');
                    endif;
            endif;
        }
    }
}
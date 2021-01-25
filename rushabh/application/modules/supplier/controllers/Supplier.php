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
            $id = "s_id";
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
				$this->form_validation->set_rules('sname','Supplier name','trim|required|xss_clean');
				$this->form_validation->set_rules('saddress1','Supplier address','trim|required|xss_clean');
                $this->form_validation->set_rules('saddress2','Supplier address','trim|xss_clean');
                $this->form_validation->set_rules('saddress3','Supplier address','trim|xss_clean');
                $this->form_validation->set_rules('state','Supplier state','trim|xss_clean');
                $this->form_validation->set_rules('scity','Supplier city','trim|xss_clean');
                $this->form_validation->set_rules('spincode','Supplier pincode','trim|xss_clean');
                $this->form_validation->set_rules('scountry','Supplier Country','trim|xss_clean');
				$this->form_validation->set_rules('smobile','Supplier mobile','trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('saltmobile','Supplier mobile','trim|numeric|xss_clean');
				$this->form_validation->set_rules('semail','Supplier email','trim|valid_email|xss_clean');
				$this->form_validation->set_rules('status','Status','trim|xss_clean');
				$this->form_validation->set_message('numeric', 'Mobile number should be numeric');

				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					$data = array(
						's_name' => $record['sname'],
						's_address1'=>$record['saddress1'],
                        's_address2'=>$record['saddress2'],
                        's_address3'=>$record['saddress3'],
                        'state_id'=>$record['state'],
                        's_city'=>$record['scity'],
                        's_pincode'=>$record['spincode'],
                        's_country'=>$record['scountry'],
						's_mobile'=>$record['smobile'],
						's_alt'=>$record['saltmobile'],
						's_email'=>$record['semail'],
						's_status' => $record['status'],
						's_modifiedDate'=>date('y-m-d h:i:s'),
						's_createdDate'=>date('y-m-d h:i:s')
					);
					$res = $this->db->insert('supplier',$data);
					if($res){
						echo 1;
						$this->session->set_flashdata('Suppliermsg',$data['s_name'].' Supplier details added Successfully!!!');
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
                $this->form_validation->set_rules('uname','client name','trim|required|xss_clean');
				$this->form_validation->set_rules('uaddress1','client address','trim|required|xss_clean');
                $this->form_validation->set_rules('uaddress2','client address','trim|xss_clean');
                $this->form_validation->set_rules('uaddress3','client address','trim|xss_clean');
                $this->form_validation->set_rules('ustate','client state','trim|xss_clean');
                $this->form_validation->set_rules('ucity','client city','trim|xss_clean');
                $this->form_validation->set_rules('upincode','client pincode','trim|xss_clean');
                $this->form_validation->set_rules('ucountry','client Country','trim|xss_clean');
				$this->form_validation->set_rules('umobile','client mobile','trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('ualtmobile','client mobile','trim|numeric|xss_clean');
                $this->form_validation->set_rules('uemail','Staff email','trim|valid_email|xss_clean');
                $this->form_validation->set_rules('ustatus','Status','trim|xss_clean');
                $this->form_validation->set_message('numeric', 'Mobile number should be numeric');

                $this->form_validation->set_message('numeric', 'Mobile number should be numeric');

                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:
                    $record = $this->input->post();
                //    print_r($record);
                //    exit();
                    //check if rich customer exist or not
                    $conditionArray = array('s_id'=>$id);
                    $user_detail = $this->admin_model->getWhere('supplier',$conditionArray);

                    if(@$user_detail[0]->s_id=='')
                    {
                        echo 3;exit;
                    }
                    else
                    {
                        $data = array(
                            's_name' => $record['uname'],
                            's_address1'=>$record['uaddress1'],
                            's_address2'=>$record['uaddress2'],
                            's_address3'=>$record['uaddress3'],
                            'state_id'=>$record['ustate'],
                            's_city'=>$record['ucity'],
                            's_pincode'=>$record['upincode'],
                            's_country'=>$record['ucountry'],
                            's_mobile'=>$record['umobile'],
                            's_alt'=>$record['ualtmobile'],
                            's_email'=>$record['uemail'],
                            's_status' => $record['ustatus'],
                            's_modifiedDate'=>date('y-m-d h:i:s'),
                        );

                        $this->db->update("supplier",$data,array('s_id'=>@$id));
                        $this->session->set_flashdata('Suppliermsg',$data['s_name'].' Supplier details updated Successfully!!!');

                        echo 1;exit;
                    }
                endif;
            else:
                $template = "admin";
                $record['title'] = 'Update Supplier';
                $record['category'] = $this->admin_model->getWhere('supplier',array('s_id'=>$id));

                if(is_array($record['category'])):

                    $record['viewFile'] = "update_supplier";
					$id = "state_id";
                    $record['state'] = $this->admin_model->getallRec('states',$id);
                    $record['module'] = "supplier";
                    echo modules::run('template/'.$template,$record);
                else:
                    redirect(base_url().'supplier');
                endif;
            endif;
        }
    }

    public function add_suppliercontact($id)
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
             
                $this->form_validation->set_rules('name','Supplier Contact name','trim|required|xss_clean');
                $this->form_validation->set_rules('mobile','Supplier Contact mobile','trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('email','Supplier Contact email','trim|required|valid_email|xss_clean');
                $this->form_validation->set_rules('designation','Supplier Contact designation','trim|required|xss_clean');
                $this->form_validation->set_rules('status','Status','trim|xss_clean');
                $this->form_validation->set_message('numeric', 'Mobile number should be numeric');

                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:
                    $data = array(
                        'sc_name' => $record['name'],
                        's_id'=>$id,
                        'sc_mobile'=>$record['mobile'],
                        'sc_email'=>$record['email'],
                        'sc_designation'=>$record['designation'],
                        'sc_status' => $record['status'],
                        'sc_modifiedDate'=>date('y-m-d h:i:s'),
                        'sc_createdDate'=>date('y-m-d h:i:s')
                    );

                    $res = $this->db->insert('suppliercontact',$data,array('s_id' => $id ));
//                    echo $this->db->lastquery();
                    if($res){
                        echo 1;
                        $this->session->set_flashdata('suppliercontactmsg',$data['sc_name'].' Supplier contact details added Successfully!!!');
                        exit;
                    }
                    else{
                        echo 2;exit;
                    }
                endif;
            else:
                $designation = $this->admin_model->getWhere('supplier',array('s_id'=>$id));
                $template = "admin";
                $record['title'] = 'Supplier Management';
                $record['viewFile'] = "suppliercontact";
                $record['module'] = "supplier";
                echo modules::run('template/'.$template,$record);
            endif;

        }
    }

    public function suppliercontact($id)
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
            $supplier = $this->admin_model->getWhere('supplier',array('s_id' =>$id ));
           
            if(is_array($supplier)):
               
                $template = "admin";

                $record['title'] = 'Supplier Management';
                $record['sc_list'] =$this->admin_model->getWhere('suppliercontact',array('s_id' =>$id));
                $record['id'] =$supplier[0]->s_id;
                $record['s_name'] = $this->admin_model->getWhere('supplier', array('s_id' => $id));
                $record['viewFile'] = "suppliercontact";
                $record['module'] = "supplier";
                echo modules::run('template/'.$template,$record);
            else:
                redirect(base_url().'supplier');
            endif;
        }
    }

    public function update_suppliercontact($id)
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
                $this->form_validation->set_rules('uname','Supplier Contact name','trim|required|xss_clean');
                $this->form_validation->set_rules('umobile','Supplier Contact mobile','trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('uemail','Supplier Contact email','trim|required|valid_email|xss_clean');
                $this->form_validation->set_rules('udesignation','Supplier Contact designation','trim|required|xss_clean');
                $this->form_validation->set_rules('ustatus','Status','trim|xss_clean');
                $this->form_validation->set_message('numeric', 'Mobile number should be numeric');
                
                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:

                    //check if rich customer exist or not
                    $conditionArray = array('sc_id'=>$id);
                    $user_detail = $this->admin_model->getWhere('suppliercontact',$conditionArray);
                    
                    if(@$user_detail[0]->sc_id=='')
                    {
                        echo 3;exit;
                    }
                    else
                    {
                       $data = array(
                        'sc_name' => $record['uname'],
                        'sc_mobile'=>$record['umobile'],
                        'sc_email'=>$record['uemail'],
                        'sc_designation'=>$record['udesignation'],
                        'sc_status' => $record['ustatus'],
                        'sc_modifiedDate'=>date('y-m-d h:i:s')
                    );
                        $this->db->update("suppliercontact",$data,array('sc_id'=>@$id));
                        $this->session->set_flashdata('suppliercontactmsg',$data['sc_name'].' Supplier details updated Successfully!!!');
                    
                        echo 1;exit;
                    }
                endif;
            else:
                $staff = $this->admin_model->getWhere('suppliercontact',array('sc_id'=>$id));
                if(is_array($staff)):
                    $data = $staff[0];
                    $data->result = 'success';
                    $json = json_encode($data);
                    echo $json;
                    exit;
                else: 
                    redirect(base_url().'supplier');
                endif;
            endif;
        }
    }

    
    public function productsupplierlist($id)
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
            $supplier = $this->admin_model->getWhere('supplier',array('s_id' =>$id ));
           
            if(is_array($supplier)):
               
                $template = "admin";

                $record['title'] = 'Supplier Management';
                $record['ps_list'] =$this->admin_model->getproductsupplier($id);
                $record['id'] =$supplier[0]->s_id;
                $record['s_name'] = $this->admin_model->getWhere('supplier', array('s_id' => $id));
                $record['product'] = $this->admin_model->getWhere('products', array('p_status' => 1));
                $record['viewFile'] = "productsupplierlist";
                $record['module'] = "supplier";
                echo modules::run('template/'.$template,$record);
            else:
                redirect(base_url().'supplier');
            endif;
        }
    }

    public function add_productSupply($id)
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
                        's_id'=>$id,
                        'ps_status' => $record['status'],
                        'ps_modifiedDate'=>date('y-m-d h:i:s'),
                        'ps_createdDate'=>date('y-m-d h:i:s')
                    );

                    $res = $this->db->insert('p_supplier',$data,array('s_id' => $id ));

                    if($res){
                        echo 1;
                        $this->session->set_flashdata('productsuppliermsg',$data['p_id'].' Product  details added Successfully!!!');
                        exit;
                    }
                    else{
                        echo 2;exit;
                    }
                endif;
            else:
                $designation = $this->admin_model->getWhere('supplier',array('s_id'=>$id));
                $template = "admin";
                $record['title'] = 'Supplier Management';
                $record['viewFile'] = "productsupplierlist";
                $record['module'] = "supplier";
                echo modules::run('template/'.$template,$record);
            endif;

        }
    }

    public function update_productSupply($id)
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
                $conditionArray = array('ps_id'=>$id);
                $user_detail = $this->admin_model->getWhere('p_supplier',$conditionArray);
                
                if(@$user_detail[0]->ps_id=='')
                {
                    echo 3;exit;
                }
                else
                {
                   $data = array(
                    'p_id' => $record['product'],
                    'ps_status' => $record['ustatus'],
                    'ps_modifiedDate'=>date('y-m-d h:i:s')
                );
                    $this->db->update("p_supplier",$data,array('ps_id'=>@$id));
                    $this->session->set_flashdata('productsuppliermsg',$data['p_id'].' product details updated Successfully!!!');
                
                    echo 1;exit;
                }
            endif;
        else:
            $p_supply = $this->admin_model->getWhere('p_supplier',array('ps_id'=>$id));
            if(is_array($p_supply)):
                $data = $p_supply[0];
                $data->result = 'success';
                $json = json_encode($data);
                echo $json;
                exit;
            else: 
                redirect(base_url().'supplier');
            endif;
        endif;
        }
   }
}
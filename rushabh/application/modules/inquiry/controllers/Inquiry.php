<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inquiry extends MX_Controller {
	 
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/admin_model');
	}
	
	public function index($page='')
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		
		if(empty($adminSession))
		{
			redirect(base_url().'admin');
		}
		else if(!in_array('3',$admin_roles))
		{
			redirect(base_url().'admin/dashboard');
		}
		else
		{
			redirect(base_url().'inquiry/allinquiries');
		}
	}
	public function allinquiries()
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		
		if(empty($adminSession))
		{
			redirect(base_url().'admin');
		}
		else if(!in_array('3',$admin_roles))
		{
			redirect(base_url().'admin/dashboard');
		}
		else
		{

			$inq_details = $this->admin_model->allinquiries();
			$template = "admin";
			$record['title'] = 'Inquiry Management';
			$record['cl'] = $inq_details;
			$record['viewFile'] = "inquiry_list";
			$record['module'] = "inquiry";
			echo modules::run('template/'.$template,$record);

		}
	}

	public function customers()
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		
		if(empty($adminSession))
		{
			redirect(base_url().'admin');
		}
		else if(!in_array('3',$admin_roles))
		{
			redirect(base_url().'admin/dashboard');
		}
		else
		{

			$cust_details = $this->admin_model->getWhere('customer' , array('c_status' => '1'));
			$template = "admin";
			$record['title'] = 'Inquiry Management';
			$record['cl'] = $cust_details;
			$record['viewFile'] = "customer_list";
			$record['module'] = "inquiry";
			echo modules::run('template/'.$template,$record);

		}
	}

	public function trash_inquiries()
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		
		if(empty($adminSession))
		{
			redirect(base_url().'admin');
		}
		else if(!in_array('3',$admin_roles))
		{
			redirect(base_url().'admin/dashboard');
		}
		else
		{

			$inq_details = $this->admin_model->trashinquiries();
			if(is_array($inq_details)){
				for($i=0;$i<count($inq_details);$i++)
				{
					$p_name = $this->admin_model->inq_products($inq_details[$i]['inq_product']);
					$p = array();
					for($j=0;$j<count($p_name);$j++)
					{
						$p[$j] = $p_name[$j]['p_name']; 
					}
					$inq_details[$i]['products']  = implode(" , ", $p);
				
				}
			}
			
			$template = "admin";
			$record['title'] = 'Inquiry Management';
			$record['cl'] = $inq_details;
			$record['viewFile'] = "trash_inquiry";
			$record['module'] = "inquiry";
			echo modules::run('template/'.$template,$record);

		}
	}

	public function update_inquiry($id)
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
					
					
					$this->form_validation->set_rules('address','Customer name','trim|required|xss_clean');
					$this->form_validation->set_rules('sperson','Customer mobile code','trim|required|xss_clean');
					$this->form_validation->set_rules('scontact','Customer mobile','trim|required|numeric|xss_clean');
					$this->form_validation->set_rules('sdate','customer email','trim|xss_clean|required');
					$this->form_validation->set_rules('fdate','reference type','trim|xss_clean|required');
					
					$this->form_validation->set_rules('sup[]','reference name','trim|xss_clean|required');
					$this->form_validation->set_rules('sow','reference name','trim|xss_clean|required');
					$this->form_validation->set_rules('idate','Date','trim|xss_clean|required');
					$this->form_validation->set_rules('ustatus','Status','trim|xss_clean|required');
					if($this->form_validation->run()==FALSE):
						echo json_encode($this->form_validation->error_array());exit;
					else:
						$data = array(
							'inq_date' => $record['idate'],
							'inq_address'=> $record['address'],
							'inq_sitePerson' => $record['sperson'],
							'inq_siteContact'=> $record['scontact'],
							'inq_sdate' => $record['sdate'],
							'inq_fdate' => $record['fdate'],
							'inq_ss' => implode(",",$record['sup']),
							'inq_sow' => $record['sow'],
							'inq_updatedDate' => date('y-m-d h:i:s'),
							'inq_status'=>$record['ustatus'],
						);

						$res = $this->db->update('inquiries',$data,array('inq_id'=>@$id));
						if($res){
							$this->session->set_flashdata('Inquirymsg','Inquiry details added successfully !!!');
							echo 1;exit;
						}
						else{
							echo 2;exit;
						}
				endif;	
            else:
                $inq_details = $this->admin_model->get_inquiry($id);
                $template = "admin";
                $record['title'] = 'Update Sites';

                if(is_array($inq_details)):
					$record['inq'] = $inq_details;

					$record['rt'] = $this->admin_model->getWhere('referencetype',array('rt_status'=>'1'));
					$record['sup'] = $this->admin_model->getWhere('supervisor',array('sup_status'=>'1'));
					$id = 'countries_id';
					$record['sup_array'] = explode(',',$inq_details[0]['inq_ss']);
					$record['code'] = $this->admin_model->getAllRec('countries',$id);
					
                    $record['viewFile'] = "update_inquiry";
                    $record['module'] = "inquiry";
                    echo modules::run('template/'.$template,$record);
                else:
                    redirect(base_url().'clientmanagement');
                endif;
            endif;
        }
    }
	
	public function add_inquiry()
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		if(empty($adminSession))
		{
			redirect(base_url().'admin');
		}
		else if(!in_array('3',$admin_roles))
		{
			redirect(base_url().'admin/dashboard');
		}
		else
		{
			if($this->input->post('isAjax')=='1'):


				$inq_details = array();
				$record = $this->input->post();
				$number = $this->admin_model->getWhere('customer',array('c_mobile'=>$record['cmobile']));	
				if(is_array($number))
				{
					$inq_details['c_id'] = $number[0]->c_id;
				
				}
				else
				{
					
					$this->form_validation->set_rules('cname','Customer name','trim|required|xss_clean');
					$this->form_validation->set_rules('cm_code','Customer mobile code','trim|required|numeric|xss_clean');
					$this->form_validation->set_rules('cmobile','Customer mobile','trim|required|numeric|xss_clean|is_unique[customer.c_mobile]');
					$this->form_validation->set_rules('email','customer email','trim|valid_email|xss_clean|is_unique[customer.c_email]');
					$this->form_validation->set_rules('rtype','reference type','trim|xss_clean|required');
					
					$this->form_validation->set_rules('rname','reference name','trim|xss_clean|required');
					$this->form_validation->set_rules('idate','Date','trim|xss_clean|required');
					if($this->form_validation->run()==FALSE):
						echo json_encode($this->form_validation->error_array());exit;
					else:	
						$data = array(
							'c_name' => $record['cname'],
							'c_code'=>$record['cm_code'],
							'c_mobile'=>$record['cmobile'],
							'c_email'=>$record['email'],
							'rt_id'=>$record['rtype'],
							'r_name'=>$record['rname'],
							'added_by'=>'admin',
							'added_id'=>$this->session->userdata('userid'),
							'c_modifiedDate'=>date('y-m-d h:i:s'),
							'c_createdDate'=>date('y-m-d h:i:s')
						);
						$response = $this->db->insert('customer',$data);

						$inq_details['c_id'] = $this->db->insert_id();

					endif;
				}
			
					$inq_details['inq_date'] = $record['idate'];
					$inq_details['inq_address'] = $record['address'];
					$inq_details['inq_sitePerson'] = $record['sperson'];
					$inq_details['inq_siteContact'] =$record['scontact'];
					$inq_details['inq_sdate'] = $record['sdate'];
					$inq_details['inq_fdate'] = $record['fdate'];
					$inq_details['inq_ss'] = implode(",",$record['sup']);
					$inq_details['inq_sow'] = $record['sow'];
					$inq_details['inq_addedBy'] ='admin';
					$inq_details['inq_addedId'] = $this->session->userdata('userid');
					$inq_details['inq_addedDate'] = date('y-m-d h:i:s');
					$inq_details['inq_updatedDate'] = date('y-m-d h:i:s');
					$inq_details['inq_status'] = 1;
					$res = $this->db->insert('inquiries',$inq_details);

					if($res){
						$this->session->set_flashdata('Inquirymsg','Inquiry details added successfully !!!');
						echo 1;exit;
					}
					else{
						echo 2;exit;
					}
			else:
				$template = "admin";
				$record['it'] = $this->admin_model->getWhere('industrytype',array('it_status'=>'1'));

				$record['rt'] = $this->admin_model->getWhere('referencetype',array('rt_status'=>'1'));
				$record['sp'] = $this->admin_model->getWhere('supervisor',array('sup_status'=>'1'));
				$id = 'countries_id';
				$record['code'] = $this->admin_model->getAllRec('countries',$id);

				$record['title'] = 'Inquiry Management';
				$record['viewFile'] = "add_inquiry";
				$record['module'] = "inquiry";
				
				echo modules::run('template/'.$template,$record);
			endif;
		}
	}

	public function search_member()
	{
		$record = $this->admin_model->getWhere('customer',array('c_mobile'=>$this->input->post('id'),'c_code'=>$this->input->post('code')));

		$data = array();
		if(is_array($record)){
			$data = $record[0];
			$data->result = 'success';
			$json = json_encode($data);
			echo $json;
			exit;
		}
		else{
			$data['result'] = 'fail';
			$json = json_encode($data);
			echo $json;
			exit;
		}
	}

	public function update_customer($id)
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		if(empty($adminSession))
		{
			redirect(base_url().'admin');
		}
		else if(!in_array('3',$admin_roles))
		{
			redirect(base_url().'admin/dashboard');
		}
		else
		{

			if($this->input->post('isAjax')=='1'):
			$record = $this->input->post();
				$this->form_validation->set_rules('cname','customer email','trim|xss_clean');

				$this->form_validation->set_rules('cm_code','customer isdcode','trim|xss_clean|required');
				$this->form_validation->set_rules('cmobile','Customer Mobile','trim|xss_clean');
				$this->form_validation->set_rules('email','customer email','trim|xss_clean');
				$this->form_validation->set_rules('rtype','Reference type','trim|xss_clean');
				$this->form_validation->set_rules('rname','Reference name','trim|xss_clean');
				$this->form_validation->set_rules('status','Status','trim|xss_clean');
				
			
				if($this->form_validation->run($this)==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
				
					//check if rich customer exist or not
					$conditionArray = array('c_id'=>$id);
					$customer = $this->admin_model->getWhere('customer',$conditionArray);
					
					if($customer[0]->c_id=='')
					{
						echo 3;exit;
					}
					else
					{
					

						$data = array(
							'c_name' => $record['cname'],
							'c_code'=>$record['cm_code'],
							'c_mobile'=>$record['cmobile'],
							'c_email'=>$record['email'],
							'rt_id'=>$record['rtype'],
							'r_name'=>$record['rname'],
							'c_status' => $record['status'],
							'added_by'=>'admin',
							'added_id'=>$this->session->userdata('userid'),
							'c_modifiedDate'=>date('y-m-d h:i:s'),
						);					
						$res = $this->db->update("customer",$data,array('c_id'=>$id));
						if($res){

							$this->session->set_flashdata('Customermsg',$data['c_name'].' Customer details updated Successfully !!!');
							echo 1;exit;
						}
						else{
							echo 2;exit;
						}
					}
				endif;
			else:

				$c_details = $this->admin_model->getWhere('customer',array('c_id'=>$id));
				if(is_array($c_details))
				{
					$template = "admin";
					$record['c_details'] = $c_details;
					$record['it'] = $this->admin_model->getWhere('industrytype',array('it_status'=>'1'));
					$record['rt'] = $this->admin_model->getWhere('referencetype',array('rt_status'=>'1'));
					$id = 'countries_id';
					$record['code'] = $this->admin_model->getAllRec('countries',$id);
					$record['title'] = 'Inquiry Management';
					$record['viewFile'] = "update_member";
					$record['module'] = "inquiry";
						
					echo modules::run('template/'.$template,$record);
				}
				else{
					redirect(base_url().'inquiry');
				}
			endif;
		}
	}

	public function view($id)
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		if(empty($adminSession))
		{
			redirect(base_url().'admin');
		}
		else if(!in_array('3',$admin_roles))
		{
			redirect(base_url().'admin/dashboard');
		}
		else
		{
			$inq_details = $this->admin_model->get_inquiry($id);
			if(is_array($inq_details))
			{

				$template = "admin";

				$customer = $this->admin_model->get_customer($inq_details[0]['c_id']);
				$lead = $this->admin_model->get_leadstatus($inq_details[0]['lead_status']);
				$record['inqfr'] = $this->admin_model->getWhere('inquiry_fr',array('inq_id'=>$id));
				$record['inspect'] = $this->admin_model->getWhere('inquiry_detail',array('inq_id'=>$id));
				$record['inq'] = $inq_details[0];
				$sup = $inq_details[0]['inq_ss'] ;
				$record['sup'] = $this->admin_model->get_inqsupervisor($sup);
				$array = array();
				for ($i = 0 ; $i <count($record['sup']) ; $i++) {
					$array[$i] =  $record['sup'][$i]['sup_name'];
				}
				$record['customer'] = $customer[0];
				$record['lead'] = $lead[0];
                $record['leads'] = $this->admin_model->getWhere('leadstatus', array('ls_status' => 1));
				$record['supervisor'] = implode(',', $array);
				$record['title'] = 'Inquiry Management';
				$record['viewFile'] = "view_inquiry";
				$record['module'] = "inquiry";
					
				echo modules::run('template/'.$template,$record);
			}
			else{
				redirect(base_url().'inquiry');
			}
		}
	}

	public function mobile_check($mobile,$id)
	{	
		$mobile_details = $this->admin_model->getWhere('customer',array('c_mobile'=>$mobile));	
	   	if(is_array($mobile_details)){
		   	if ($mobile_details[0]->c_id!=$id)
	        {
	                $this->form_validation->set_message('mobile_check', 'The '.$mobile.' mobile is assigned to someone else');
	                return FALSE;
	        }
	        else
	        {
	                return TRUE;
	        }
    	}
    	else{
    		return TRUE;
    	}
	}

	public function camobile_check($mobile,$id)
	{	
		$altmobile_details = $this->admin_model->getWhere('customer',array('ca_mobile'=>$mobile));	
		if(is_array($altmobile_details)){
			if ($altmobile_details[0]->c_id!=$id)
	        {
	                $this->form_validation->set_message('camobile_check', 'The '.$mobile.' mobile is assigned to someone else');
	                return FALSE;
	        }
	        else
	        {
	                return TRUE;
	        }
		}
	  	else{

	                return TRUE;
	  	}
	}

	public function email_check($email,$id)
	{

		$email_details = $this->admin_model->getWhere('customer',array('c_email'=>$email));	
		
		if(is_array($email_details)){

			if ($email_details[0]->c_id!=$id)
	        {
	                $this->form_validation->set_message('email_check', 'The '.$email.' email is assigned to someone else');
	                return FALSE;
	        }
	        else
	        {
	                return TRUE;
	        }
	
		}
	    else
        {
                return TRUE;
        }	
	}	
	
	public function update_followup($id)
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

				$this->form_validation->set_rules('fndate','Follow up new date','trim|required|xss_clean');
				$this->form_validation->set_rules('fremark','Follow up remarks','trim|xss_clean');
				
				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:

					//check if rich customer exist or not
					$conditionArray = array('inq_id'=>$id);
					$user_detail = $this->admin_model->getWhere('inquiries',$conditionArray);
					
					if(@$user_detail[0]->inq_id=='')
					{
						echo 3;exit;
					}
					else
					{
					$data = array(
						
						'inq_id'=>$id,
						'ifr_date'=>$record['fndate'],
						'ifr_remark'=>'Old Followup Date was : '.date('d-M-Y',strtotime($record['inquirydate'])).' and new date is : '.date('d-M-Y',strtotime($record['fndate'])).'. Reason: '. $record['fremark']);
					$this->db->insert("inquiry_fr",$data);
					
					}
					
					$data1 = array(
						
						'inq_fdate'=>$record['fndate'],
						);

						$res = $this->db->update('inquiries',$data1,array('inq_id'=>$id));
						if($res){
							$this->session->set_flashdata('Inquirymsg','Inquiry details added successfully !!!');
							echo 1;exit;
						}
						else{
							echo 2;exit;
						}
				endif;	
			else:
				$inquiry = $this->admin_model->getWhere('inquiries',array('inq_id'=>$id));
				if(is_array($inquiry)):
					$data = $inquiry[0];
					$data->result = 'success';
					$json = json_encode($data);
					echo $json;
					exit;
				else: 
					redirect(base_url().'inquiry');
				endif;
			endif;
		}
	}

	public function update_sitedate($id)
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
				$this->form_validation->set_rules('sitenewdate','Site Visit new date','trim|required|xss_clean');
				
				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:

					//check if rich customer exist or not
					$conditionArray = array('inq_id'=>$id);
					$user_detail = $this->admin_model->getWhere('inquiries',$conditionArray);
					
					if(@$user_detail[0]->inq_id=='')
					{
						echo 3;exit;
					}
					else
					{
					$data = array(
						
						'inq_sdate'=>$record['sitenewdate'],
					);
					$res= $this->db->update("inquiries",$data,array('inq_id'=>$id));
					
					}
					if($res){
						$this->session->set_flashdata('Inquirymsg','Inquiry details added successfully !!!');
						echo 1;exit;
					}
					else{
						echo 2;exit;
					}
				endif;	
			else:
				$inquiry = $this->admin_model->getWhere('inquiries',array('inq_id'=>$id));
				if(is_array($inquiry)):
					$data = $inquiry[0];
					$data->result = 'success';
					$json = json_encode($data);
					echo $json;
					exit;
				else: 
					redirect(base_url().'inquiry');
				endif;
			endif;
		}
	}

	public function add_inquirydetails($id)
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
				
				$this->form_validation->set_rules('area','Area','trim|required|xss_clean');
				$this->form_validation->set_rules('ogd','Openable Grill Distance','trim|required|xss_clean');
                $this->form_validation->set_rules('efs','Exahust fan Size','trim|required|xss_clean');
                $this->form_validation->set_rules('jp','jali Position','trim|required|xss_clean');
                $this->form_validation->set_rules('ms','Marble Size','trim|required|xss_clean');
                $this->form_validation->set_rules('pc','Powder coating','trim|required|xss_clean');
                $this->form_validation->set_rules('glass','Glass','trim|required|xss_clean');
                $this->form_validation->set_rules('aluminium','Aluminium Section','trim|required|xss_clean');

				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					$data = array(
						'inqd_area' => $record['area'],
						'inq_id'=>$id,
						'inqd_ogd'=>$record['ogd'],
                        'inqd_efs'=>$record['efs'],
                        'inqd_jp'=>$record['jp'],
                        'inqd_mSize'=>$record['ms'],
                        'inqd_pCoating'=>$record['pc'],
                        'inqd_glass'=>$record['glass'],
						'inqd_aSection'=>$record['aluminium'],
						'inqd_addedId'=>$this->session->userdata('userid'),
						'inqd_addedBy'=>$this->session->userdata('adminName').'- admin',
						'inqd_modifiedDate'=>date('y-m-d h:i:s'),
						'inqd_createdDate'=>date('y-m-d h:i:s')
					);
					// pre($data);
					// exit;
					$res = $this->db->insert('inquiry_detail',$data);
					if($res){
						echo 1;
						$this->session->set_flashdata('Supervisormsg',' Inquiry details added Successfully!!!');
						exit;
					}
					else{
						echo 2;exit;
					}
				endif;
			else:
				$inquirydetail = $this->admin_model->getWhere('inquiries',array('inq_id'=>$id));
				// pre($inquirydetail);
				// exit;
				if(is_array($inquirydetail))
				{
					$template = "admin";
	                $record['title'] = 'Investigations Details';
	                $record['inq_id'] =$inquirydetail[0]->inq_id; 
					$record['viewFile'] = "add_investigationdetails";
					$record['module'] = "inquiry";
					echo modules::run('template/'.$template,$record);
					}
				else{
					redirect('inquiry/allinquiries');
				}
			endif;
		}
	}

	public function update_inquirydetails($id,$inq_id)
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


                $this->form_validation->set_rules('area','Area','trim|required|xss_clean');
				$this->form_validation->set_rules('ogd','Openable Grill Distance','trim|required|xss_clean');
                $this->form_validation->set_rules('efs','Exahust fan Size','trim|required|xss_clean');
                $this->form_validation->set_rules('jp','jali Position','trim|required|xss_clean');
                $this->form_validation->set_rules('ms','Marble Size','trim|required|xss_clean');
                $this->form_validation->set_rules('pc','Powder coating','trim|required|xss_clean');
                $this->form_validation->set_rules('glass','Glass','trim|required|xss_clean');
                $this->form_validation->set_rules('aluminium','Aluminium Section','trim|required|xss_clean');

                if($this->form_validation->run()==FALSE):
                    echo json_encode($this->form_validation->error_array());exit;
                else:
                    
                    //check if rich customer exist or not
                    $conditionArray = array('inqd_id'=>$id,'inq_id'=>$inq_id);
                    $user_detail = $this->admin_model->getWhere('inquiry_detail',$conditionArray);

                    if(@$user_detail[0]->inqd_id=='')
                    {
                        echo 3;exit;
                    }
                    else
                    {
                        $data = array(
                            'inqd_area' => $record['area'],
							'inqd_ogd'=>$record['ogd'],
							'inqd_efs'=>$record['efs'],
							'inqd_jp'=>$record['jp'],
							'inqd_mSize'=>$record['ms'],
							'inqd_pCoating'=>$record['pc'],
							'inqd_glass'=>$record['glass'],
							'inqd_aSection'=>$record['aluminium'],
							'inqd_addedId'=>$this->session->userdata('userid'),
							'inqd_addedBy'=>$this->session->userdata('adminName').'- admin',
							'inqd_modifiedDate'=>date('y-m-d h:i:s')
						);
						// pre($data);
						// exit;
                        $this->db->update("inquiry_detail",$data,array('inqd_id'=>@$id));
                        $this->session->set_flashdata('Suppliermsg',' Supplier details updated Successfully!!!');

                        echo 1;exit;
                    }
                endif;
            else:
                $template = "admin";
                $record['title'] = 'Investigations Details';
                $record['inquirydetail'] = $this->admin_model->getWhere('inquiry_detail',array('inqd_id'=>$id,'inq_id'=>$inq_id));
                // pre($record);
                // exit;
                if(is_array($record['inquirydetail'])):

                    $record['viewFile'] = "update_investigationdetails";
                    $record['module'] = "inquiry";
                    echo modules::run('template/'.$template,$record);
                else:
                    redirect('inquiry/allinquiries');
                endif;
            endif;
        }
    }

    public function inspectiondetails($id)
	{	
		$adminSession = $this->session->userdata('userid');
		if(empty($adminSession) || $this->session->userdata('adminStatus')=='2')
		{
			redirect(base_url().'admin/dashboard');
		}
		else
		{
			$inq_details = $this->admin_model->getWhere('inquiries',array('inq_id'=>$id));
			// echo $this->db->last_query();
			// pre($inq_details);
			// exit;
			if(is_array($inq_details))
			{
				$template = "admin";
				$record['inq_id'] = $inq_details[0]->inq_id;
				$record['id'] = $this->admin_model->getWhere('inquiry_detail',array('inq_id'=>$id));

				$record['id_img'] = $this->admin_model->getWhere('inq_investigation_imgs',array('inq_id'=>$id));
				// echo $this->db->last_query();
				// pre($record);
				// exit;
				$record['title'] = 'Inquiry Management';
				$record['viewFile'] = "view_investigationdetails";
				$record['module'] = "inquiry";
					
				echo modules::run('template/'.$template,$record);
			}
			else{
				redirect(base_url().'supervisor/dashboard');
			}
		}

	}

	public function upload_photographs($id)
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
				
				$this->form_validation->set_rules('imgdesc','Image Description','trim|xss_clean');

				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					
					$data = array(
						'img_descriptions' => $record['imgdesc'],
						'inq_id'=>$id,
						'img_uploadId'=>$this->session->userdata('userid'),
						'img_uploadBy'=>$this->session->userdata('adminName').'- Admin',
					);
					if($_FILES['image']['size'] != 0):
						$config['upload_path'] = './uploads/inspectionimages';
						$config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF';
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						$this->upload->overwrite = true;

						if (!$this->upload->do_upload('image')) {
							$error = array('error' => $this->upload->display_error());
							$this->session->set_flashdata('flashError', $this->upload->display_errors());
							$res_arrr['status'] = 'fail';
							$res_arrr['msg'] = $error;
							echo json_encode($res_arrr);
							exit;
						} else {
							$image_data = array('upload_data' => $this->upload->data());
							$header_image_name = $image_data['upload_data']['file_name'];
							$data['img_name'] = $header_image_name;
						}
					endif;
					$res = $this->db->insert('inq_investigation_imgs',$data);
					if($res){
						echo 1;
						$this->session->set_flashdata('Inquirymsg',' Photographs added Successfully!!!');
						exit;
					}
					else{
						echo 2;exit;
					}
				endif;
			else:
				$inquirydetail = $this->admin_model->getWhere('inquiries',array('inq_id'=>$id));
				// pre($inquirydetail);
				// exit;
				if(is_array($inquirydetail))
				{
					$template = "admin";
	                $record['title'] = 'Inspection Details';
	                $record['inq_id'] =$inquirydetail[0]->inq_id; 
					$record['viewFile'] = "upload_images";
					$record['module'] = "Inquiry";
					echo modules::run('template/'.$template,$record);
					}
				else{
					redirect('inquiry/allinquiry');
				}
			endif;
		}
	}

	public function update_leadstatus($id)
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
				// pre($record);
				// exit;
				$this->form_validation->set_rules('lead','Lead Status','trim|required|xss_clean');
				$this->form_validation->set_rules('remark','Lead lead remarks','trim|xss_clean');
				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:

					//check if rich customer exist or not
					$conditionArray = array('inq_id'=>$id);
					$user_detail = $this->admin_model->getWhere('inquiries',$conditionArray);
					
					if(@$user_detail[0]->inq_id=='')
					{
						echo 3;exit;
					}
					else
					{
						$date= date('y-m-d');
						$data = array(
						'inq_id'=>$id,
						'lead_remarks'=>$record['remark'],
						'ifr_date'=>$date,
					);
					$this->db->insert("inquiry_fr",$data);
					
					}
					
					$data1 = array(
						
						'lead_status'=>$record['lead'],

						);

						$res = $this->db->update('inquiries',$data1,array('inq_id'=>$id));
						if($res){
							$this->session->set_flashdata('Inquirymsg','Inquiry details added successfully !!!');
							echo 1;exit;
						}
						else{
							echo 2;exit;
						}
				endif;

			else:
				$inquiry = $this->admin_model->getWhere('inquiries',array('inq_id'=>$id));
				if(is_array($inquiry)):
					$data = $inquiry[0];
					
					$data->result = 'success';
					$json = json_encode($data);
					echo $json;
					exit;
				else: 
					redirect(base_url().'inquiry');
				endif;
			endif;
		}
	}

}

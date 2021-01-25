<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Quotation extends MX_Controller
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

		if (empty($adminSession)) {
			redirect(base_url() . 'admin');
		} else if (!in_array('1', $admin_roles)) {
			redirect(base_url() . 'admin/dashboard');
		} else {
			$template = "admin";
			$record['title'] = 'Quotation';
			$record['quotation_list'] = $this->admin_model->quote();

			$record['viewFile'] = "quotationlist";
			$record['module'] = "quotation";
			echo modules::run('template/' . $template, $record);
		}
	}

	public function add_quotation($id)
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		if(empty($adminSession))
		{
			redirect('admin');
		}
		else if(!in_array('9',$admin_roles))
		{
			redirect('admin/dashboard');
		}
		else
		{
			$inq_details = $this->admin_model->makequote($id);
			if(is_array($inq_details)){
				if($this->input->post('isAjax')=='1'):
				$record = $this->input->post();
				

				$this->form_validation->set_rules('wname[]','Work Name','trim|required|xss_clean');
				$this->form_validation->set_rules('wdesc[]','Work Name','trim|required|xss_clean');

				$this->form_validation->set_rules('area[]','Area','trim|required|xss_clean');

				$this->form_validation->set_rules('unit[]','Unit','trim|required|xss_clean');
				
				$this->form_validation->set_rules('price[]','Price','trim|required|xss_clean');

				$this->form_validation->set_rules('amount[]','Amount','trim|required|xss_clean');

				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:

					for ($i=0; $i < count($record['wname']); $i++) { 
						$data[$i] = array(
							'q_id'=>$record['q_id'],
							'temp_name'=>$record['wname'][$i],
							'temp_description'=>$record['wname'][$i],
							'qd_totalArea'=>$record['area'][$i],
							'qd_price'=>$record['price'][$i],
							'qd_unit' => $record['unit'][$i],
							'qd_amount'=>$record['amount'][$i],
							'qd_status'=>'1',
						);
					}
					$res = $this->db->insert_batch('quotationdetails', $data, 'title');
					if($res){
						 $this->db->update('inquiries',array('lead_status'=>5),array('inq_id'=>$record['inq_id']));
						 echo 1;
						 exit;
					}
					else{
						echo 2;exit;
					}


				endif;
			else:
					$quote_id = $this->admin_model->get_quote_id();
					$quotation = array(
						'inq_id'=>$inq_details[0]['inq_id'],
						'q_id' =>$quote_id,
						'c_id'=>$inq_details[0]['c_id'],
						'q_date'=>date('Y-m-d'),
						'q_status'=>1,

					);
					 $this->db->insert('quotation', $quotation);
					$template = "admin";
					$record['title'] = 'Quotation';
					$record['quote_id'] = $quote_id;
					$record['iq'] = $inq_details;
					$record['temp'] = $this->admin_model->getWhere('template',array('temp_status'=>'1'));
					$record['viewFile'] = "add_quotation";
					$record['module'] = "quotation";
					
					
					echo modules::run('template/'.$template,$record);
				endif;	
			}
			else{
				redirect(base_url().'quotation');
			}
			
		}
	}

	public function edit_quotation($q_id,$inq_id)
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		if(empty($adminSession))
		{
			redirect('admin');
		}
		else if(!in_array('9',$admin_roles))
		{
			redirect('admin/dashboard');
		}
		else
		{
			$quotation = $this->admin_model->getquote($inq_id);
			if(is_array($quotation)){
				if($this->input->post('isAjax')=='1'):
				$record = $this->input->post();
				

				$this->form_validation->set_rules('wname[]','Work Name','trim|required|xss_clean');
				$this->form_validation->set_rules('wdesc[]','Work Name','trim|required|xss_clean');

				$this->form_validation->set_rules('area[]','Area','trim|required|xss_clean');

				$this->form_validation->set_rules('unit[]','Unit','trim|required|xss_clean');
				
				$this->form_validation->set_rules('price[]','Price','trim|required|xss_clean');

				$this->form_validation->set_rules('amount[]','Amount','trim|required|xss_clean');

				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:

					for ($i=0; $i < count($record['wname']); $i++) { 
						$data[$i] = array(
							'q_id'=>$record['q_id'],
							'temp_name'=>$record['wname'][$i],
							'temp_description'=>$record['wname'][$i],
							'qd_totalArea'=>$record['area'][$i],
							'qd_price'=>$record['price'][$i],
							'qd_unit' => $record['unit'][$i],
							'qd_amount'=>$record['amount'][$i],
							'qd_status'=>1,
						);
					}

						$this->db->update('quotationdetails',array('qd_status'=>0),array('q_id'=>$record['q_id']));
					$res = $this->db->insert_batch('quotationdetails', $data, 'title');
					if($res){
						 $this->db->update('inquiries',array('lead_status'=>5),array('inq_id'=>$record['inq_id']));
						 echo 1;
						 exit;
					}
					else{
						echo 2;exit;
					}


				endif;
			else:
					$template = "admin";
					$record['title'] = 'Quotation';
					$record['quote_id'] = $quotation[0]['q_id'];
					$record['iq'] = $quotation;
					$record['qd'] = $this->admin_model->getWhere('quotationdetails',array('q_id'=>$inq_id,'qd_status'=>1));
					$record['temp'] = $this->admin_model->getWhere('template',array('temp_status'=>'1'));
					$record['viewFile'] = "edit_quotation";
					$record['module'] = "quotation";
					
					
					echo modules::run('template/'.$template,$record);
				endif;	
			}
			else{
				redirect(base_url().'quotation');
			}
			
		}
	}

	public function view_quotation($q_id,$inq_id)
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		if(empty($adminSession))
		{
			redirect('admin');
		}
		else if(!in_array('9',$admin_roles))
		{
			redirect('admin/dashboard');
		}
		else
		{
			$quotation = $this->admin_model->getquote($inq_id);
			if(is_array($quotation)){
				
					$template = "admin";
					$record['title'] = 'Quotation';
					$record['quote_id'] = $quotation[0]['q_id'];
					$record['iq'] = $quotation;
					$record['qd'] = $this->admin_model->getWhere('quotationdetails',array('q_id'=>$inq_id,'qd_status'=>1));
					$record['temp'] = $this->admin_model->getWhere('template',array('temp_status'=>'1'));
					$record['viewFile'] = "view_quotation";
					$record['module'] = "quotation";
					// pre($record);
					// exit;
					
					echo modules::run('template/'.$template,$record);	
			}
			else{
				redirect(base_url().'quotation');
			}
			
		}
	}

}

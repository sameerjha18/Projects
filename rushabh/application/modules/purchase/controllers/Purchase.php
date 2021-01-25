<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Purchase extends MX_Controller
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
			$record['title'] = 'Purchase Management';
			$id = "purchase_id";
			$record['purchase_list'] = $this->admin_model->getallRec('purchase',$id);
			$record['viewFile'] = "purchaselist";
			$record['module'] = "purchase";
			echo modules::run('template/' . $template, $record);
		}
	}

	public function add_purchase()
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
			if($this->input->post('isAjax')=='1'):
				$record = $this->input->post();
				
				$this->form_validation->set_rules('date','Date','trim|required|xss_clean');
				$this->form_validation->set_rules('supplier','Supplier','trim|required|xss_clean');
				$this->form_validation->set_rules('remark','Purchase description','trim|xss_clean');
				$this->form_validation->set_rules('status','Product brand','trim|xss_clean');
				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:

					$data = array(
						'purchase_date'=>$record['date'],
						's_id'=>$record['supplier'],
						'purchase_remarks'=>$record['remark'],
						'purchase_status'=>$record['status'],
						'purchase_addedBy'=>'admin',
						'purchase_addedId'=>$this->session->userdata('userid'),
						'purchase_modifiedDate'=>date('y-m-d h:i:s'),
						'purchase_createdDate'=>date('y-m-d h:i:s')
					);
					
					$res = $this->db->insert('purchase',$data);
					if($res){
						$response['res'] = $res;
						$response['id'] = $this->db->insert_id();
						echo json_encode($response);
						exit;
					}
					else{
						echo 2;exit;
					}
				endif;
			else:


				$template = "admin";
				$record['sp'] = $this->admin_model->getWhere('supplier',array('s_status'=>'1'));
	
				$record['title'] = 'Purchase';
				$record['viewFile'] = "add_purchase";
				$record['module'] = "purchase";
				echo modules::run('template/'.$template,$record);
			endif;
		}
	}

	public function update_purchase($id)
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
				   // print_r($record);
				   // exit();
				$this->form_validation->set_rules('update', 'Purchase Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules('upsupplier', 'Purchase Supplier Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('remark', 'Purchase Remark', 'trim|xss_clean');
				$this->form_validation->set_rules('ustatus', 'Status', 'trim|xss_clean');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :
					//check if rich customer exist or not
					$conditionArray = array('purchase_id' => $id);
					$user_detail = $this->admin_model->getWhere('purchase', $conditionArray);
					// print_r($user_detail);
					// exit;

					if (@$user_detail[0]->purchase_id == '') {
						echo 3;
						exit;
					} else {
						$data = array(
							'purchase_date' => $record['update'],
							's_id' => $record['upsupplier'],
							'purchase_remarks' => $record['remark'],
							'purchase_status' => $record['ustatus'],
							'purchase_modifiedDate' => date('y-m-d h:i:s'),
						);
						// print_r($data);
						// exit;

						$this->db->update("purchase", $data, array('purchase_id' => @$id));
						$this->session->set_flashdata('Productmsg' . ' Details updated Successfully!!!');

						echo 1;
						exit;
					}
				endif;
			else :
				$record['category'] = $this->admin_model->getWhere('purchase', array('purchase_id' => $id));

				if (is_array($record['category'])) :

					$template = "admin";
					$record['title'] = 'Update Purchase';
					$id = "s_id";
					$record['supplier'] = $this->admin_model->getallRec('supplier',$id);
					$record['viewFile'] = "update_purchase";
					$record['module'] = "purchase";
					echo modules::run('template/' . $template, $record);
				else :
					redirect(base_url() . 'purchase');
				endif;
			endif;
		}
	}
	public function purchasedetail($id)
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

			$purchase = $this->admin_model->getWhere('purchase',array('purchase_status'=>'1','purchase_id'=>$id));
			
			if(is_array($purchase))
			{


				$template = "admin";
				$record['purchase_id'] = $purchase[0]->purchase_id;
			

				$record['title'] = 'Purchase';
				$record['pd'] = $this->admin_model->getpurchase($id);	
			
				$record['viewFile'] = "purchasedetail";
				$record['module'] = "purchase";
				echo modules::run('template/'.$template,$record);
			}
			else{

				redirect('purchase');
			}

		}
	}

	public function add_purchasedetails($id)
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
			if($this->input->post('isAjax')=='1'):
				$record = $this->input->post();
				// print_r($record);
				// exit;
				$this->form_validation->set_rules('product','Product','trim|required|xss_clean');
				$this->form_validation->set_rules('qty','Quantity','trim|required|xss_clean');
				$this->form_validation->set_rules('unit_price','Price','trim|required|xss_clean');

				$this->form_validation->set_rules('status','Status','trim|xss_clean');


				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
					$data = array(
						'purchase_id'=>$id,
						'p_id' => $record['product'],
						'pd_qty'=>$record['qty'],
						'pd_unitprice'=>$record['unit_price'],
						'pd_status' => $record['status'],
						'pd_addedBy' => 'admin',
						'pd_addedId' =>$this->session->userdata('userid'),
						'pd_modifiedDate'=>date('y-m-d h:i:s'),
						'pd_createdDate'=>date('y-m-d h:i:s')
					);
					// print_r($data);
					// exit;
					$res = $this->db->insert('purchase_details',$data);
					if($res){
						echo 1;exit;
					}
					else{
						echo 2;exit;
					}
				endif;
			else:
				$purchase = $this->admin_model->getWhere('purchase',array('purchase_id'=>$id));
				if(is_array($purchase))
				{

					$template = "admin";
					$record['title'] = 'Purchase Details';
					$record['purchase_id'] = $purchase[0]->purchase_id;
					$id = "p_id";
					$record['product'] = $this->admin_model->getallRec('products',$id);
					$record['viewFile'] = "add_purchasedetail";
					$record['module'] = "purchase";
					
					
					echo modules::run('template/'.$template,$record);
				}
				else{
					redirect('purchase');
				}
			endif;
		}
	}
	public function update_purchasedetails($purchase_id,$pd_id)
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

			if($this->input->post('isAjax')=='1'):

				$record = $this->input->post();
					// print_r($record);
					// exit;
				
				$this->form_validation->set_rules('uproduct','Product','trim|required|xss_clean');
				$this->form_validation->set_rules('qty','Designation','trim|required|xss_clean');
				$this->form_validation->set_rules('unit_price','Price','trim|required|xss_clean');;

				$this->form_validation->set_rules('ustatus','Status','trim|xss_clean');

				
				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
				
					
					//check if rich customer exist or not
					$conditionArray = array('pd_id'=>$pd_id,'purchase_id'=>$purchase_id);
					$user_detail = $this->admin_model->getWhere('purchase_details',$conditionArray);
					
					if(@$user_detail[0]->pd_id=='')
					{
						echo 3;exit;
					}
					else
					{
						
						$data = array(
						'purchase_id'=>$purchase_id,
						'p_id' => $record['uproduct'],
						'pd_qty'=>$record['qty'],
						'pd_unitprice'=>$record['unit_price'],
						'pd_status' => $record['ustatus'],
						'pd_addedBy' => 'admin',
						'pd_addedId' =>$this->session->userdata('userid'),
						'pd_modifiedDate'=>date('y-m-d h:i:s')
					);
						$this->db->update("purchase_details",$data,array('pd_id'=>$pd_id));
					
						echo 1;exit;
					}
				endif;
			else:
				
				$pd = $this->admin_model->getWhere('purchase_details',array('purchase_id'=>$purchase_id,'pd_id'=>$pd_id));
					$purchase = $this->admin_model->getWhere('purchase',array('purchase_id'=>$purchase_id,'purchase_status'=>1));

				if(is_array($pd))
				{

					$template = "admin";
					$record['title'] = 'Purchase Details';
					$record['purchase_id'] = $purchase[0]->purchase_id;
					$record['pd'] = $pd;
					$id = "p_id";
					$record['products'] = $this->admin_model->getallRec('products',$id);
					$record['viewFile'] = "update_purchasedetail";
					$record['module'] = "purchase";
					
					
					echo modules::run('template/'.$template,$record);
				}
				else{
					redirect('purchase');
				}
			endif;
		}
	}

	public function add_stock($purchase_id	,$pd_id)
	{

		$pd = $this->admin_model->getWhere('purchase_details',array('purchase_id'=>$purchase_id,'pd_id'=>$pd_id,'pd_addstock'=>0));
		
		if(is_array($pd))
		{

			$pi = $this->admin_model->getwhere('product_inventory',array('p_id'=>$pd[0]->p_id));
			if(is_array($pi))
			{
				$data = array(
						'p_total'=> $pi[0]->p_total + $pd[0]->pd_qty,

						'p_avail'=> $pi[0]->p_avail + $pd[0]->pd_qty,
					);
			$this->db->update("product_inventory",$data,array('p_id'=>$pd[0]->p_id));
				}
			$data1 = array(
						'pd_addstock'=> 1,
						'pd_modifiedDate'=>date('y-m-d h:i:s'),
					);
			$this->db->update("purchase_details",$data1,array('purchase_id'=>$purchase_id,'pd_id'=>$pd_id));
		
			redirect('purchase/purchasedetail/'.$purchase_id);
		}
		else{
			redirect('purchase/purchasedetail/'.$purchase_id);
		}
	}
}

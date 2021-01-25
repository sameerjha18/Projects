<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Billing extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/admin_model');
		$this->load->helper('url');
	}

	public function add_bill()
	{
		$admin_roles = explode(',',$this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');
		if(empty($adminSession))
		{
			redirect('admin');
		}
		else if(!in_array('10',$admin_roles))
		{
			redirect('admin/dashboard');
		}
		else
		{
			if($this->input->post('isAjax')=='1'):
				$record = $this->input->post();
            
				$this->form_validation->set_rules('customer','Customer','trim|xss_clean');
				$this->form_validation->set_rules('paymentmode','Paymeny mode','trim|xss_clean');
				$this->form_validation->set_rules('status','Status','trim|required|xss_clean');
				$this->form_validation->set_rules('cname','Customer Name','trim|required|xss_clean');
				$this->form_validation->set_rules('saddress','Shipping address','trim|required|xss_clean');
				$this->form_validation->set_rules('spincode','Shipping pincode','trim|required|xss_clean');
				$this->form_validation->set_rules('scontact','Shipping contact number','trim|required|xss_clean');
				$this->form_validation->set_rules('product[]','Product','trim|required|xss_clean');

				$this->form_validation->set_rules('qty[]','Product qty','trim|required|xss_clean');

				$this->form_validation->set_rules('unitprice[]','Product unitprice','trim|required|xss_clean');

				$this->form_validation->set_rules('p_avail[]','Product avail','trim|required|xss_clean');

				$this->form_validation->set_rules('p_sold[]','Product sold','trim|required|xss_clean');

				$this->form_validation->set_rules('taxtype[]','Product taxtype','trim|required|xss_clean');
				
				$this->form_validation->set_rules('tax_per[]','Product tax percentage','trim|required|xss_clean');

				$this->form_validation->set_rules('tax_price[]','Product unit price','trim|required|xss_clean');

				if($this->form_validation->run()==FALSE):
					echo json_encode($this->form_validation->error_array());exit;
				else:
            //    print_r($record);
            // exit;
					$data = array(
						'c_id'=>$record['customer'],
						'paymode'=>$record['paymentmode'],
						'inv_amt'=>$record['grand_total'],
						'inv_taxamt'=>$record['grand_taxtotal'],
						'in_createdBy' => 'admin',
						'in_createdId' => $this->session->userdata('userid'),
						'in_modifiedDate'=>date('y-m-d h:i:s'),
						'in_createdDate'=>date('y-m-d h:i:s')
					);

					$res = $this->db->insert('invoice',$data);
					if($res){

						$data1 =  array();

						$data2 =  array();
						for ($i=0; $i < count($record['product']); $i++) { 
							$data1[$i] =  array(
								'invoice_id'=>$this->db->insert_id(),
								'p_id'=> $record['product'][$i],
								'ip_taxprice'=>$record['tax_price'][$i],
								'ip_taxtype'=>$record['taxtype'][$i],
								'ip_taxper'=>$record['tax_per'][$i],
								'p_price'=>$record['unitprice'][$i],
								'ip_qty'=>$record['qty'][$i],
								'ip_addedBy'=>'admin',
								'ip_addedId'=>$this->session->userdata('userid'),
								'ip_createdDate'=>date('y-m-d h:i:s'),
								'ip_modifiedDate'=>date('y-m-d h:i:s')
							);
						}

						for ($j=0; $j < count($record['product']); $j++) { 
							$data2[$j] =  array(
								'p_id'=> $record['product'][$j],
								'p_avail'=>$record['p_avail'][$j]-$record['qty'][$j],
								'p_sold'=>$record['p_sold'][$j] + $record['qty'][$j],
							);
						}

						$this->db->insert_batch('invoice_products', $data1, 'title');
						
						$this->db->update_batch('product_inventory', $data2, 'p_id');
						echo 1;exit;
					}
					else{
						echo 2;exit;
					}
				endif;
			else:


				$template = "admin";
				$record['title'] = 'Billing';
				$record['viewFile'] = "add_bill";
            $record['module'] = "billing";
				$record['products'] = $this->admin_model->getproducts();
				
            $id = "c_id";
				$record['customer'] = $this->admin_model->getallRec('customer',$id);
				$id = "pm_id";
				$record['paymode'] = $this->admin_model->getallRec('paymentmode',$id);
				$id = "t_id";
				$record['taxtype'] = $this->admin_model->getallRec('taxes',$id);
				
				echo modules::run('template/'.$template,$record);
			endif;
		}
   }
   
   public function add_customer()
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
				// 
            $this->form_validation->set_rules('cname', 'Customer name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address1', 'Customer address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address2', 'Customer address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mobile', 'Customer mobile', 'trim|required|xss_clean');
            $this->form_validation->set_rules('alt', 'Customer alt', 'trim|required|xss_clean');
            $this->form_validation->set_rules('pincode', 'Customer Pincode', 'trim|required|xss_clean');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :
					print_r($record);
				exit;
					$data = array(
						'c_name' => $record['cname'],
                  'c_address1' => $record['address1'],
						'c_address2' => $record['address2'],
						'c_mobile' => $record['mobile'],
                  'c_alt' => $record['alt'],
                  'c_pincode' => $record['pincode'],
						'c_modifiedDate' => date('y-m-d h:i:s'),
						'c_createdDate' => date('y-m-d h:i:s')
					);
					$res = $this->db->insert('customer', $data);
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
				$record['title'] = 'Customer Management';
				$record['viewFile'] = "addbill";
				$record['module'] = "billing";
				echo modules::run('template/' . $template, $record);
			endif;
		}
	}
}
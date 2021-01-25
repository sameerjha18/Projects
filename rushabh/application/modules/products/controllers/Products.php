<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Products extends MX_Controller
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
			$record['title'] = 'Products Management';
			$record['p_list'] = $this->admin_model->getWhere('products',array('p_status'=>'1'));
			$record['viewFile'] = "productlist";
			$record['module'] = "products";
			echo modules::run('template/' . $template, $record);
		}
	}

	public function add_products()
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
				// print_r($_FILES);
				// exit;
				$this->form_validation->set_rules('pname', 'Product Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('hsncode', 'Product hsncode', 'trim|xss_clean');
				$this->form_validation->set_rules('pdesc', 'Product Description', 'trim|xss_clean');
				
				$this->form_validation->set_rules('status', 'Status', 'trim|xss_clean');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :
					$data = array(
						'p_name' => $record['pname'],
						'p_hsn' => $record['hsncode'],						
						'p_desc' => $record['pdesc'],
						'p_status' => $record['status'],
						'p_modifiedDate' => date('y-m-d h:i:s'),
						'p_createdDate' => date('y-m-d h:i:s')
					);
					// print_r($data);
					// print_r($_FILES);
					// exit;
					if($_FILES['product']['size'] != 0):
						// print_r($_FILES);
						// exit;
						$config['upload_path'] = './uploads/product';
						$config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF';
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						$this->upload->overwrite = true;

						if (!$this->upload->do_upload('product')) {
							$error = array('error' => $this->upload->display_error());
							$this->session->set_flashdata('flashError', $this->upload->display_errors());
							$res_arrr['status'] = 'fail';
							$res_arrr['msg'] = $error;
							echo json_encode($res_arrr);
							exit;
						} else {
							$image_data = array('upload_data' => $this->upload->data());
							$header_image_name = $image_data['upload_data']['file_name'];
							$data['p_image'] = $header_image_name;
						}
					endif;
					$res = $this->db->insert('products', $data);
					if ($res) {
						echo 1;
						$this->session->set_flashdata('Productmsg', $data['p_name'] . ' details added Successfully!!!');
						exit;
					} else {
						echo 2;
						exit;
					}
				endif;
			else :
				$template = "admin";
				$record['title'] = 'Products Managements';
				$record['viewFile'] = "add_product";
				$record['module'] = "products";
				echo modules::run('template/' . $template, $record);
			endif;
		}
	}

	public function update_products($id)
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
				$this->form_validation->set_rules('upname', 'Products Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('uhsncode', 'Product hsncode', 'trim|xss_clean');
				$this->form_validation->set_rules('updesc', 'Product Description', 'trim|xss_clean');
				$this->form_validation->set_rules('ustatus', 'Status', 'trim|xss_clean');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :
					//check if rich customer exist or not
					$conditionArray = array('p_id' => $id);
					$user_detail = $this->admin_model->getWhere('products', $conditionArray);
					// print_r($user_detail);
					// exit;

					if (@$user_detail[0]->p_id == '') {
						echo 3;
						exit;
					} else {
						$data = array(
							'p_name' => $record['upname'],
							'p_hsn' => $record['uhsncode'],
							'p_desc' => $record['updesc'],
							'p_status' => $record['ustatus'],
							'p_modifiedDate' => date('y-m-d h:i:s'),
						);

						if($_FILES['image']['size'] != 0):
							$config['upload_path'] = './uploads/product';
							$config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF|txt|TXT';
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							$this->upload->overwrite = true;
	 					
							if ( ! $this->upload->do_upload('image')) 
							{
								$error = array('error' => $this->upload->display_error());
								$this->session->set_flashdata('flashError',$this->upload->display_errors());
								$res_arrr['status'] = 'fail';
								$res_arrr['msg'] = $error;
								echo json_encode($res_arrr);exit;
							}
							else
							{
								$image_data = array('upload_data' => $this->upload->data());
								$header_image_name = $image_data['upload_data']['file_name'];
								$data['p_image'] = $header_image_name;
							}
						endif;
						$this->db->update("products", $data, array('p_id' => @$id));
						$this->session->set_flashdata('Productmsg', $data['p_name'] . ' Details updated Successfully!!!');

						echo 1;
						exit;
					}
				endif;
			else :
				$record['category'] = $this->admin_model->getWhere('products', array('p_id' => $id));

				if (is_array($record['category'])) :

					$template = "admin";
					$record['title'] = 'Update Products';
					$record['viewFile'] = "update_product";
					$record['module'] = "products";
					echo modules::run('template/' . $template, $record);
				else :
					redirect(base_url() . 'products');
				endif;
			endif;
		}
	}

	public function product_supplier()
	{
		$admin_roles = explode(',', $this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');

		if (empty($adminSession)) {
			redirect(base_url() . 'admin');
		} else if (!in_array('1', $admin_roles)) {
			redirect(base_url() . 'admin/dashboard');
		} else {
			$template = "admin";
			$record['title'] = 'Products Management';
			$record['sp_list'] = $this->admin_model->getsupplierproducts();
			$record['viewFile'] = "productsupply";
			$record['module'] = "products";
			echo modules::run('template/' . $template, $record);
		}
	}


	public function product_specialized()
	{
		$admin_roles = explode(',', $this->session->userdata('adminRole'));
		$adminSession = $this->session->userdata('userid');

		if (empty($adminSession)) {
			redirect(base_url() . 'admin');
		} else if (!in_array('1', $admin_roles)) {
			redirect(base_url() . 'admin/dashboard');
		} else {
			$template = "admin";
			$record['title'] = 'Products Management';
			$record['sp_list'] = $this->admin_model->getproductspecailized();
			$record['viewFile'] = "product_specialized";
			$record['module'] = "products";
			echo modules::run('template/' . $template, $record);
		}
	}

	


}

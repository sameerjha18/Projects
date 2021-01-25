<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Brand extends MX_Controller
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
			$record['title'] = 'Brand Management';
			$id = "b_id";
			$record['b_list'] = $this->admin_model->getallRec('brands',$id);
			$record['viewFile'] = "brand";
			$record['module'] = "brand";
			echo modules::run('template/' . $template, $record);
		}
	}

	public function add_brand()
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
				// exit;
				$this->form_validation->set_rules('brand', 'Brand', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :
					$data = array(
						'b_name' => $record['brand'],
						'b_status' => $record['status'],
						'b_modifiedDate' => date('y-m-d h:i:s'),
						'b_createdDate' => date('y-m-d h:i:s')
					);
					$res = $this->db->insert('brands', $data);
					if ($res) {
						echo 1;
						$this->session->set_flashdata('brandmsg', $data['b_name'] . ' details added Successfully!!!');
						exit;
					} else {
						echo 2;
						exit;
					}
				endif;
			else :
				$template = "admin";
				$record['title'] = 'Brand Management';
				$record['viewFile'] = "brand";
				$record['module'] = "brand";
				echo modules::run('template/' . $template, $record);
			endif;
		}
	}

	public function update_brand($id)
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
				$this->form_validation->set_rules('brand', 'Brand Name', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :

					//check if rich customer exist or not
					$conditionArray = array('b_id' => $id);
					$user_detail = $this->admin_model->getWhere('brands', $conditionArray);

					if (@$user_detail[0]->b_id == '') {
						echo 3;
						exit;
					} else {
						$data = array(
							'b_name' => $record['brand'],
							'b_status' => $record['status'],
							'b_modifiedDate' => date('y-m-d h:i:s'),
						);
						$this->db->update("brands", $data, array('b_id' => @$id));
						$this->session->set_flashdata('brandmsg', $data['b_name'] . ' details updated Successfully!!!');

						echo 1;
						exit;
					}
				endif;
			else :
				$brand = $this->admin_model->getWhere('brands', array('b_id' => $id));
				if (is_array($brand)) :
					$data = $brand[0];
					$data->result = 'success';
					$json = json_encode($data);
					echo $json;
					exit;
				else :
					redirect(base_url() . 'brand');
				endif;
			endif;
		}
	}
}

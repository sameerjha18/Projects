<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Producttype extends MX_Controller
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
			$record['title'] = 'Product Type Management';
			$id = "t_id";
			$record['t_list'] = $this->admin_model->getallRec('types',$id);
			$record['viewFile'] = "producttype";
			$record['module'] = "producttype";
			echo modules::run('template/' . $template, $record);
		}
	}

	public function add_producttype()
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
				$this->form_validation->set_rules('ptype', 'Product Types', 'trim|required');
				$this->form_validation->set_rules('desc', 'Description Type', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :
					$data = array(
						't_name' => $record['ptype'],
						't_desc' => $record['desc'],
						't_status' => $record['status'],
						't_modifiedDate' => date('y-m-d h:i:s'),
						't_createdDate' => date('y-m-d h:i:s')
					);
					$res = $this->db->insert('types', $data);
					if ($res) {
						echo 1;
						$this->session->set_flashdata('typemsg', $data['t_name'] . ' details added Successfully!!!');
						exit;
					} else {
						echo 2;
						exit;
					}
				endif;
			else :
				$template = "admin";
				$record['title'] = 'Product Types Management';
				$record['viewFile'] = "producttype";
				$record['module'] = "producttype";
				echo modules::run('template/' . $template, $record);
			endif;
		}
	}

	public function update_producttype($id)
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
				$this->form_validation->set_rules('ptype', 'Product Type', 'trim|required');
				$this->form_validation->set_rules('desc', 'Product Description', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :

					//check if rich customer exist or not
					$conditionArray = array('t_id' => $id);
					$user_detail = $this->admin_model->getWhere('types', $conditionArray);

					if (@$user_detail[0]->t_id == '') {
						echo 3;
						exit;
					} else {
						$data = array(
							't_name' => $record['ptype'],
							't_desc' => $record['desc'],
							't_status' => $record['status'],
							't_modifiedDate' => date('y-m-d h:i:s'),
						);
						$this->db->update("types", $data, array('t_id' => @$id));
						$this->session->set_flashdata('typemsg', $data['t_name'] . ' details updated Successfully!!!');

						echo 1;
						exit;
					}
				endif;
			else :
				$type = $this->admin_model->getWhere('types', array('t_id' => $id));
				if (is_array($type)) :
					$data = $type[0];
					$data->result = 'success';
					$json = json_encode($data);
					echo $json;
					exit;
				else :
					redirect(base_url() . 'producttype');
				endif;
			endif;
		}
	}
}

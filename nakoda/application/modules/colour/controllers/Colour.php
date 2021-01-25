<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Colour extends MX_Controller
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
			$record['title'] = 'Colour Management';
			$id = "cl_id";
			$record['c_list'] = $this->admin_model->getallRec('colour',$id);
			$record['viewFile'] = "colour";
			$record['module'] = "colour";
			echo modules::run('template/' . $template, $record);
		}
	}

	public function add_colour()
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
				$this->form_validation->set_rules('colour', 'Colour', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :
					$data = array(
						'cl_name' => $record['colour'],
						'cl_status' => $record['status'],
						'cl_modifiedDate' => date('y-m-d h:i:s'),
						'cl_createdDate' => date('y-m-d h:i:s')
					);
					$res = $this->db->insert('colour', $data);
					if ($res) {
						echo 1;
						$this->session->set_flashdata('colourmsg', $data['cl_name'] . ' details added Successfully!!!');
						exit;
					} else {
						echo 2;
						exit;
					}
				endif;
			else :
				$template = "admin";
				$record['title'] = 'Colour Management';
				$record['viewFile'] = "colour";
				$record['module'] = "colour";
				echo modules::run('template/' . $template, $record);
			endif;
		}
	}

	public function update_colour($id)
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
				$this->form_validation->set_rules('colour', 'Colour Name', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :

					//check if rich customer exist or not
					$conditionArray = array('cl_id' => $id);
					$user_detail = $this->admin_model->getWhere('colour', $conditionArray);

					if (@$user_detail[0]->cl_id == '') {
						echo 3;
						exit;
					} else {
						$data = array(
							'cl_name' => $record['colour'],
							'cl_status' => $record['status'],
							'cl_modifiedDate' => date('y-m-d h:i:s'),
						);
						$this->db->update("colour", $data, array('cl_id' => @$id));
						$this->session->set_flashdata('colourmsg', $data['cl_name'] . ' details updated Successfully!!!');

						echo 1;
						exit;
					}
				endif;
			else :
				$colour = $this->admin_model->getWhere('colour', array('cl_id' => $id));
				if (is_array($colour)) :
					$data = $colour[0];
					$data->result = 'success';
					$json = json_encode($data);
					echo $json;
					exit;
				else :
					redirect(base_url() . 'colour');
				endif;
			endif;
		}
	}
}

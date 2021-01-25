<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Expensetype extends MX_Controller
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
			$record['title'] = 'Expense Type';
			$id = "ex_id";
			$record['ex_list'] = $this->admin_model->getallRec('expensetype',$id);
			$record['viewFile'] = "expensetype";
			$record['module'] = "expensetype";
			echo modules::run('template/' . $template, $record);
		}
	}

	public function add_expensetype()
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
				$this->form_validation->set_rules('Expensetype', 'Expense Type', 'trim|required|xss_clean');
				$this->form_validation->set_rules('desc', 'Expense Description', 'trim|xss_clean');
				$this->form_validation->set_rules('status', 'Status', 'trim|xss_clean');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :
					$data = array(
						'ex_type' => $record['Expensetype'],
						'ex_desc' => $record['desc'],
						'ex_status' => $record['status'],
						'ex_modifiedDate' => date('y-m-d h:i:s'),
						'ex_createdDate' => date('y-m-d h:i:s')
					);
					$res = $this->db->insert('expensetype', $data);
					if ($res) {
						echo 1;
						$this->session->set_flashdata('expensemsg', $data['ex_type'] . ' details added Successfully!!!');
						exit;
					} else {
						echo 2;
						exit;
					}
				endif;
			else :
				$template = "admin";
				$record['title'] = 'Expense Mode';
				$record['viewFile'] = "expensetype";
				$record['module'] = "expensetype";
				echo modules::run('template/' . $template, $record);
			endif;
		}
	}

	public function update_expensetype($id)
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
				$this->form_validation->set_rules('epensetype', 'Expense Type', 'trim|required|xss_clean');
				$this->form_validation->set_rules('desc', 'Expense Description', 'trim|xss_clean');
				$this->form_validation->set_rules('status', 'Status', 'trim|xss_clean');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :

					//check if rich customer exist or not
					$conditionArray = array('ex_id' => $id);
					$user_detail = $this->admin_model->getWhere('expensetype', $conditionArray);

					if (@$user_detail[0]->ex_id == '') {
						echo 3;
						exit;
					} else {
						$data = array(
							'ex_type' => $record['epensetype'],
							'ex_desc' => $record['desc'],
							'ex_status' => $record['status'],
							'ex_modifiedDate' => date('y-m-d h:i:s'),
						);
						$this->db->update("expensetype", $data, array('ex_id' => @$id));
						$this->session->set_flashdata('expensemsg', $data['ex_type'] . ' details updated Successfully!!!');

						echo 1;
						exit;
					}
				endif;
			else :
				$expensetype = $this->admin_model->getWhere('expensetype', array('ex_id' => $id));
				if (is_array($expensetype)) :
					$data = $expensetype[0];
					$data->result = 'success';
					$json = json_encode($data);
					echo $json;
					exit;
				else :
					redirect(base_url() . 'expensetype');
				endif;
			endif;
		}
	}
}

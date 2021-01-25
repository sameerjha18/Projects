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
			$id = "p_id";
			$record['p_list'] = $this->admin_model->getallRec('products',$id);
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
				// exit;
				$this->form_validation->set_rules('type', 'Product Types ', 'trim|required');
				$this->form_validation->set_rules('pname', 'Product Name  ', 'trim|required');
				$this->form_validation->set_rules('pcode', 'Product Types ', 'trim|required');
				$this->form_validation->set_rules('colour', 'Product colour  ', 'trim|required');
				$this->form_validation->set_rules('tax', 'Product tax  ', 'trim|required');
				$this->form_validation->set_rules('dimension', 'Product Dimension  ', 'trim|required');
				$this->form_validation->set_rules('brand', 'Product Brands', 'trim|required');
				$this->form_validation->set_rules('status', 'Status', 'trim|required');

				if ($this->form_validation->run() == FALSE) :
					echo json_encode($this->form_validation->error_array());
					exit;
				else :
					$data = array(
						't_id' => $record['type'],
						'p_name' => $record['pname'],
						'p_code' => $record['pcode'],
						'cl_id' => $record['colour'],
						'd_id' => $record['dimension'],
						'b_id' => $record['brand'],
						'p_tax' => $record['tax'],
						'p_status' => $record['status'],
						'p_modifiedDate' => date('y-m-d h:i:s'),
						'p_createdDate' => date('y-m-d h:i:s')
					);

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
						// print_r($_FILES);
						// exit;
						$image_data = array('upload_data' => $this->upload->data());
						$header_image_name = $image_data['upload_data']['file_name'];
						$data['p_image'] = $header_image_name;
					}

					$res = $this->db->insert('products', $data);
					//echo $this->db->lastquery();
					if ($res) {
						$p_id = $this->db->insert_id();
						$p_inventory = 
							array(
							'p_id' => $p_id,
							'p_total' => 0,
							'p_avail' => 0,
							'p_sold' => 0,
							'p_damage' => 0,
							'pi_status' => 1,
							'pi_modifiedDate' => date('y-m-d h:i:s'),
							'pi_createdDate' => date('y-m-d h:i:s')
						);
						$this->db->insert('product_inventory',$p_inventory);
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
				$t_id = "t_id";
				$record['type'] = $this->admin_model->getallRec('types',$t_id);
				$c_id = "cl_id";
				$record['colour'] = $this->admin_model->getallRec('colour',$c_id);
				$d_id = "d_id";
				$record['dimension'] = $this->admin_model->getallRec('dimension',$d_id);
				$b_id = "b_id";
				$record['brand'] = $this->admin_model->getallRec('brands',$b_id);
				$t_id = "t_id";
				$record['tax'] = $this->admin_model->getallRec('taxes',$t_id);
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
				$this->form_validation->set_rules('uptype', 'Products Type', 'trim|required');
				$this->form_validation->set_rules('upname', 'Products Name', 'trim|required');
				$this->form_validation->set_rules('upcode', 'Products Code', 'trim|required');
				$this->form_validation->set_rules('upcolour', 'Products Colour', 'trim|required');
				$this->form_validation->set_rules('updimension', 'Products Dimension', 'trim|required');
				$this->form_validation->set_rules('ubrand', 'Products Brand', 'trim|required');
				$this->form_validation->set_rules('ustatus', 'Status', 'trim|required');
				$this->form_validation->set_message('numeric', 'Mobile number should be numeric');

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
							't_id' => $record['uptype'],
							'p_name' => $record['upname'],
							'p_code' => $record['upcode'],
							'cl_id' => $record['upcolour'],
							'd_id' => $record['updimension'],
							'b_id'=>$record['ubrand'],
							'p_status' => $record['ustatus'],
							'p_modifiedDate' => date('y-m-d h:i:s'),
						);

						$config['upload_path'] = './uploads/product';
						$config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF';
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						$this->upload->overwrite = true;
 
						if ( ! $this->upload->do_upload('uimage')) 
						{
							$error = array('error' => $this->upload->display_error());
							$this->session->set_flashdata('flashError',$this->upload->display_errors());
							$res_arrr['status'] = 'fail';
							$res_arrr['msg'] = $error;
							echo json_encode($res_arrr);exit;
						}
						else
						{
							// print_r($_FILES);s
							// exit;
							$image_data = array('upload_data' => $this->upload->data());
							$header_image_name = $image_data['upload_data']['file_name'];
							$data['p_image'] = $header_image_name;
						}

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
					$record['type'] = $this->admin_model->getWhere('types',array('t_status'=>'1'));
					$conditionArray = array('d_id' => $id);
					$record['dimension'] = $this->admin_model->getWhere('dimension',array('d_status'=>'1'));
					$id = "cl_id";
					$record['colour'] = $this->admin_model->getAllRec('colour',$id);
					$record['brand'] = $this->admin_model->getWhere('brands',array('b_status'=>'1'));
					$record['viewFile'] = "update_product";
					$record['module'] = "products";
					echo modules::run('template/' . $template, $record);
				else :
					redirect(base_url() . 'products');
				endif;
			endif;
		}
	}

	public function update_educationdetail($id)
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
//                    print_r($record);
//                    exit();

				  $this->form_validation->set_rules('ueducation','Employee education education ','trim|required');
				  $this->form_validation->set_rules('ustartedIn','Employee education started In ','trim|required');
				  $this->form_validation->set_rules('uendIn','Employee education End In ','trim|required|required');
				  $this->form_validation->set_rules('uextrainfo','Employee education detail  ','trim|required');
				  $this->form_validation->set_rules('ustatus','Status','trim|required');

					if($this->form_validation->run()==FALSE):
						 echo json_encode($this->form_validation->error_array());exit;
					else:
						 //check if rich customer exist or not
						 $conditionArray = array('ed_id'=>$id);
						 $user_detail = $this->admin_model->getWhere('educations_detail',$conditionArray);
						 // print_r($user_detail);
						 // exit;

						 if(@$user_detail[0]->ed_id=='')
						 {
							  echo 3;exit;
						 }
						 else
						 {
							  $data = array(
						  'edu_id' => $record['ueducation'],
						  'ed_startedIn'=>$record['ustartedIn'],
						  'ed_endIn'=>$record['uendIn'],
						  'ed_extraInfo'=>$record['uextrainfo'],
						  'ed_status' => $record['ustatus'],
						  'ed_modifiedDate'=>date('y-m-d h:i:s'),
							  );

					  $config['upload_path'] = './uploads/education';
					  $config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF';
					  $this->load->library('upload', $config);
					  $this->upload->initialize($config);
					  $this->upload->overwrite = true;

					  if ( ! $this->upload->do_upload('uimage')) 
					  {
						  $error = array('error' => $this->upload->display_error());
						  $this->session->set_flashdata('flashError',$this->upload->display_errors());
						  $res_arrr['status'] = 'fail';
						  $res_arrr['msg'] = $error;
						  echo json_encode($res_arrr);exit;
					  }
					  else
					  {
						  // print_r($_FILES);s
						  // exit;
						  $image_data = array('upload_data' => $this->upload->data());
						  $header_image_name = $image_data['upload_data']['file_name'];
						  $data['ed_image'] = $header_image_name;
					  }

							  $this->db->update("educations_detail",$data,array('ed_id'=>@$id));
							  $this->session->set_flashdata('Educationmsg',$data['edu_id'].' Details updated Successfully!!!');

							  echo 1;exit;
						 }
					endif;
		  else:
			  $education= $this->admin_model->getWhere('educations_detail',array('ed_id'=>$id));
			  // print_r($education);
			  // exit;
			  if(is_array($education)):
				  
						$template = "admin";
				  $record['title'] = 'Update Education Details';
				  $record['education']= $education;
				  $record['id'] =$education[0]->e_id;
				  $record['education_list'] = $this->admin_model->getallRec('education');
						 $record['viewFile'] = "update_educationdetail";
						 $record['module'] = "employee";
						 echo modules::run('template/'.$template,$record);
					else:
						 redirect(base_url().'employee');
					endif;
			  endif;
	  }
  }
}

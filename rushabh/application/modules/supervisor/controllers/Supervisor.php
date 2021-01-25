<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Supervisor extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('supervisorlogin/supervisor_model');
		$this->load->helper('url');

	}
	public function index()
	{

		$supervisorSession = $this->session->userdata('userid');
		if(!empty($supervisorSession) || $this->session->userdata('supervisorStatus')=='1')
		{
			redirect(base_url().'supervisor/dashboard');
		}
		else{

			redirect(base_url().'supervisorlogin');
		}
	}

	public function dashboard()
	{
		$supervisorSession = $this->session->userdata('userid');
		if(empty($supervisorSession) || $this->session->userdata('supervisorStatus')=='2')
		{
			redirect(base_url().'supervisorlogin');
		}
		else
		{
			$template = "supervisor";
			$record['title'] = 'Supervisor - Dashboard';
			$record['viewFile'] = "dashboard";
			$record['module'] = "supervisor";
			echo modules::run('template/'.$template,$record);
		}
	}

	public function allinquiry()
    {
		$supervisorSession = $this->session->userdata('userid');
		if(empty($supervisorSession) || $this->session->userdata('supervisorStatus')=='2')
		{
			redirect(base_url().'supervisor/dashboard');
		}
		else
		{
			$inq_details = $this->supervisor_model->get_inquiry();

				$template = "supervisor";
				$record['inq'] = $inq_details;
				$record['title'] = 'Inquiry Management';
				$record['viewFile'] = "all_inquiry";
				$record['module'] = "supervisor";
					
				echo modules::run('template/'.$template,$record);
		}
	}

	public function inspectiondetails($id)
	{	
		$supervisorSession = $this->session->userdata('userid');
		if(empty($supervisorSession) || $this->session->userdata('supervisorStatus')=='2')
		{
			redirect(base_url().'supervisor/dashboard');
		}
		else
		{
			$inq_details = $this->supervisor_model->getWhere('inquiries',array('inq_id'=>$id));
			// echo $this->db->last_query();
			// pre($inq_details);
			// exit;
			if(is_array($inq_details))
			{
				$template = "supervisor";
				$record['inq_id'] = $inq_details[0]->inq_id;
				$record['id'] = $this->supervisor_model->getWhere('inquiry_detail',array('inq_id'=>$id));
				$record['id_img'] = $this->supervisor_model->getWhere('inq_investigation_imgs',array('inq_id'=>$id));
				// echo $this->db->last_query();
				// pre($record);
				// exit;
				$record['title'] = 'Inquiry Management';
				$record['viewFile'] = "view_inquirydetails";
				$record['module'] = "supervisor";
					
				echo modules::run('template/'.$template,$record);
			}
			else{
				redirect(base_url().'supervisor/dashboard');
			}
		}

	}

	public function add_inquirydetails($id)
	{
		$supervisor_roles = explode(',',$this->session->userdata('supervisorRole'));
		
		$supervisorSession = $this->session->userdata('userid');
	
		if(empty($supervisorSession))
		{
			redirect(base_url().'supervisorlogin');
		}
		else if(!in_array('1',$supervisor_roles))
		{
			redirect(base_url().'supervisor/dashboard');
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
						'inqd_addedBy'=>$this->session->userdata('supervisorName'),
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
				$inquirydetail = $this->supervisor_model->getWhere('inquiries',array('inq_id'=>$id));
				// pre($inquirydetail);
				// exit;
				if(is_array($inquirydetail))
				{
					$template = "supervisor";
	                $record['title'] = 'Supervisor Details';
	                $record['inq_id'] =$inquirydetail[0]->inq_id; 
					$record['viewFile'] = "add_inquiryform";
					$record['module'] = "supervisor";
					echo modules::run('template/'.$template,$record);
					}
				else{
					redirect('supervisor/allinquiry');
				}
			endif;
		}
	}
	
	public function update_inquirydetails($id,$inq_id)
    {

		$supervisor_roles = explode(',',$this->session->userdata('supervisorRole'));
		
		$supervisorSession = $this->session->userdata('userid');
	
		if(empty($supervisorSession))
		{
			redirect(base_url().'supervisorlogin');
		}
		else if(!in_array('1',$supervisor_roles))
		{
			redirect(base_url().'supervisor/dashboard');
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
                    $user_detail = $this->supervisor_model->getWhere('inquiry_detail',$conditionArray);

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
							'inqd_addedBy'=>$this->session->userdata('supervisorName'),
							'inqd_modifiedDate'=>date('y-m-d h:i:s')
						);
                        $this->db->update("inquiry_detail",$data,array('inqd_id'=>@$id));
                        $this->session->set_flashdata('Suppliermsg',' Supplier details updated Successfully!!!');

                        echo 1;exit;
                    }
                endif;
            else:
                $template = "supervisor";
                $record['title'] = 'Update Inquiry Detail';
                $record['inquirydetail'] = $this->supervisor_model->getWhere('inquiry_detail',array('inqd_id'=>$id,'inq_id'=>$inq_id));

                if(is_array($record['inquirydetail'])):

                    $record['viewFile'] = "update_inquiryform";
                    $record['module'] = "supervisor";
                    echo modules::run('template/'.$template,$record);
                else:
                    redirect(base_url().'supervisor/allinquiry');
                endif;
            endif;
        }
    }

    public function upload_photographs($id)
	{
		$supervisor_roles = explode(',',$this->session->userdata('supervisorRole'));
		
		$supervisorSession = $this->session->userdata('userid');
	
		if(empty($supervisorSession))
		{
			redirect(base_url().'supervisorlogin');
		}
		else if(!in_array('1',$supervisor_roles))
		{
			redirect(base_url().'supervisor/dashboard');
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
						'img_uploadBy'=>$this->session->userdata('supervisorName').'- supervisor',
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
						$this->session->set_flashdata('Supervisormsg',' Inquiry details added Successfully!!!');
						exit;
					}
					else{
						echo 2;exit;
					}
				endif;
			else:
				$inquirydetail = $this->supervisor_model->getWhere('inquiries',array('inq_id'=>$id));
				// pre($inquirydetail);
				// exit;
				if(is_array($inquirydetail))
				{
					$template = "supervisor";
	                $record['title'] = 'Inspection Details';
	                $record['inq_id'] =$inquirydetail[0]->inq_id; 
					$record['viewFile'] = "upload_images";
					$record['module'] = "supervisor";
					echo modules::run('template/'.$template,$record);
					}
				else{
					redirect('supervisor/allinquiry');
				}
			endif;
		}
	}
	
}
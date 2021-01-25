<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MX_Controller
{

	public function admin($data)
	{
		$this->load->view('admin', $data);
	}
    public function staff($record)
    {

        $this->load->view('stafflogin',$record);

    }
    public function supervisor($data)
	{
		$this->load->view('supervisors', $data);
	}
}

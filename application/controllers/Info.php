<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends Main_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('info_model');
	}

	//----------------------------------------------------------------------------------
	// All Companies
	public function index()
	{           
                $data['title'] = 'About Us';
                $data['layout'] = 'info';
                $this->load->view('layout', $data);
 
	}
}

?> 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Main_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('employers/auth_model','auth_model');
		$this->load->library('mailer'); // load custom mailer library
	}
	public function index()
	{

			$data['title'] = 'Employers';
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'employers/home/index';
			$this->load->view('layout', $data);
		
	}	
		

}

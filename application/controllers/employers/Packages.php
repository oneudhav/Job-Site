<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->rbac->check_emp_authentiction();	
		$this->load->library('paypal_lib');
		$this->load->model('employers/package_model', 'package_model');
		$this->load->model('employers/company_model','company_model');
		$this->load->model('payment_model');
	}

	//------------------------------------------------------------------------
	public function index()
	{	
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);
		$data['packages'] = $this->package_model->get_all_pakages();

		$data['title'] = 'Packages';
		$data['layout'] = 'employers/packages/packages_list';
		$this->load->view('layout', $data);
	}

	//------------------------------------------------------------------------
	public function buy()
	{
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);
		$package_id = $this->input->post('package_id');
		$package_detail = $this->package_model->get_package_by_id($package_id);
		
		if($package_detail['price'] == 0){
			$buyer_data = array(
	    	'employer_id' => emp_id(),
	    	'package_id' =>  $package_detail['id'],
	    	'expire_date' => add_days_to_date($package_detail['no_of_days']),
	    	'buy_date' => date('Y-m-d : h:m:s'),
	    	);

	    	if(emp_id()){
	    		// deactive the employer prev package
		   		$this->payment_model->deactive_emp_prev_package(); 
		   		// add new package
		   		$this->payment_model->insert_buyer_package($buyer_data);
		    	redirect(base_url('employers/dashboard'));
		    }
		    exit();
		}

		// Set variables for paypal form
        $returnURL = base_url().'paypal/success';
        $cancelURL = base_url().'paypal/cancel';
        $notifyURL = base_url().'paypal/ipn';
        
        
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $package_detail['title']);
        $this->paypal_lib->add_field('item_number',  $package_detail['id']);
        $this->paypal_lib->add_field('amount',  $package_detail['price']);
        $this->paypal_lib->add_field('payer_id',  emp_id());
        $this->paypal_lib->add_field('rm',  2);
        $this->paypal_lib->add_field('handling',  0);
        
        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
	}

	//-------------------------------------------------------------------------------
	public function bought()
	{	
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);
		$data['package_detail'] = $this->package_model->get_employer_packages($emp_id);

		$data['emp_sidebar'] = 'employers/emp_sidebar'; // load sidebar for employer
		
		$data['title'] = 'Packages';
		$data['layout'] = 'employers/packages/employer_packages_bought';
		$this->load->view('layout', $data);
	}

	public function order_confirmation()
	{
		$this->rbac->check_emp_authentiction();
		$emp_id = $this->session->userdata('employer_id');
		$data['company_info'] = $this->company_model->get_company_info_by_id($emp_id);
		$package_id = $this->input->post('package_id');

		$data['package_detail'] = $this->package_model->get_package_by_id($package_id);

		$data['title'] = 'Order Confirmation';
		$data['layout'] = 'employers/packages/order_confirmation';
		$this->load->view('layout', $data);
	}

}// endClass

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model 
{

	//-----------------------------------------------------
	//Get Education
    function get_education($user_id)
    {
   	   $this->db->from('education');
	   $this->db->where('user_id',$user_id);
	   $query = $this->db->get();
	   return $query->result_array();
    }	

	//-------------------------------------------------------------
	// Experience
    function get_experience($user_id)
    {
   	   $this->db->from('experience');
	   $this->db->where('user_id',$user_id);
	   $query = $this->db->get();
	   return $query->result_array();
    }

    //-----------------------------------------------------------
    // Get Compnay record by ID
	function get_company($id=0)
	{
		if($id==0)
		{
			return  $this->db->select('id,name,company_logo')->from('company')->where('active',1)->get()->result_array();	
		}
		else
		{
			return  $this->db->select('id,name,company_logo')->from('company')->where('active',1)->where('id',$id)->get()->row_array();	
		}
	}

	//-----------------------------------------------
	// Get industries
    function get_industries_list()
    {
   	   $this->db->from('xx_industries');
   	   $this->db->order_by('name');
	   $query = $this->db->get();
	   return $query->result_array();
    }

	//-----------------------------------------------
	// Get Categories
    function get_categories_list()
    {
   	   $this->db->from('xx_categories');
   	   $this->db->order_by('name');
	   $query = $this->db->get();
	   return $query->result_array();
    }	

    //-----------------------------------------------
	// Get Blog Categories
    function get_blog_categories_list()
    {
   	   $this->db->from('xx_blog_categories');
   	   $this->db->order_by('name');
	   $query = $this->db->get();
	   return $query->result_array();
    }	

	//------------------------------------------------
	// Get Countries
	function get_countries_list($id=0)
	{
		if($id==0)
		{
			return  $this->db->get('xx_countries')->result_array();	
		}
		else
		{
			return  $this->db->select('id,country')->from('xx_countries')->where('id',$id)->get()->row_array();	
		}
	}
			

	//------------------------------------------------
	// Get Cities
	function get_cities_list($id=0)
	{
		if($id==0){
			return  $this->db->get('xx_cities')->result_array();	
		}
		else{
			return  $this->db->select('id,city')->from('xx_cities')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------
	// Get States
	function get_states_list($id=0)
	{
		if($id==0){
			return  $this->db->get('xx_states')->result_array();	
		}
		else{
			return  $this->db->select('id,s')->from('xx_cities')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------
	// Get Nationality
	function get_nationality_dd($id=0)
	{
		if($id==0){
			return  $this->db->get('xx_nationality')->result_array();	
		}
		else{
			return  $this->db->select('id,nationality')->from('xx_nationality')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------	
	// Get the Education Status Dropdown
	public function get_education_list()
	{
		return $this->db->get('xx_education')->result_array();
	}

	//------------------------------------------------	
	// Get the Education Status Dropdown
	public function get_visa_status()
	{
		return $this->db->get('xx_visa_status')->result_array();
	}

	//------------------------------------------------	
	// Get the Salary Offered Dropdown
	public function get_salary_list()
	{
		return $this->db->get('xx_expected_salary')->result_array();
	}
	function get_job_deadline()
    {
   	   $this->db->from('xx_job_post');
   	   $this->db->order_by('deadline');
	   $query = $this->db->get();
	   return $query->result_array();
    }
	function get_all_job_type()
    {
		return $this->db->get('xx_job_type')->result_array();
    }

    function add_job_type($data)
    {
    	$this->db->insert('xx_job_type',$data);
    	return true;
    }

	//---------------------------------------------------
	// Get type detial by ID
	public function get_job_type_by_id($id){
		$query = $this->db->get_where('xx_job_type', array('id' => $id));
		return $result = $query->row_array();
	}

	//---------------------------------------------------
	// Edit type 
	public function edit_job_type($data, $id){
		$this->db->where('id', $id);
		$this->db->update('xx_job_type', $data);
		return true;
	}
} // endClass
?>
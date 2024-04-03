<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Model extends CI_Model{

	//-------------------------------------------------------------------
    // contant us 
	public function contact($data)
	{
		$this->db->insert('xx_contact_us',$data);
		return true;
	}
	public function aboutus($data)
	{
		$this->db->insert('xx_aboutus',$data);
		return true;
	}
	public function resume($data)
	{
		$this->db->insert('xx_resume',$data);
		return true;
	}

	//-------------------------------------------------------------------
	// Get jobs for home page
	public function get_jobs($limit, $offset)
	{
		$this->db->select('id, title, company_id, job_slug, job_type, description, country,is_tops,is_hots,is_premium, city, created_date, industry,deadline,job_img');
		$this->db->from('xx_job_post');
		$this->db->where('is_status', 'active');
		$this->db->order_by('created_date','desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_hot_jobs($limit, $offset)
	{
		$this->db->select('id, title, company_id,job_slug,city,is_hots,deadline');
		$this->db->from('xx_job_post');
		$this->db->where('is_hots', '1');
		$this->db->order_by('title');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_top_jobs($limit, $offset)
	{
		$this->db->select('id, title, company_id,job_slug,deadline,created_date,is_tops,city,country');
		$this->db->from('xx_job_post');
		$this->db->where('is_tops', '1');
		$this->db->order_by('created_date');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_premium_jobs($limit, $offset)
	{
		$this->db->select('id, title, company_id,job_slug,deadline,industry,created_date,is_premium,city,country');
		$this->db->from('xx_job_post');
		$this->db->where('is_premium', '1');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_testimonials()
	{
		$this->db->select('xx_testimonials.*');
		$this->db->from('xx_testimonials');
		$this->db->order_by('name,position,desc,created_at');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_ads()
	{
		$this->db->select('xx_ads.*');
		$this->db->from('xx_ads');
		$this->db->order_by('img,title,url');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_righttopads()
	{
		$this->db->select('xx_ads_righttop.*');
		$this->db->from('xx_ads_righttop');
		$this->db->order_by('img,title,url');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_slider()
	{
		$this->db->select('xx_slider.*');
		$this->db->from('xx_slider');
		$this->db->order_by('img,url');
		$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_events()
	{
		$this->db->select('xx_events.*');
		$this->db->from('xx_events');
		$this->db->order_by('img,url');
		$this->db->limit(2);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function loadmore(){
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$this->load->model('home_model');
		$result  = $this->home_model->get_industry_with_jobs($offset,$limit);
		$data['view'] = $result;
		$data['offset'] =$offset +10;
		$data['limit'] =$limit;
		echo json_encode($data);
	  }

	//----------------------------------------------------
	// Get those citites who have jobs
	public function get_cities_with_jobs()
	{
		$this->db->select('city as name, COUNT(city) as total_jobs');
		$this->db->from('xx_job_post');
		$this->db->group_by('city');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_states_with_jobs()
	{
		$this->db->select('state as name, COUNT(state) as total_jobs');
		$this->db->from('xx_job_post');
		$this->db->group_by('state');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_industry_with_jobs()
	{
		$this->db->select('industry as industry_id, COUNT(industry) as total_jobs');
		$this->db->from('xx_job_post');
		$this->db->group_by('industry');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array();
	}


	// Get companies logos for home page
	public function get_companies_logo()
	{
		$this->db->select('id,employer_id,company_slug, company_logo');
		$this->db->from('xx_companies');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_latest_blog_post()
	{
		$this->db->select('xx_blog_posts.*');
		$this->db->from('xx_blog_posts');
		$this->db->order_by('created_at','desc');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array();
	}

	//get page
    public function get_page($slug)
    {
        $this->db->where('slug', $slug);
        $this->db->where('is_active', 1);
        $query = $this->db->get('xx_pages');
        return $query->row_array();
    }

}

?>
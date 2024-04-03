<?php
class Testimonials_model extends CI_Model{

	public function test_add($data){
        $this->db->insert('xx_testimonials', $data);
        return true;
    }

	public function get_all_testimonials(){
		$this->db->order_by('id','img','name','position','desc');
		$query = $this->db->get('xx_testimonials');
		return $result = $query->result_array();
	}
  
}
?>
<?php
class Slider_model extends CI_Model{

	public function slider_add($data){
        $this->db->insert('xx_slider', $data);
        return true;
    }

	public function get_all_slider(){
		$this->db->order_by('id','img','name','position','desc');
		$query = $this->db->get('xx_slider');
		return $result = $query->result_array();
	}
  
}
?>
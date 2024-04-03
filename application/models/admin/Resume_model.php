<?php
class Resume_model extends CI_Model{


	public function get_all_resume(){
		$this->db->order_by('id','uploads');
		$query = $this->db->get('xx_resume');
		return $result = $query->result_array();
	}
  
}
?>
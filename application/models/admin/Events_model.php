<?php
class Events_model extends CI_Model{

	public function event_add($data){
        $this->db->insert('xx_events', $data);
        return true;
    }
  

	public function get_all_events(){
		$this->db->order_by('id','img','url','title');
		$query = $this->db->get('xx_events');
		return $result = $query->result_array();
	}
        
}
?>
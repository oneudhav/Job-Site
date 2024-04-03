<?php
class Ads_model extends CI_Model{

	public function ads_add($data){
        $this->db->insert('xx_ads', $data);
        return true;
    }
    public function bottomads_add($data){
        $this->db->insert('xx_ads', $data);
        return true;
    }
    public function righttopads_add($data){
        $this->db->insert('xx_ads_righttop', $data);
        return true;
    }
	public function get_all_ads(){
		$this->db->order_by('id','img','url','title');
		$query = $this->db->get('xx_ads');
		return $result = $query->result_array();
	}
        
}
?>
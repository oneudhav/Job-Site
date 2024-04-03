<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Info_Model extends CI_Model{

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

	
}

?>
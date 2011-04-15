<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Othertextmodel extends CI_Model {
	
	var $otxt_id 		= 0;
	var $otxt_content	= "";
	var $otxt_note 		= "";
	var $otxt_help 		= "";
		
	function __construct(){
        
		parent::__construct();
    }
	
	function read_text($id){
		
		$this->db->where('otxt_id',$id);
		$query = $this->db->get('tbl_othertext',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['otxt_content'];
		return NULL;
	}
	
	function read_group($start,$end){
		
		$this->db->order_by('otxt_id');
		$this->db->where('otxt_id >=',$start);
		$this->db->where('otxt_id <=',$end);
		$query = $this->db->get('tbl_othertext');
		return $query->result_array();
	}

	function writetext($id,$note){
	
		$this->db->set('otxt_content',trim($note));
		$this->db->where('otxt_id',$id);
		$this->db->update('tbl_othertext');
	}
}
?>
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Associationmodel extends CI_Model {
	
	var $asc_id	 		= 0;
	var $asc_title 		= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function read_record($id){
		$this->db->where('asc_id',$id);
		$query = $this->db->get('tbl_association',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records(){
	
		$query = $this->db->get('tbl_association');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function insert_record($title){
		
		$this->asc_title	= htmlspecialchars(trim($title));
		
		$this->db->insert('tbl_association',$this);
		return $this->db->insert_id();
	}

	function update_record($title){
		
		$this->db->set('asc_title',htmlspecialchars($updatedata['title']));
		$this->db->update('tbl_association');
	}

	function assoc_exist($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_association',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['asc_id'];
		return FALSE;
	}
}
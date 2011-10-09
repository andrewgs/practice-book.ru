<?php

class Excelledmodel extends CI_Model {
	
	var $exc_id 	= 0;
	var $exc_userid = 0;
	var $exc_date 	= "";
	var $exc_type	= "";
	var $exc_object	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function insert_record($userid,$type,$object){
		
		$this->exc_userid 	= $userid;
		$this->exc_date 	= date("Y-m-d");
		$this->exc_type 	= $type;
		$this->exc_object 	= $object;
		$this->db->insert('tbl_excelled',$this);
		return $this->db->insert_id();
	}
	
	function delete_records($userid,$type,$object){
	
		$this->db->where('exc_userid',$userid);
		$this->db->where('exc_type',$type);
		$this->db->where('exc_object',$object);
		$this->db->delete('tbl_excelled');
		return $this->db->affected_rows();
	}
	
	function excelled_user($userid,$type,$object){
		
		$this->db->where('exc_userid',$userid);
		$this->db->where('exc_type',$type);
		$this->db->where('exc_object',$object);
		$query = $this->db->get('tbl_excelled');
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>
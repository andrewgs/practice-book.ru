<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Departmentsmodel extends CI_Model {
	
	var $dep_id 		= 0;
	var $dep_title 		= '';
	
	function __construct(){
	
		parent::__construct();
	}
	
	function insert_record($title){
			
		$this->dep_title = $title;
		$this->db->insert('tbl_departments',$this);
		return $this->db->insert_id();
	}
	
	function save_department($id,$title){
			
		$this->db->set('dep_title',htmlspecialchars($title));
		$this->db->where('dep_id',$id);
		$this->db->update('tbl_departments');
		return $this->db->affected_rows();
	}
	
	function read_records(){
		
		$this->db->order_by('dep_title','ASC');
		$query = $this->db->get('tbl_departments');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;

	}
	
	function delete_record($id){
	
		$this->db->where('dep_id',$id);
		$this->db->delete('tbl_departments');
	}
	
	function dep_exist($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_departments',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['dep_id'];
		return NULL;
	}
}
?>
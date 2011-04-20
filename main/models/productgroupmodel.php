<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Productgroupmodel extends CI_Model {
	
	var $prg_id	 		= 0;
	var $prg_title 		= "";
	var $prg_activity 	= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function read_record($id){
		$this->db->where('prg_id',$id);
		$query = $this->db->get('tbl_productgroup',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($activity){
	
		$this->db->where('prg_activity',$activity);
		$query = $this->db->get('tbl_productgroup');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_record_by_activity($aid){
		$this->db->where('prg_activity',$aid);
		$query = $this->db->get('tbl_productgroup',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function insert_record($title,$activity){
		
		$this->prg_title	= htmlspecialchars(trim($title));
		$this->prg_activity	= $activity;
		
		$this->db->insert('tbl_productgroup',$this);
		return $this->db->insert_id();
	}

	function update_record($updatedata){
		
		$this->db->set('prg_title',htmlspecialchars($updatedata['title']));
		$this->db->where('prg_activity',$updatedata['activity']);
		$this->db->update('tbl_productgroup');
	}

	function insert_empty($activity){
		
		$this->prg_title = "__base_group__";
		$this->prg_activity = $activity;
		
		$this->db->insert('tbl_productgroup',$this);
		return $this->db->insert_id();
	}

	function group_exist($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_productgroup',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['prg_id'];
		return FALSE;
	}
}
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

	function insert_empty($activity,$groupname){
		
		$this->prg_title = $groupname;
		$this->prg_activity = $activity;
		
		$this->db->insert('tbl_productgroup',$this);
		return $this->db->insert_id();
	}

	function save_name($id,$title){
	
		$this->db->set('prg_title',$title);
		$this->db->where('prg_id',$id);
		$this->db->update('tbl_productgroup');
		return $this->db->affected_rows();
	}
	
	function delete_record($id){
	
		$this->db->where('prg_id',$id);
		$this->db->delete('tbl_productgroup');
		return $this->db->affected_rows();
	}
	
	function group_exist($field,$parameter,$activity){
			
		$this->db->where('prg_activity',$activity);
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_productgroup',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['prg_id'];
		return FALSE;
	}
}
<?php

class Regionmodel extends CI_Model {
	
	var $reg_id 		= 0;
	var $reg_name 		= "";
	var $reg_area 		= "";
	var $reg_district	= "";
	var $reg_center 	= "";	
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_records(){
		
		$this->db->order_by('reg_name','ASC');
		$query = $this->db->get('tbl_regions');
		return $query->result_array();
	}
	
	function read_records_by_district(){
		
		$this->db->order_by('reg_district','ASC');
		$this->db->order_by('reg_name','ASC');
		$query = $this->db->get('tbl_regions');
		return $query->result_array();
	}
	
	function read_record($id){
		
		$this->db->where('reg_id',$id);
		$query = $this->db->get('tbl_regions',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_districts(){
		
		$this->db->select('reg_id AS id,reg_district AS title');
		$this->db->order_by('reg_district','ASC');
		$this->db->group_by('reg_district');
		$query = $this->db->get('tbl_regions');
		$data = $query->result_array();
		if(count($data)) return $data;
		else NULL;
	}
	
	function read_area($district){
		
		$this->db->select('reg_id AS id,reg_area AS title');
		$this->db->where('reg_district',$district);
		$this->db->order_by('reg_area','ASC');
		$this->db->group_by('reg_area');
		$query = $this->db->get('tbl_regions');
		$data = $query->result_array();
		if(count($data)) return $data;
		else NULL;
	}
	
	function read_cities($area){
		
		$this->db->select('reg_id AS id,reg_name AS title');
		$this->db->where('reg_area',$area);
		$this->db->order_by('reg_name','ASC');
		$query = $this->db->get('tbl_regions');
		$data = $query->result_array();
		if(count($data)) return $data;
		else NULL;
	}
	
	function insert_record($insertdata){
			
		$this->reg_name 	= $insertdata['name'];
		$this->reg_area		= $insertdata['area'];
		$this->reg_district	= $insertdata['district'];
		$this->reg_center 	= "";	
		
		$this->db->insert('tbl_regions',$this);
		return $this->db->insert_id();
	}

	function full_name($rid){
	
		$this->db->select('reg_area,reg_district');
		$this->db->where('reg_id',$rid);
		$query = $this->db->get('tbl_regions',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_field($regid,$field){
			
		$this->db->where('reg_id',$regid);
		$query = $this->db->get('tbl_regions',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}

	function region_id($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_regions',1);
		$data = $query->result_array();
		if(count($data)>0) return $data[0]['reg_id'];
		return FALSE;
	}

	function save_region($id,$name,$area,$dictr){
	
		$this->db->set('reg_name',$name);
		$this->db->set('reg_area',$area);
		$this->db->set('reg_district',$dictr);
		$this->db->where('reg_id',$id);
		$this->db->update('tbl_regions');
		return $this->db->affected_rows();
	}

	function region_exist($id){
			
		$this->db->where('reg_id',$id);
		$query = $this->db->get('tbl_regions',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>
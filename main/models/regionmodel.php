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
	
	function insert_record($insertdata){
			
		$this->reg_name 	= $insertdata['name'];
		$this->reg_area		= $insertdata['area'];
		$this->reg_district	= $insertdata['district'];
		$this->reg_center 	= $insertdata['center'];	
		
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

}
?>
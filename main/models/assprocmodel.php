<?php

class Assprocmodel extends CI_Model {
	
	var $asp_id 		= 0;
	var $asp_title 		= "";
	var $asp_activity 	= 0;
	var $asp_environment= 0;
	var $asp_department	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record_byid($id){
		
		$this->db->where('asp_id',$id);
		$query = $this->db->get('tbl_assproc',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_record($asp_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('asp_id,asp_title');
		$this->db->where('asp_activity',$asp_activity);
		$this->db->where('asp_environment',$environment);
		$this->db->where('asp_department',$department);
		$this->db->order_by('asp_title');
		$query = $this->db->get('tbl_assproc',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('asp_id,asp_title');
		$this->db->where('asp_activity',$activity);
		$this->db->where('asp_environment',$environment);
		$this->db->where('asp_department',$department);
		$this->db->order_by('asp_title');
		$query = $this->db->get('tbl_assproc');
		return $query->result_array();
	}
	
	function insert_records($title,$activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->asp_title 		= $title;
		$this->asp_activity 	= $activity;
		$this->asp_environment 	= $environment;
		$this->asp_department 	= $department;
		$this->db->insert('tbl_assproc',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data){
	
		$this->db->set('asp_title',$data['title']);
		$this->db->where('asp_id',$id);
		$this->db->update('tbl_assproc');
		return $this->db->affected_rows();
	}
	
	function delete_records($id){
	
		$this->db->where('asp_id',$id);
		$this->db->delete('tbl_assproc');
		return $this->db->affected_rows();
	}

	function owner($section,$asp_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->where('asp_id',$section);
		$this->db->where('asp_activity',$asp_activity);
		$this->db->where('asp_environment',$environment);
		$this->db->where('asp_department',$department);
		$query = $this->db->get('tbl_assproc',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($section,$field){
			
		$this->db->where('asp_id',$section);
		$query = $this->db->get('tbl_assproc',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
	
	function title_exist($title,$activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->where('asp_title',$title);
		$this->db->where('asp_activity',$activity);
		$this->db->where('asp_environment',$environment);
		$this->db->where('asp_department',$department);
		$query = $this->db->get('tbl_assproc',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>
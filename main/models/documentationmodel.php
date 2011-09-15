<?php
class Documentationmodel extends CI_Model {
	
	var $dtn_id 		= 0;
	var $dtn_title 		= "";
	var $dtn_activity 	= 0;
	var $dtn_environment= 0;
	var $dtn_department	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record_byid($id){
		
		$this->db->where('dtn_id',$id);
		$query = $this->db->get('tbl_documentation',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_record($dtn_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('dtn_id,dtn_title');
		$this->db->where('dtn_activity',$dtn_activity);
		$this->db->where('dtn_environment',$environment);
		$this->db->where('dtn_department',$department);
		$this->db->order_by('dtn_title');
		$query = $this->db->get('tbl_documentation',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($dtn_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('dtn_id,dtn_title');
		$this->db->where('dtn_activity',$dtn_activity);
		$this->db->where('dtn_environment',$environment);
		$this->db->where('dtn_department',$department);
		$this->db->order_by('dtn_title');
		$query = $this->db->get('tbl_documentation');
		return $query->result_array();
	}
	
	function insert_records($data,$dtn_activity,$environment,$department){
		
		$this->dtn_title = $data['title'];
		$this->dtn_activity = $dtn_activity;
		$this->dtn_environment = $environment;
		$this->dtn_department = $department;
		$this->db->insert('tbl_documentation',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data){
	
		$this->db->set('dtn_title',$data['title']);
		$this->db->where('dtn_id',$id);
		$this->db->update('tbl_documentation');
		return $this->db->affected_rows();
	}
	
	function delete_records($id){
	
		$this->db->where('dtn_id',$id);
		$this->db->delete('tbl_documentation');
		return $this->db->affected_rows();
	}

	function owner($section,$dtn_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->where('dtn_id',$section);
		$this->db->where('dtn_activity',$dtn_activity);
		$this->db->where('dtn_environment',$environment);
		$this->db->where('dtn_department',$department);
		$query = $this->db->get('tbl_documentation',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($section,$field){
			
		$this->db->where('dtn_id',$section);
		$query = $this->db->get('tbl_documentation',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
}
?>
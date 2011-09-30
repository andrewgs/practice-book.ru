<?php
class Interactionmodel extends CI_Model {
	
	var $int_id 		= 0;
	var $int_title 		= "";
	var $int_activity 	= 0;
	var $int_environment= 0;
	var $int_department	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record_byid($id){
		
		$this->db->where('int_id',$id);
		$query = $this->db->get('tbl_interaction',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_record($int_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('int_id,int_title');
		$this->db->where('int_activity',$int_activity);
		$this->db->where('int_environment',$environment);
		$this->db->where('int_department',$department);
		$this->db->order_by('int_title');
		$query = $this->db->get('tbl_interaction',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($int_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('int_id,int_title');
		$this->db->where('int_activity',$int_activity);
		$this->db->where('int_environment',$environment);
		$this->db->where('int_department',$department);
		$this->db->order_by('int_title');
		$query = $this->db->get('tbl_interaction');
		return $query->result_array();
	}
	
	function insert_records($title,$activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->int_title 		= $title;
		$this->int_activity 	= $activity;
		$this->int_environment 	= $environment;
		$this->int_department 	= $department;
		$this->db->insert('tbl_interaction',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data){
	
		$this->db->set('int_title',$data['title']);
		$this->db->where('int_id',$id);
		$this->db->update('tbl_interaction');
		return $this->db->affected_rows();
	}
	
	function delete_records($id){
	
		$this->db->where('int_id',$id);
		$this->db->delete('tbl_interaction');
		return $this->db->affected_rows();
	}

	function owner($section,$activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->where('int_id',$section);
		$this->db->where('int_activity',$activity);
		$this->db->where('int_environment',$environment);
		$this->db->where('int_department',$department);
		$query = $this->db->get('tbl_interaction',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($section,$field){
			
		$this->db->where('int_id',$section);
		$query = $this->db->get('tbl_interaction',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
	
	function title_exist($title,$activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->where('int_title',$title);
		$this->db->where('int_activity',$activity);
		$this->db->where('int_environment',$environment);
		$this->db->where('int_department',$department);
		$query = $this->db->get('tbl_interaction',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>
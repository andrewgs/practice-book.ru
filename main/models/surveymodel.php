<?php

class Surveymodel extends CI_Model {
	
	var $sur_id 		= 0;
	var $sur_title 		= "";
	var $sur_activity 	= 0;
	var $sur_environment= 0;
	var $sur_department	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record_byid($id){
		
		$this->db->where('sur_id',$id);
		$query = $this->db->get('tlb_survey',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_record($sur_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('sur_id,sur_title');
		$this->db->where('sur_activity',$sur_activity);
		$this->db->where('sur_environment',$environment);
		$this->db->where('sur_department',$department);
		$this->db->order_by('sur_title');
		$query = $this->db->get('tlb_survey',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($sur_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('sur_id,sur_title');
		$this->db->where('sur_activity',$sur_activity);
		$this->db->where('sur_environment',$environment);
		$this->db->where('sur_department',$department);
		$this->db->order_by('sur_title');
		$query = $this->db->get('tlb_survey');
		return $query->result_array();
	}
	
	function insert_records($title,$activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->sur_title 		= $title;
		$this->sur_activity 	= $activity;
		$this->sur_environment 	= $environment;
		$this->sur_department 	= $department;
		$this->db->insert('tlb_survey',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data){
	
		$this->db->set('sur_title',$data['title']);
		$this->db->where('sur_id',$id);
		$this->db->update('tlb_survey');
		return $this->db->affected_rows();
	}
	
	function delete_records($id){
	
		$this->db->where('sur_id',$id);
		$this->db->delete('tlb_survey');
		return $this->db->affected_rows();
	}

	function owner($section,$sur_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->where('sur_id',$section);
		$this->db->where('sur_activity',$sur_activity);
		$this->db->where('sur_environment',$environment);
		$this->db->where('sur_department',$department);
		$query = $this->db->get('tlb_survey',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($section,$field){
			
		$this->db->where('sur_id',$section);
		$query = $this->db->get('tlb_survey',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
	
	function title_exist($title,$activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->where('sur_title',$title);
		$this->db->where('sur_activity',$activity);
		$this->db->where('sur_environment',$environment);
		$this->db->where('sur_department',$department);
		$query = $this->db->get('tlb_survey',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>
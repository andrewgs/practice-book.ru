<?php

class Questionanswermodel extends CI_Model {
	
	var $qa_id 			= 0;
	var $qa_title 		= "";
	var $qa_activity 	= 0;
	var $qa_environment = 0;
	var $qa_department	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record_byid($id){
		
		$this->db->where('qa_id',$id);
		$query = $this->db->get('tbl_question_answer',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_record($qa_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('qa_id,qa_title');
		$this->db->where('qa_activity',$qa_activity);
		$this->db->where('qa_environment',$environment);
		$this->db->where('qa_department',$department);
		$this->db->order_by('qa_title');
		$query = $this->db->get('tbl_question_answer',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($qa_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('qa_id,qa_title');
		$this->db->where('qa_activity',$qa_activity);
		$this->db->where('qa_environment',$environment);
		$this->db->where('qa_department',$department);
		$this->db->order_by('qa_title');
		$query = $this->db->get('tbl_question_answer');
		return $query->result_array();
	}
	
	function insert_records($title,$activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->qa_title 		= $title;
		$this->qa_activity 		= $activity;
		$this->qa_environment 	= $environment;
		$this->qa_department	= $department;
		$this->db->insert('tbl_question_answer',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data){
	
		$this->db->set('qa_title',$data['title']);
		$this->db->where('qa_id',$id);
		$this->db->update('tbl_question_answer');
		return $this->db->affected_rows();
	}
	
	function delete_records($id){
	
		$this->db->where('qa_id',$id);
		$this->db->delete('tbl_question_answer');
		return $this->db->affected_rows();
	}

	function owner($section,$qa_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->where('qa_id',$section);
		$this->db->where('qa_activity',$qa_activity);
		$this->db->where('qa_environment',$environment);
		$this->db->where('qa_department',$department);
		$query = $this->db->get('tbl_question_answer',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($section,$field){
			
		$this->db->where('qa_id',$section);
		$query = $this->db->get('tbl_question_answer',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
	
	function title_exist($title,$activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->where('qa_title',$title);
		$this->db->where('qa_activity',$activity);
		$this->db->where('qa_environment',$environment);
		$this->db->where('qa_department',$department);
		$query = $this->db->get('tbl_question_answer',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>
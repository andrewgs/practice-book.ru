<?php

class Articlesmodel extends CI_Model {
	
	var $art_id 		= 0;
	var $art_title 		= "";
	var $art_activity 	= 0;
	var $art_environment= 0;
	var $art_department	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record_byid($id){
		
		$this->db->where('art_id',$id);
		$query = $this->db->get('tbl_articles',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_record($activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('art_id,art_title');
		$this->db->where('art_activity',$activity);
		$this->db->where('art_environment',$environment);
		$this->db->where('art_department',$department);
		$this->db->order_by('art_title');
		$query = $this->db->get('tbl_articles',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('art_id,art_title');
		$this->db->where('art_activity',$activity);
		$this->db->where('art_environment',$environment);
		$this->db->where('art_department',$department);
		$this->db->order_by('art_title');
		$query = $this->db->get('tbl_articles');
		return $query->result_array();
	}
	
	function insert_records($title,$activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->art_title 		= $title;
		$this->art_activity 	= $activity;
		$this->art_environment 	= $environment;
		$this->art_department 	= $department;
		$this->db->insert('tbl_articles',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data){
	
		$this->db->set('art_title',$data['title']);
		$this->db->where('art_id',$id);
		$this->db->update('tbl_articles');
		return $this->db->affected_rows();
	}
	
	function delete_records($id){
	
		$this->db->where('art_id',$id);
		$this->db->delete('tbl_articles');
		return $this->db->affected_rows();
	}

	function owner($section,$art_activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->where('art_id',$section);
		$this->db->where('art_activity',$art_activity);
		$this->db->where('art_environment',$environment);
		$this->db->where('art_department',$department);
		$query = $this->db->get('tbl_articles',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($section,$field){
			
		$this->db->where('art_id',$section);
		$query = $this->db->get('tbl_articles',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
	
	function title_exist($title,$activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->where('art_title',$title);
		$this->db->where('art_activity',$activity);
		$this->db->where('art_environment',$environment);
		$this->db->where('art_department',$department);
		$query = $this->db->get('tbl_articles',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>
<?php

class Offerstopicmodel extends CI_Model {
	
	var $oft_id 		= 0;
	var $oft_title 		= "";
	var $oft_date 		= "";
	var $oft_note 		= "";
	var $oft_userid 	= 0;
	var $oft_comments 	= 0;
	var $oft_cmpid	 	= 0;
	var $oft_cmpname	= "";
	var $oft_environment= 0;
	var $oft_department	= 0;
	var $oft_activity	= 0;
	var $oft_photo		= "";
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record_byid($id){
		
		$this->db->where('oft_id',$id);
		$query = $this->db->get('tbl_offertopic',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_record($activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('oft_id,oft_title');
		$this->db->where('oft_activity',$activity);
		$this->db->where('oft_environment',$environment);
		$this->db->where('oft_department',$department);
		$this->db->order_by('oft_title');
		$query = $this->db->get('tbl_offertopic',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_limit_records($count,$from,$environment,$department,$activity,$field){
		
		if(!$environment) $department = 0;
		$this->db->select('oft_id,oft_title,oft_date,oft_note,oft_userid,oft_comments,oft_cmpid,oft_cmpname');
		$this->db->where('oft_environment',$environment);
		$this->db->where('oft_department',$department);
		$this->db->where('oft_activity',$activity);
		$this->db->limit($count,$from);
		$this->db->order_by($field,'DESC');
		$query = $this->db->get('tbl_offertopic');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_records($activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('oft_id,oft_title');
		$this->db->where('oft_activity',$activity);
		$this->db->where('oft_environment',$environment);
		$this->db->where('oft_department',$department);
		$this->db->order_by('oft_title');
		$query = $this->db->get('tbl_offertopic');
		return $query->result_array();
	}
	
	function insert_records($data,$activity,$environment,$department){
		
		$this->oft_title = $data['title'];
		$this->oft_activity = $activity;
		$this->oft_environment = $environment;
		$this->oft_department = $department;
		$this->db->insert('tbl_offertopic',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data){
	
		$this->db->set('oft_title',$data['title']);
		$this->db->where('oft_id',$id);
		$this->db->update('tbl_offertopic');
		return $this->db->affected_rows();
	}
	
	function delete_records($id){
	
		$this->db->where('oft_id',$id);
		$this->db->delete('tbl_offertopic');
		return $this->db->affected_rows();
	}
	
	function topic_exist($id,$environment,$department,$activity){
		
		if(!$environment) $department = 0;
		$this->db->where('oft_id',$id);
		$this->db->where('oft_environment',$environment);
		$this->db->where('oft_department',$department);
		$this->db->where('oft_activity',$activity);
		$query = $this->db->get('tbl_offertopic',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
	
	function owner($activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->where('oft_activity',$activity);
		$this->db->where('oft_environment',$environment);
		$this->db->where('oft_department',$department);
		$query = $this->db->get('tbl_offertopic',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
	
	function count_records($activity,$environment,$department){
		
		if(!$environment) $department = 0;
		$this->db->select('count(*) as cnt');
		$this->db->where('oft_activity',$activity);
		$this->db->where('oft_environment',$environment);
		$this->db->where('oft_department',$department);
		$query = $this->db->get('tbl_offertopic');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function read_field($section,$field){
			
		$this->db->where('oft_id',$section);
		$query = $this->db->get('tbl_offertopic',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}

	function get_image($id){
	
		$this->db->where('oft_id',$id);
		$this->db->select('oft_photo');
		$query = $this->db->get('tbl_offertopic');
		$data = $query->result_array();
		return $data[0]['oft_photo'];
	}
}
?>
<?php

class Discussionsmodel extends CI_Model {
	
	var $dsc_id 		= 0;
	var $dsc_title 		= "";
	var $dsc_activity 	= 0;
	var $dsc_environment= 'full';
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record_byid($id){
		
		$this->db->where('dsc_id',$id);
		$query = $this->db->get('tbl_discussions',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_record($dsc_activity,$environment){
		
		$this->db->select('dsc_id,dsc_title');
		$this->db->where('dsc_activity',$dsc_activity);
		$this->db->where('dsc_environment',$environment);
		$this->db->order_by('dsc_title');
		$query = $this->db->get('tbl_discussions',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($dsc_activity,$environment){
	
		$this->db->select('dsc_id,dsc_title');
		$this->db->where('dsc_activity',$dsc_activity);
		$this->db->where('dsc_environment',$environment);
		$this->db->order_by('dsc_title');
		$query = $this->db->get('tbl_discussions');
		return $query->result_array();
	}
	
	function insert_records($data,$dsc_activity,$environment){
	
		$this->dsc_title = $data['title'];
		$this->dsc_activity = $dsc_activity;
		$this->dsc_environment = $environment;
		$this->db->insert('tbl_discussions',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data){
	
		$this->db->set('dsc_title',$data['title']);
		$this->db->where('dsc_id',$id);
		$this->db->update('tbl_discussions');
		return $this->db->affected_rows();
	}
	
	function delete_records($id){
	
		$this->db->where('dsc_id',$id);
		$this->db->delete('tbl_discussions');
		return $this->db->affected_rows();
	}

	function owner($section,$dsc_activity,$environment){
		
		$this->db->where('dsc_id',$section);
		$this->db->where('dsc_activity',$dsc_activity);
		$this->db->where('dsc_environment',$environment);
		$query = $this->db->get('tbl_discussions',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($section,$field){
			
		$this->db->where('dsc_id',$section);
		$query = $this->db->get('tbl_discussions',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
}
?>
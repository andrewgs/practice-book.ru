<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Supportmodel extends CI_Model {
	
	var $spt_id	 		= 0;
	var $spt_name 		= 0;
	var $spt_email 		= "";
	var $spt_theme 		= "";
	var $spt_message 	= "";
	var $spt_date 		= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function read_record($id){
		$this->db->where('spt_id',$id);
		$query = $this->db->get('tbl_support',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_records(){
		
		$this->db->order_by('spt_date');
		$query = $this->db->get('tbl_support');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function insert_record($insertdata){
		
		$this->spt_name		= $insertdata['name'];
		$this->spt_email	= $insertdata['email'];
		$this->spt_theme	= $insertdata['theme'];
		$this->spt_message	= $insertdata['message'];
		$this->spt_date		= date("Y-m-d");
		$this->db->insert('tbl_support',$this);
		return $this->db->insert_id();
	}

	function update_record($id,$updatedata){
		
		$this->db->set('spt_name',strip_tags($updatedata['name']));
		$this->db->set('spt_email',strip_tags($updatedata['email']));
		$this->db->set('spt_theme',strip_tags($updatedata['theme']));
		$this->db->set('spt_message',strip_tags($updatedata['message']));
		$this->db->set('spt_date',date("Y-m-d"));
		$this->db->where('spt_id',$id);
		$this->db->update('tbl_support');
	}

	function delete_record($id){
		$this->db->where('spt_id',$id);
		$this->db->delete('tbl_support');
		return $this->db->affected_rows();
	}

	function read_field($id,$field){
	
		$this->db->where('spt_id',$id);
		$query = $this->db->get('tbl_support',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
}
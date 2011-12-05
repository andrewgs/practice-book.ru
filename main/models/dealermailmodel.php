<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dealermailmodel extends CI_Model {
	
	var $dlm_id	 		= 0;
	var $dlm_dlrid 		= 0;
	var $dlm_cname 		= "";
	var $dlm_cemail 	= "";
	var $dlm_cphone 	= "";
	var $dlm_cmessage 	= "";
	var $dlm_date 		= "";
	var $dlm_cregion	= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function read_record($id){
		$this->db->where('dlm_id',$id);
		$query = $this->db->get('tbl_dealermail',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_records($id){
		
		$this->db->where('dlm_dlrid',$id);
		$this->db->order_by('dlm_date');
		$query = $this->db->get('tbl_dealermail');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function insert_record($data){
		
		$this->dlm_dlrid	= $data['dlrid'];
		$this->dlm_cname	= htmlspecialchars($data['name']);
		$this->dlm_cemail	= htmlspecialchars($data['email']);
		$this->dlm_cphone	= htmlspecialchars($data['phone']);
		$this->dlm_cregion	= htmlspecialchars($data['region']);
		$this->dlm_cmessage	= strip_tags($data['message']);
		$this->dlm_date		= date("Y-m-d");
		$this->db->insert('tbl_dealermail',$this);
		return $this->db->insert_id();
	}

	function delete_record($id){
		$this->db->where('dlm_id',$id);
		$this->db->delete('tbl_dealermail');
		return $this->db->affected_rows();
	}

	function read_field($id,$field){
	
		$this->db->where('dlm_id',$id);
		$query = $this->db->get('tbl_dealermail',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
}
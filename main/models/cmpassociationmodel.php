<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Associationmodel extends CI_Model {
	
	var $ca_id	 		= 0;
	var $ca_cmpid		= 0;
	var $ca_ascid		= 0;
	var $ca_date		= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function read_record($id){
		$this->db->where('ca_id',$id);
		$query = $this->db->get('tbl_cmpassociation',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records(){
	
		$query = $this->db->get('tbl_cmpassociation');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function insert_record($cmpid,$acs){
		
		$this->ca_cmpid		= $cmpid;
		$this->ca_ascid		= $acs;
		$this->ca_date		= date("Y-m-d");
		
		$this->db->insert('tbl_cmpassociation',$this);
		return $this->db->insert_id();
	}

	function assoc_exist($cmpid,$field,$parameter){
			
		$this->db->where($field,$parameter);
		$this->db->where('ca_cmpid',$cmpid);
		$query = $this->db->get('tbl_cmpassociation',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['ca_id'];
		return FALSE;
	}

	function record_delete($id,$cmpid){
	
		$this->db->where('ca_id',$id);
		$this->db->where('ca_cmpid',$cmpid);
		$this->db->delete('tbl_cmpassociation');
	}
}
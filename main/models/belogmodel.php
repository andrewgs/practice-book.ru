<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Belogmodel extends CI_Model{
	
	var $belg_id 			= 0;
	var $belg_title_field	= "";
	var $belg_note_field	= "";
	var $belg_edit			= "";
	var $belg_delete		= "";
	var $belg_date	 		= "";
	var $belg_userid		= 0;
	var $belg_cmpid			= 0;
	var $belg_activity		= 0;
	var $belg_table			= "";
	var $belg_environment	= 0;
	var $belg_department	= 0;
	var $belg_model			= 0;
	var $belg_object_id		= 0;
	var $belg_object_field	= "";

	function __construct(){

		parent::__construct();
	}
	
	function insert_record($tfield,$nfield,$edit,$delete,$activity,$table,$environment,$department,$userid,$cmpid,$model,$objid,$ofield){
		
		if(!$environment) $department = 0;
		$this->belg_title_field	= $tfield;
		$this->belg_note_field	= $nfield;
		$this->belg_edit		= $edit;
		$this->belg_delete		= $delete;
		$this->belg_date		= date("Y-m-d");
		$this->belg_userid		= $userid;
		$this->belg_cmpid		= $cmpid;
		$this->belg_activity	= $activity;
		$this->belg_table		= $table;
		$this->belg_environment	= $environment;
		$this->belg_department	= $department;
		$this->belg_model		= $model;
		$this->belg_object_id	= $objid;
		$this->belg_object_field= $ofield;
		
		$this->db->insert('tbl_be_log',$this);
		return $this->db->insert_id();
	}
	
	function read_record($id){
		
		$this->db->where('belg_id',$id);
		$query = $this->db->get('tbl_be_log',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($date){
		
		$this->db->where('belg_date',$date);
		$this->db->order_by('belg_id','DESC');
		$query = $this->db->get('tbl_be_log');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_limit_records($limit){
	
		$this->db->order_by('belg_id desc, belg_date desc');
		$query = $this->db->get('tbl_be_log',$limit);
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function count_records(){
		
		$this->db->select('count(*) as cnt');
		$query = $this->db->get('tbl_be_log');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function delete_record($id){
	
		$this->db->where('belg_id',$id);
		$this->db->delete('tbl_be_log');
		return $this->db->affected_rows();
	}

	function read_field($nid,$field){
			
		$this->db->where('belg_id',$nid);
		$query = $this->db->get('tbl_be_log',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}

	function read_table_field($table,$objid,$objfid,$field){
	
		$this->db->select($field);
		$this->db->where($objfid,$objid);
		$query = $this->db->get($table,1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function save_table_field($table,$objid,$objfid,$field,$data){
	
		$this->db->set($field,$data);
		$this->db->where($objfid,$objid);
		$query = $this->db->update($table);
		return $this->db->affected_rows();
	}

	function delete_table_record($table,$objid,$objfid){
	
		$this->db->where($objfid,$objid);
		$this->db->delete($table);
		return $this->db->affected_rows();
	}

	function delete_table_comment($table,$objid,$objfid,$field){
		
		$this->db->set($field,$field-1,FALSE);
		$this->db->where($objfid,$objid);
		$this->db->update($table);
		return $this->db->affected_rows();
	}
}
?>
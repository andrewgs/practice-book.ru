<?php

class Cmpsrvmodel extends CI_Model{
	
	var $cs_id = 0;
	var $cs_cmpid = 1;
	var $cs_srvid = 1;
	var $cs_note = '';
	var $cs_close = 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function multi_insert($srvlistid,$cmpid){
	
		$query = 'insert into tbl_companyservices (cs_cmpid,cs_srvid) values';
		$cnt = count($srvlistid);
		for($i = 0; $i < $cnt; $i++):
			$query .= "($cmpid,$srvlistid[$i])";
			if($cnt > 1 && $i < $cnt-1) $query .= ',';
		endfor;
		$this->db->query($query);
	}
	
	function insert_record($activity,$cmpid){
		
		$this->cs_cmpid = $cmpid;
		$this->cs_srvid = $activity;
		$this->db->insert('tbl_companyservices',$this);
		return $this->db->insert_id();
	}
	
	function read_record($id){
		
		$this->db->where('cs_id',$id);
		$query = $this->db->get('tlb_survey',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function activity_exist($activity){
	
		$this->db->where('cs_srvid',$activity);
		$query = $this->db->get('tbl_companyservices');
		$data = $query->result_array();
		if(count($data)>0) return TRUE;
		return FALSE;
	}
	
	function delete_records($cid){
	
		$this->db->where('cs_cmpid',$cid);
		$this->db->delete('tbl_companyservices');
		return $this->db->affected_rows();
	}
	
	function close_record($id){
		$this->db->set('cs_close',1);
		$this->db->where('cs_id',$id);
		$this->db->update('tbl_companyservices');
		return $this->db->affected_rows();
	}
	
	function open_record($id){
		$this->db->set('cs_close',0);
		$this->db->where('cs_id',$id);
		$this->db->update('tbl_companyservices');
		return $this->db->affected_rows();
	}
}
?>
<?php

class Collectedmodel extends CI_Model {
	
	var $cll_id 		= 0;
	var $cll_cmpid 		= 0;
	var $cll_cmpname 	= '';
	var $cll_userid		= 0;
	var $cll_username	= '';
	var $cll_astid		= 0;
	var $cll_date		= '';
	var $cll_count		= 1;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_records($astid){
		
		$this->db->where('cll_astid',$astid);
		$this->db->order_by('cll_date DESC');
		$query = $this->db->get('tbl_collected');
		return $query->result_array();
	}
	
	function read_limit_records($count,$from,$astid){
		
		$this->db->where('cll_astid',$astid);
		$this->db->limit($count,$from);
		$this->db->order_by('cll_date DESC');
		$query = $this->db->get('tbl_collected');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function insert_record($cmpid,$cmpname,$userid,$username,$count,$astid){
		
		$this->cll_cmpid = $cmpid;
		$this->cll_cmpname = $cmpname;
		$this->cll_userid = $userid;
		$this->cll_username = $username;
		$this->cll_astid = $astid;
		$this->cll_date = date("Y-m-d");
		$this->cll_count = $count;
		$this->db->insert('tbl_collected',$this);
		return $this->db->insert_id();
	}
	
	function delete_record($id,$cmp){
	
		$this->db->where('cll_id',$id);
		$this->db->where('cll_cmpid',$cmp);
		$this->db->delete('tbl_collected');
		return $this->db->affected_rows();
	}
	
	function delete_records($astid){
	
		$this->db->where('cll_astid',$astid);
		$this->db->delete('tbl_collected');
		return $this->db->affected_rows();
	}
	
	function read_field($id,$field){
			
		$this->db->where('cll_id',$id);
		$query = $this->db->get('tbl_collected',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
	
	function count_records($ast){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('cll_astid',$ast);
		$query = $this->db->get('tbl_collected');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}

	function cmp_owner($ast,$id,$cmp){
	
		$this->db->where('cll_id',$id);
		$this->db->where('cll_astid',$ast);
		$this->db->where('cll_cmpid',$cmp);
		$query = $this->db->get('tbl_collected',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function company_exist($ast,$cmp){
	
		$this->db->where('cll_astid',$ast);
		$this->db->where('cll_cmpid',$cmp);
		$query = $this->db->get('tbl_collected',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>
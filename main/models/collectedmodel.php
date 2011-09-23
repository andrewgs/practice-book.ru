<?php

class Collectedmodel extends CI_Model {
	
	var $cll_id 		= 0;
	var $cll_cmpid 		= 0;
	var $cll_cmpname 	= '';
	var $cll_userid		= 0;
	var $cll_username	= '';
	var $cll_astid		= 0;
	var $cll_date		= '';
	
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
	
	function insert_records($data,$cll_activity,$environment,$department){
		
		$this->cll_title = $data['title'];
		$this->cll_activity = $cll_activity;
		$this->cll_environment = $environment;
		$this->cll_department = $department;
		$this->db->insert('tbl_collected',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data){
	
		$this->db->set('cll_title',$data['title']);
		$this->db->where('cll_id',$id);
		$this->db->update('tbl_collected');
		return $this->db->affected_rows();
	}
	
	function delete_records($id){
	
		$this->db->where('cll_id',$id);
		$this->db->delete('tbl_collected');
		return $this->db->affected_rows();
	}

	function read_field($section,$field){
			
		$this->db->where('cll_id',$section);
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
}
?>
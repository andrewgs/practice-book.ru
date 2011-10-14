<?php

class Wmcompanymodel extends CI_Model {
	
	var $wmc_id 		= 0;
	var $wmc_wmnid 		= 0;
	var $wmc_cmpid 		= 0;
	var $wmc_date 		= "";
	var $wmc_userid		= 0;
	var $wmc_price		= 0.00;
	var $wmc_order		= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function company_insert($wmnid,$price,$userid,$cmpid){
		
		$this->wmc_wmnid 	= $wmnid;
		$this->wmc_cmpid 	= $cmpid;
		$this->wmc_date 	= date("Y-m-d");
		$this->wmc_userid 	= $userid;
		$this->wmc_price 	= $price;
		$this->wmc_order 	= 0;
		$this->db->insert('tbl_wmcompany',$this);
		return $this->db->insert_id();
	}
	
	function company_update($wmnid,$cmpid,$price){
		
		$this->db->set('wmc_price',$price);
		$this->db->set('wmc_date',date("Y-m-d"));
		$this->db->where('wmc_wmnid',$wmnid);
		$this->db->where('wmc_cmpid',$cmpid);
		$this->db->where('wmc_price <',$price);
		$this->db->update('tbl_wmcompany');
		return $this->db->affected_rows(); 
	}
	
	function delete_records(){
		
		$this->db->empty_table('tbl_wmcompany');
	}
	
	function delete_auccompany($wmnid){
		
		$this->db->where('wmc_wmnid',$wmnid);
		$this->db->delete('tbl_wmcompany');
	}
	
	function read_record($activity,$environment,$department,$region){
		
		if(!$environment) $department = 0;
		$this->db->select("wmc_id,wmc_cmpid,wmc_cmpname,wmc_price,wmc_over,(UNIX_TIMESTAMP(wmc_edate)-UNIX_TIMESTAMP(NOW())) AS minutes");
		$this->db->where('wmc_activity',$activity);
		$this->db->where('wmc_environment',$environment);
		$this->db->where('wmc_department',$department);
		$this->db->where('wmc_region',$region);
		$query = $this->db->get('tbl_wmcompany',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_field($id,$field){
			
		$this->db->where('wmc_id',$id);
		$query = $this->db->get('tbl_wmcompany',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
	
	function company_exist($wmnid,$cmpid){
		
		$this->db->where('wmc_wmnid',$wmnid);
		$this->db->where('wmc_cmpid',$cmpid);
		$query = $this->db->get('tbl_wmcompany',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function count_records($wmnid){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('wmc_wmnid',$wmnid);
		$query = $this->db->get('tbl_wmcompany');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
}
?>
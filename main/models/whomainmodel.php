<?php

class Whomainmodel extends CI_Model {
	
	var $wmn_id 		= 0;
	var $wmn_photo 		= "";
	var $wmn_bdate	 	= "0000-00-00 00:00:00";
	var $wmn_edate		= "0000-00-00 00:00:00";
	var $wmn_cmpid		= 0;
	var $wmn_cmpname	= "";
	var $wmn_price		= 0.00;
	var $wmn_over		= 1;
	var $wmn_activity	= 0;
	var $wmn_environment= 0;
	var $wmn_department = 0;
	var $wmn_region		= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function insert_record($photo,$activity,$environment,$department,$region){
		
		if(!$environment) $department = 0;
		$this->wmn_photo 		= $photo;
		$this->wmn_region 		= $region;
		$this->wmn_activity 	= $activity;
		$this->wmn_environment 	= $environment;
		$this->wmn_department 	= $department;
		$this->db->insert('tbl_whomain',$this);
		return $this->db->insert_id();
	}
	
	function close_auc($id,$cmpid,$cmpame,$price){
		
		$this->db->set('wmn_over',1);
		$this->db->set('wmn_bdate',"0000-00-00 00:00:00");
		$this->db->set('wmn_edate',"0000-00-00 00:00:00");
		$this->db->set('wmn_cmpid',$cmpid);
		$this->db->set('wmn_cmpname',$cmpame);
		$this->db->set('wmn_price',$price);
		$this->db->where('wmn_id',$id);
		$this->db->update('tbl_whomain');
		return $this->db->affected_rows(); 
	}
	
	function open_auc($id){
	
		$this->db->set('wmn_over',0);
		$this->db->set('wmn_bdate',date("Y-m-d H:i:s"));
		$this->db->set('wmn_edate',date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d")+7, date("Y"))));
		$this->db->set('wmn_cmpid',0);
		$this->db->set('wmn_cmpname',"");
		$this->db->set('wmn_price',"0.00");
		$this->db->where('wmn_id',$id);
		$this->db->update('tbl_whomain');
		return $this->db->affected_rows(); 
	}
	
	function open_oneauc($id,$date){
	
		$this->db->set('wmn_over',0);
		$this->db->set('wmn_bdate',date("Y-m-d H:i:s"));
		$this->db->set('wmn_edate',$date);
		$this->db->set('wmn_cmpid',0);
		$this->db->set('wmn_cmpname',"");
		$this->db->set('wmn_price',"0.00");
		$this->db->where('wmn_id',$id);
		$this->db->update('tbl_whomain');
		return TRUE; 
	}
	
	function read_record($activity,$environment,$department,$region){
		
		if(!$environment) $department = 0;
		$this->db->select("wmn_id,wmn_cmpid,wmn_cmpname,wmn_price,wmn_over,(UNIX_TIMESTAMP(wmn_edate)-UNIX_TIMESTAMP(NOW())) AS minutes");
		$this->db->where('wmn_activity',$activity);
		$this->db->where('wmn_environment',$environment);
		$this->db->where('wmn_department',$department);
		$this->db->where('wmn_region',$region);
		$query = $this->db->get('tbl_whomain',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_records(){
		
		$this->db->select("wmn_id,wmn_cmpid,wmn_cmpname,wmn_price,wmn_over,wmn_edate,wmn_bdate");
		$query = $this->db->get('tbl_whomain');
		$data = $query->result_array();
		if(isset($data[0])) return $data;
		return NULL;
	}
	
	function read_field($id,$field){
			
		$this->db->where('wmn_id',$id);
		$query = $this->db->get('tbl_whomain',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
	
	function record_exist($activity,$environment,$department,$region){
		
		if(!$environment) $department = 0;
		$this->db->where('wmn_activity',$activity);
		$this->db->where('wmn_environment',$environment);
		$this->db->where('wmn_department',$department);
		$this->db->where('wmn_region',$region);
		$query = $this->db->get('tbl_whomain',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function auction_exist($activity,$environment,$department,$region){
		
		if(!$environment) $department = 0;
		$this->db->where('wmn_activity',$activity);
		$this->db->where('wmn_environment',$environment);
		$this->db->where('wmn_department',$department);
		$this->db->where('wmn_region',$region);
		$query = $this->db->get('tbl_whomain',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['wmn_id'];
		return FALSE;
	}
}
?>
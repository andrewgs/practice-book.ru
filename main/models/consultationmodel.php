<?php

class Consultationmodel extends CI_Model {
	
	var $cnsl_id 		= 0;
	var $cnsl_title 	= "";
	var $cnsl_note 		= "";
	var $cnsl_price 	= "";
	var $cnsl_period	= 0;
	var $cnsl_status	= 0;
	var $cnsl_uid		= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record($uid){
		
		$this->db->where('cnsl_uid',$uid);
		$this->db->order_by('cnsl_title');
		$query = $this->db->get('tbl_consultation',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function insert_record($uid,$insertdata){
			
		$this->cnsl_title 	= $insertdata['title'];
		$this->cnsl_note	= strip_tags($insertdata['note'],'<br>');
		$this->cnsl_price	= $insertdata['price'];
		$this->cnsl_period 	= $insertdata['period'];	
		$this->cnsl_status 	= 1;	
		$this->cnsl_uid 	= $uid;	
		
		$this->db->insert('tbl_consultation',$this);
		return $this->db->insert_id();
	}
	
	function read_records($uid){
	
		$this->db->where('cnsl_uid',$uid);
		$this->db->where('cnsl_status',1);
		$this->db->order_by('cnsl_title');
		$query = $this->db->get('tbl_consultation');
		return $query->result_array();
	}
	
	function read_field($uid,$field){
			
		$this->db->where('cnsl_uid',$uid);
		$this->db->where('cnsl_status',1);
		$query = $this->db->get('tbl_consultation',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}

	function save_record($cid,$uid,$title,$note,$period,$price,$status){
	
		$this->db->set('cnsl_title',$title);
		$this->db->set('cnsl_note',strip_tags($note,'<br>'));
		$this->db->set('cnsl_period',$period);
		$this->db->set('cnsl_price',$price);
		$this->db->set('cnsl_status',$status);
		$this->db->where('cnsl_id',$cid);
		$this->db->where('cnsl_uid',$uid);
		$this->db->update('tbl_consultation');
		return $this->db->affected_rows();
	}

	function delete_record($cid,$uid){
	
		$this->db->where('cnsl_id',$cid);
		$this->db->where('cnsl_uid',$uid);
		$this->db->delete('tbl_consultation');
		return $this->db->affected_rows();
	}

	function count_records($uid){
	
		$query = "SELECT COUNT(*) AS cnt FROM tbl_consultation WHERE tbl_consultation.cnsl_uid = $uid";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data[0]['cnt'];
		else return null;
	}
}
?>
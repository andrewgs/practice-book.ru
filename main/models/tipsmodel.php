<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tipsmodel extends CI_Model {
	
	var $tps_id	 	= 0;
	var $tps_mraid 	= 0;
	var $tps_title 	= "";
	var $tps_note 	= "";
	var $tps_date 	= "";
	var $tps_status 	= 0;
	
	function __construct(){

		parent::__construct();
	}
	
	function record_exist($mraid){
		
		$this->db->where('tps_mraid',$mraid);
		$query = $this->db->get('tbl_tips');
		$data = $query->result_array();
		if(count($data)) return $data;
		return FALSE;
	}
	
	function read_record($mraid){
		$this->db->where('tps_mraid',$mraid);
		$query = $this->db->get('tbl_tips',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($mraid){
	
		$this->db->order_by('tps_date','DESC');
		$this->db->order_by('tps_id','DESC');
		$this->db->where('tps_mraid',$mraid);
		$query = $this->db->get('tbl_tips');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_limit_records($mraid,$limit){
		
		$this->db->where('tps_mraid',$mraid);
		$this->db->where('tps_status',1);
		$this->db->order_by('tps_date');
		$this->db->order_by('tps_id');
		$query = $this->db->get('tbl_tips',$limit);
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function insert_record($mraid,$insertdata){
		
		$this->tps_mraid	= $mraid;
		$this->tps_title	= htmlspecialchars($insertdata['title']);
		$this->tps_note	= strip_tags($insertdata['note'],'<br>');
		$this->tps_date	= date("Y-m-d");
		$this->tps_status = 1;
		
		$this->db->insert('tbl_tips',$this);
	}

	function insert_empty($mraid){
		
		$this->tps_mraid	= $mraid;
		$this->tps_date		= date("Y-m-d");
		
		$this->db->insert('tbl_tips',$this);
	}

	function delete_record($pfid){
	
		$this->db->where('tps_id',$pfid);
		$this->db->delete('tbl_tips');
		return $this->db->affected_rows();
	}

	function save_tips($id,$title,$note){
	
		$this->db->where('tps_id',$id);
		$this->db->set('tps_title',htmlspecialchars($title));
		$this->db->set('tps_note',strip_tags($note,'<br>'));
		$this->db->set('tps_date',date("Y-m-d"));
		$this->db->set('tps_status',1);
		$this->db->update('tbl_tips');
		return $this->db->affected_rows();
	}

	function user_insert_record($mraid,$title,$note){
		
		$this->tps_mraid	= $mraid;
		$this->tps_title	= htmlspecialchars($title);
		$this->tps_note		= strip_tags($note,'<br>');
		$this->tps_date		= date("Y-m-d");
		$this->tps_status 	= 0;
		
		$this->db->insert('tbl_tips',$this);
		return $this->db->insert_id();
	}
}
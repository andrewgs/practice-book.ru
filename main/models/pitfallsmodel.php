<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pitfallsmodel extends CI_Model {
	
	var $pf_id	 	= 0;
	var $pf_mraid 	= 0;
	var $pf_title 	= "";
	var $pf_note 	= "";
	var $pf_date 	= "";
	var $pf_status 	= 0;
	
	function __construct(){

		parent::__construct();
	}
	
	function record_exist($mraid){
		
		$this->db->where('pf_mraid',$mraid);
		$query = $this->db->get('tbl_pitfalls');
		$data = $query->result_array();
		if(count($data)) return $data;
		return FALSE;
	}
	
	function read_record($mraid){
		$this->db->where('pf_mraid',$mraid);
		$query = $this->db->get('tbl_pitfalls',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($mraid){
	
		$this->db->order_by('pf_date','DESC');
		$this->db->order_by('pf_id','DESC');
		$this->db->where('pf_mraid',$mraid);
		$query = $this->db->get('tbl_pitfalls');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_limit_records($mraid,$limit){
		
		$this->db->where('pf_mraid',$mraid);
		$this->db->where('pf_status',1);
		$this->db->order_by('pf_date');
		$this->db->order_by('pf_id');
		$query = $this->db->get('tbl_pitfalls',$limit);
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function insert_record($mraid,$insertdata){
		
		$this->pf_mraid	= $mraid;
		$this->pf_title	= htmlspecialchars($insertdata['title']);
		$this->pf_note	= strip_tags($insertdata['note'],'<br>');
		$this->pf_date	= date("Y-m-d");
		$this->pf_status = 1;
		$this->db->insert('tbl_pitfalls',$this);
		return $this->db->insert_id();
	}
	
	function user_insert_record($mraid,$title,$note){
		
		$this->pf_mraid	= $mraid;
		$this->pf_title	= htmlspecialchars($title);
		$this->pf_note	= strip_tags($note,'<br>');
		$this->pf_date	= date("Y-m-d");
		$this->pf_status = 0;
		
		$this->db->insert('tbl_pitfalls',$this);
		return $this->db->insert_id();
	}
	
	function insert_empty($mraid){
		
		$this->pf_mraid	= $mraid;
		$this->pf_date	= date("Y-m-d");
		
		$this->db->insert('tbl_pitfalls',$this);
	}

	function delete_record($pfid){
		$this->db->where('pf_id',$pfid);
		$this->db->delete('tbl_pitfalls');
		return $this->db->affected_rows();
	}

	function save_pitfalls($id,$title,$note){
	
		$this->db->where('pf_id',$id);
		$this->db->set('pf_title',htmlspecialchars($title));
		$this->db->set('pf_note',strip_tags($note,'<br>'));
		$this->db->set('pf_date',date("Y-m-d"));
		$this->db->set('pf_status',1);
		$this->db->update('tbl_pitfalls');
		return $this->db->affected_rows();
	}
}
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mraquestionsmodel extends CI_Model {
	
	var $mraq_id	 	= 0;
	var $mraq_mraid 	= 0;
	var $mraq_title 	= "";
	var $mraq_note 		= "";
	var $mraq_date	 	= NULL;
	var $mraq_status 	= 0;
	var $mraq_priority	= 0;
	
	function __construct(){

		parent::__construct();
	}
	
	function record_exist($mraid){
		
		$this->db->where('mraq_mraid',$mraid);
		$query = $this->db->get('tbl_mraquestions');
		$data = $query->result_array();
		if(count($data)) return $data;
		return FALSE;
	}
	
	function read_record($mraid){
		$this->db->where('mraq_mraid',$mraid);
		$query = $this->db->get('tbl_mraquestions',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_records($mraid){
	
		$this->db->where('mraq_mraid',$mraid);
		$query = $this->db->get('tbl_mraquestions');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function insert_record($mraid,$title){
		
		$this->mraq_mraid	= $mraid;
		$this->mraq_title	= htmlspecialchars($title);
		$this->mraq_note	= "";
		$this->mraq_date	= date("Y-m-d");
		$this->mraq_status	= 0;
		$this->mraq_priority	= 0;
		
		$this->db->insert('tbl_mraquestions',$this);
	}
	
	function insert_answer($mraid,$insertdata){
		
		$this->mraq_mraid	= $mraid;
		$this->mraq_title	= htmlspecialchars($insertdata['title']);
		$this->mraq_note	= strip_tags($insertdata['note'],'<br>');
		$this->mraq_date	= date("Y-m-d");
		$this->mraq_status	= 1;
		
		$this->db->insert('tbl_mraquestions',$this);
	}
	
	function insert_empty($mraid){
		
		$this->mraq_mraid	= $mraid;
		$this->mraq_date	= date("Y-m-d");
		$this->mraq_status	= 0;
		$this->mraq_priority = 0;
		
		$this->db->insert('tbl_mraquestions',$this);
	}
	
	function read_limit_records($mraid,$limit){
	
		$this->db->where('mraq_mraid',$mraid);
		$this->db->where('mraq_status',1);
		$this->db->order_by('mraq_date','DESC');
		$this->db->order_by('mraq_id','DESC');
		$query = $this->db->get('tbl_mraquestions',$limit);
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}

	function read_select_records($mraid){
	
		$this->db->where('mraq_mraid',$mraid);
		$this->db->where('mraq_status',1);
		$this->db->where('mraq_priority',1);
		$this->db->order_by('mraq_date','DESC');
		$this->db->order_by('mraq_id','DESC');
		$query = $this->db->get('tbl_mraquestions');
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}

	function delete_record($mraqid){
		$this->db->where('mraq_id',$mraqid);
		$this->db->delete('tbl_mraquestions');
		return $this->db->affected_rows();
	}

	function save_question($mraqid,$title,$note,$priority){
	
		$this->db->where('mraq_id',$mraqid);
		$this->db->set('mraq_title',htmlspecialchars($title));
		$this->db->set('mraq_note',strip_tags($note,'<br>'));
		$this->db->set('mraq_date',date("Y-m-d"));
		$this->db->set('mraq_status',1);
		$this->db->set('mraq_priority',$priority);
		$this->db->update('tbl_mraquestions');
		return $this->db->affected_rows();
	}
}
<?php

class Commentsmodel extends CI_Model {
	
	var $cmn_id 		= 0;
	var $cmn_note 		= "";
	var $cmn_date		= "";
	var $cmn_usrid		= 0;
	var $cmn_group		= "";
	var $cmn_topid		= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record($id){
		
		$this->db->where('cmn_id',$id);
		$query = $this->db->get('tbl_comments',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($topic,$group){
	
		$this->db->select('cmn_id,cmn_note,cmn_date,cmn_usrid,');
		$this->db->where('cmn_topid',$topic);
		$this->db->where('cmn_group',$group);
		$this->db->order_by('cmn_date DESC');
		return $this->db->get('tbl_comments');
	}
	
	function insert_record($note,$usr,$group,$topic){
	
		$this->cmn_note = strip_tags($note,'<br>');
		$this->cmn_date = date("Y-m-d");
		$this->cmn_usrid = $usr;
		$this->cmn_group = $group;
		$this->cmn_topid = $topic;
		$this->db->insert('tbl_comments',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$note){
	
		$this->db->set('cmn_note',strip_tags($note,'<br>'));
		$this->db->set('cmn_date',date("Y-m-d"));
		$this->db->where('cmn_id',$id);
		$this->db->update('tbl_comments');
		return $this->db->affected_rows();
	}
	
	function delete_record($id){
	
		$this->db->where('cmn_id',$id);
		$this->db->delete('tbl_comments');
		return $this->db->affected_rows();
	}
	
	function delete_records($group,$topic){
	
		$this->db->where('cmn_group',$group);
		$this->db->where('cmn_topid',$topic);
		$this->db->delete('tbl_comments');
		return $this->db->affected_rows();
	}
	
	function count_records($topic,$group){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('cmn_group',$group);
		$this->db->where('cmn_topid',$topic);
		$query = $this->db->get('tbl_comments');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function comment_owner($id,$user){
	
		$this->db->where('cmn_id',$id);
		$this->db->where('cmn_usrid',$user);
		$query = $this->db->get('tbl_comments');
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>
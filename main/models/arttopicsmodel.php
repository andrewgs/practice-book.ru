<?php
class Arttopicsmodel extends CI_Model {
	
	var $atp_id 		= 0;
	var $atp_title 		= "";
	var $atp_note 		= "";
	var $atp_date 		= "";
	var $atp_artid		= 0;
	var $atp_usrid		= 0;
	var $atp_comments	= 0;
	var $atp_views	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record($id){
		
		$this->db->where('atp_id',$id);
		$query = $this->db->get('tbl_art_topics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($artid){
	
		$this->db->select('atp_id,atp_title,atp_note,atp_date,atp_usrid,atp_comments,atp_views');
		$this->db->where('atp_artid',$artid);
		$this->db->order_by('atp_date DESC');
		return $this->db->get('tbl_art_topics');
	}
	
	function insert_record($data,$artid,$usr){
	
		$this->atp_title 	= $data['title'];
		$this->atp_note 	= strip_tags($data['note'],'<br>');
		$this->atp_date 	= date("Y-m-d");
		$this->atp_artid 	= $artid;
		$this->atp_usrid 	= $usr;
		$this->atp_comments = 0;
		$this->db->insert('tbl_art_topics',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$data){
	
		$this->db->set('atp_title',$data['title']);
		$this->db->set('atp_note',strip_tags($data['note'],'<br>'));
		$this->db->set('atp_date',date("Y-m-d"));
		$this->db->where('atp_id',$id);
		$this->db->update('tbl_art_topics');
		return $this->db->affected_rows();
	}
	
	function delete_record($id){
	
		$this->db->where('atp_id',$id);
		$this->db->delete('tbl_art_topics');
		return $this->db->affected_rows();
	}
	
	function insert_comment($id){
		$this->db->set('atp_comments','atp_comments+1',FALSE);
		$this->db->where('atp_id',$id);
		$this->db->update('tbl_art_topics');
	}
	
	function delete_comment($id){
	
		$this->db->set('atp_comments','atp_comments-1',FALSE);
		$this->db->where('atp_id',$id);
		$this->db->update('tbl_art_topics');
	}
	function insert_view($id){
		$this->db->set('atp_views','atp_views+1',FALSE);
		$this->db->where('atp_id',$id);
		$this->db->update('tbl_art_topics');
	}
	
	function clear_view($id){
	
		$this->db->set('atp_comments',0,FALSE);
		$this->db->where('atp_id',$id);
		$this->db->update('tbl_art_topics');
	}
	
	function count_records($artid){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('atp_artid',$artid);
		$query = $this->db->get('tbl_art_topics');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function read_limit_records($count,$from,$artid){
		
		$this->db->where('atp_artid',$artid);
		$this->db->limit($count,$from);
		$this->db->order_by('atp_id DESC');
		$query = $this->db->get('tbl_art_topics');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function topic_owner($id,$artid,$usr){
		
		$this->db->where('atp_id',$id);
		$this->db->where('atp_artid',$artid);
		$this->db->where('atp_usrid',$usr);
		$query = $this->db->get('tbl_art_topics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function topic_exist($id,$artid){
		
		$this->db->where('atp_id',$id);
		$this->db->where('atp_artid',$artid);
		$query = $this->db->get('tbl_art_topics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($id,$field){
			
		$this->db->where('atp_id',$id);
		$query = $this->db->get('tbl_art_topics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
}
?>
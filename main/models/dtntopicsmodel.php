<?php
class Dtntopicsmodel extends CI_Model {
	
	var $dtt_id 		= 0;
	var $dtt_title 		= "";
	var $dtt_date 		= "";
	var $dtt_dtnid		= 0;
	var $dtt_usrid		= 0;
	var $dtt_comments	= 0;
	var $dtt_documents	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record($id){
		
		$this->db->where('dtt_id',$id);
		$query = $this->db->get('tbl_dtn_topics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($dtt_dtnid){
	
		$this->db->select('dtt_id,dtt_title,dtt_date,dtt_usrid,dtt_comments,dtt_documents');
		$this->db->where('dtt_dtnid',$dtt_dtnid);
		$this->db->order_by('dtt_date DESC');
		return $this->db->get('tbl_dtn_topics');
	}
	
	function insert_record($title,$dsc,$usr){
	
		$this->dtt_title 	= strip_tags($title,'<br>');
		$this->dtt_date 	= date("Y-m-d");
		$this->dtt_dtnid 	= $dsc;
		$this->dtt_usrid 	= $usr;
		$this->dtt_comments = 0;
		$this->dtt_documents = 0;
		$this->db->insert('tbl_dtn_topics',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$title,$userid){
	
		$this->db->set('dtt_title',strip_tags($title,'<br>'));
		$this->db->where('dtt_id',$id);
		$this->db->where('dtt_usrid',$userid);
		$this->db->update('tbl_dtn_topics');
		return $this->db->affected_rows();
	}
	
	function delete_record($id,$userid){
	
		$this->db->where('dtt_id',$id);
		$this->db->where('dtt_documents',0);
		$this->db->where('dtt_usrid',$userid);
		$this->db->delete('tbl_dtn_topics');
		return $this->db->affected_rows();
	}
	
	function insert_comment($id){
		
		$this->db->set('dtt_comments','dtt_comments+1',FALSE);
		$this->db->where('dtt_id',$id);
		$this->db->update('tbl_dtn_topics');
	}
	
	function delete_comment($id){
	
		$this->db->set('dtt_comments','dtt_comments-1',FALSE);
		$this->db->where('dtt_id',$id);
		$this->db->update('tbl_dtn_topics');
	}
	
	function insert_document($id){
	
		$this->db->set('dtt_documents','dtt_documents+1',FALSE);
		$this->db->where('dtt_id',$id);
		$this->db->update('tbl_dtn_topics');
	}
	
	function delete_document($id){
	
		$this->db->set('dtt_documents','dtt_documents-1',FALSE);
		$this->db->where('dtt_id',$id);
		$this->db->update('tbl_dtn_topics');
	}
	
	function count_records($dsc){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('dtt_dtnid',$dsc);
		$query = $this->db->get('tbl_dtn_topics');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function read_limit_records($count,$from,$dsc){
		
		$this->db->where('dtt_dtnid',$dsc);
		$this->db->limit($count,$from);
		$this->db->order_by('dtt_id DESC');
		$query = $this->db->get('tbl_dtn_topics');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function topic_owner($id,$section,$usr){
		
		$this->db->where('dtt_id',$id);
		$this->db->where('dtt_dtnid',$section);
		$this->db->where('dtt_usrid',$usr);
		$query = $this->db->get('tbl_dtn_topics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function topic_exist($id,$section){
		
		$this->db->where('dtt_id',$id);
		$this->db->where('dtt_dtnid',$section);
		$query = $this->db->get('tbl_dtn_topics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($topic,$field){
			
		$this->db->where('dtt_id',$topic);
		$query = $this->db->get('tbl_dtn_topics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
}
?>
<?php
class Surtopicsmodel extends CI_Model {
	
	var $stp_id 		= 0;
	var $stp_title 		= "";
	var $stp_clicks		= "";
	var $stp_date 		= "";
	var $stp_surid		= 0;
	var $stp_usrid		= 0;
	var $stp_comments	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record($id){
		
		$this->db->where('stp_id',$id);
		$query = $this->db->get('tbl_surtopics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($stp_surid){
	
		$this->db->select('stp_id,stp_title,stp_note,stp_date,stp_usrid,stp_comments');
		$this->db->where('stp_surid',$stp_surid);
		$this->db->order_by('stp_date DESC');
		return $this->db->get('tbl_surtopics');
	}
	
	function insert_record($title,$sur,$usr){
	
		$this->stp_title = strip_tags($title,'<br>');
		$this->stp_date = date("Y-m-d");
		$this->stp_surid = $sur;
		$this->stp_usrid = $usr;
		$this->stp_comments = 0;
		$this->db->insert('tbl_surtopics',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$title,$userid){
	
		$this->db->set('stp_title',strip_tags($title,'<br>'));
		$this->db->where('stp_id',$id);
		$this->db->where('stp_usrid',$userid);
		$this->db->update('tbl_surtopics');
		return $this->db->affected_rows();
	}
	
	function delete_record($id,$userid){
	
		$this->db->where('stp_id',$id);
		$this->db->where('stp_usrid',$userid);
		$this->db->delete('tbl_surtopics');
		return $this->db->affected_rows();
	}
	
	function insert_comment($id){
		$this->db->set('stp_comments','stp_comments+1',FALSE);
		$this->db->where('stp_id',$id);
		$this->db->update('tbl_surtopics');
	}
	
	function delete_comment($id){
	
		$this->db->set('stp_comments','stp_comments-1',FALSE);
		$this->db->where('stp_id',$id);
		$this->db->update('tbl_surtopics');
	}
	function insert_click($id){
		$this->db->set('stp_clicks','stp_clicks+1',FALSE);
		$this->db->where('stp_id',$id);
		$this->db->update('tbl_surtopics');
	}
	
	function delete_click($id){
	
		$this->db->set('stp_clicks','stp_clicks-1',FALSE);
		$this->db->where('stp_id',$id);
		$this->db->update('tbl_surtopics');
	}
	
	function count_records($sur){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('stp_surid',$sur);
		$query = $this->db->get('tbl_surtopics');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function read_limit_records($count,$from,$dsc){
		
		$this->db->where('stp_surid',$dsc);
		$this->db->limit($count,$from);
		$this->db->order_by('stp_id DESC');
		$query = $this->db->get('tbl_surtopics');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function topic_owner($id,$section,$usr){
		
		$this->db->where('stp_id',$id);
		$this->db->where('stp_surid',$section);
		$this->db->where('stp_usrid',$usr);
		$query = $this->db->get('tbl_surtopics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function topic_exist($id,$section){
		
		$this->db->where('stp_id',$id);
		$this->db->where('stp_surid',$section);
		$query = $this->db->get('tbl_surtopics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($topic,$field){
			
		$this->db->where('stp_id',$topic);
		$query = $this->db->get('tbl_surtopics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
}
?>
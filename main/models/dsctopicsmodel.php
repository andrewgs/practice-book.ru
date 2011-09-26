<?php
class Dsctopicsmodel extends CI_Model {
	
	var $top_id 		= 0;
	var $top_title 		= "";
	var $top_note 		= "";
	var $top_date 		= "";
	var $top_dscid		= 0;
	var $top_usrid		= 0;
	var $top_comments	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record($id){
		
		$this->db->where('top_id',$id);
		$query = $this->db->get('tbl_dsc_topics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($top_dscid){
	
		$this->db->select('top_id,top_title,top_note,top_date,top_usrid,top_comments');
		$this->db->where('top_dscid',$top_dscid);
		$this->db->order_by('top_date DESC');
		return $this->db->get('tbl_dsc_topics');
	}
	
	function insert_records($data,$dsc,$usr){
	
		$this->top_title = $data['title'];
		$this->top_note = strip_tags($data['note'],'<br>');
		$this->top_date = date("Y-m-d");
		$this->top_dscid = $dsc;
		$this->top_usrid = $usr;
		$this->top_comments = 0;
		$this->db->insert('tbl_dsc_topics',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data,$usrid){
	
		$this->db->set('top_title',$data['title']);
		$this->db->set('top_note',strip_tags($data['note'],'<br>'));
		$this->db->where('top_id',$id);
		$this->db->where('top_usrid',$usrid);
		$this->db->update('tbl_dsc_topics');
		return $this->db->affected_rows();
	}
	
	function delete_record($id,$usrid){
	
		$this->db->where('top_id',$id);
		$this->db->where('top_usrid',$usrid);
		$this->db->delete('tbl_dsc_topics');
		return $this->db->affected_rows();
	}
	
	function insert_comment($id){
		$this->db->set('top_comments','top_comments+1',FALSE);
		$this->db->where('top_id',$id);
		$this->db->update('tbl_dsc_topics');
	}
	
	function delete_comment($id){
	
		$this->db->set('top_comments','top_comments-1',FALSE);
		$this->db->where('top_id',$id);
		$this->db->update('tbl_dsc_topics');
	}
	
	function count_records($dsc){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('top_dscid',$dsc);
		$query = $this->db->get('tbl_dsc_topics');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function read_limit_records($count,$from,$dsc){
		
		$this->db->where('top_dscid',$dsc);
		$this->db->limit($count,$from);
		$this->db->order_by('top_id DESC');
		$query = $this->db->get('tbl_dsc_topics');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function topic_owner($id,$section,$usr){
		
		$this->db->where('top_id',$id);
		$this->db->where('top_dscid',$section);
		$this->db->where('top_usrid',$usr);
		$query = $this->db->get('tbl_dsc_topics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function topic_exist($id,$section){
		
		$this->db->where('top_id',$id);
		$this->db->where('top_dscid',$section);
		$query = $this->db->get('tbl_dsc_topics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($topic,$field){
			
		$this->db->where('top_id',$topic);
		$query = $this->db->get('tbl_dsc_topics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
}
?>
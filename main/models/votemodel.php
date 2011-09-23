<?php
class Votemodel extends CI_Model {
	
	var $vt_id 		= 0;
	var $vt_title 	= "";
	var $vt_stpid	= 0;
	var $vt_count	= 0;
	var $vt_percent	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record($id){
		
		$this->db->where('vt_id',$id);
		$query = $this->db->get('tbl_vote',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($stpid){
	
		$this->db->select('vt_id,vt_title,vt_count,vt_percent');
		$this->db->where('vt_stpid',$stpid);
		$query = $this->db->get('tbl_vote');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function insert_records($data,$sur,$usr){
	
		$this->vt_title = $data['title'];
		$this->vt_note = $data['note'];
		$this->vt_date = date("Y-m-d");
		$this->vt_surid = $sur;
		$this->vt_usrid = $usr;
		$this->vt_comments = 0;
		$this->db->insert('tbl_vote',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data){
	
		$this->db->set('vt_title',$data['title']);
		$this->db->set('vt_date',date("Y-m-d"));
		$this->db->where('vt_id',$id);
		$this->db->update('tbl_vote');
		return $this->db->affected_rows();
	}
	
	function delete_records($id){
	
		$this->db->where('vt_id',$id);
		$this->db->delete('tbl_vote');
		return $this->db->affected_rows();
	}
	
	function insert_comments($id){
		$this->db->set('vt_comments','vt_comments+1',FALSE);
		$this->db->where('vt_id',$id);
		$this->db->update('tbl_vote');
	}
	
	function delete_comments($id){
	
		$this->db->set('vt_comments','vt_comments-1',FALSE);
		$this->db->where('vt_id',$id);
		$this->db->update('tbl_vote');
	}
	function insert_click($id){
		$this->db->set('vt_clicks','vt_clicks+1',FALSE);
		$this->db->where('vt_id',$id);
		$this->db->update('tbl_vote');
	}
	
	function delete_click($id){
	
		$this->db->set('vt_clicks','vt_clicks-1',FALSE);
		$this->db->where('vt_id',$id);
		$this->db->update('tbl_vote');
	}
	
	function count_records($sur){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('vt_surid',$sur);
		$query = $this->db->get('tbl_vote');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function read_limit_records($count,$from,$dsc){
		
		$this->db->where('vt_surid',$dsc);
		$this->db->limit($count,$from);
		$this->db->order_by('vt_id DESC');
		$query = $this->db->get('tbl_vote');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function owner($id,$section,$usr){
		
		$this->db->where('vt_id',$id);
		$this->db->where('vt_surid',$section);
		$this->db->where('vt_usrid',$usr);
		$query = $this->db->get('tbl_vote',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function topic_exist($id,$section){
		
		$this->db->where('vt_id',$id);
		$this->db->where('vt_surid',$section);
		$query = $this->db->get('tbl_vote',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($topic,$field){
			
		$this->db->where('vt_id',$topic);
		$query = $this->db->get('tbl_vote',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
}
?>
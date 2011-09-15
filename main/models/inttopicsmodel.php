<?php
class Inttopicsmodel extends CI_Model {
	
	var $itp_id 		= 0;
	var $itp_title 		= "";
	var $itp_note 		= "";
	var $itp_date 		= "";
	var $itp_intid		= 0;
	var $itp_usrid		= 0;
	var $itp_comments	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record($id){
		
		$this->db->where('itp_id',$id);
		$query = $this->db->get('tbl_inttopics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($itp_intid){
	
		$this->db->select('itp_id,itp_title,itp_note,itp_date,itp_usrid,itp_comments');
		$this->db->where('itp_intid',$itp_intid);
		$this->db->order_by('itp_date DESC');
		return $this->db->get('tbl_inttopics');
	}
	
	function insert_records($data,$dsc,$usr){
	
		$this->itp_title = $data['title'];
		$this->itp_note = $data['note'];
		$this->itp_date = date("Y-m-d");
		$this->itp_intid = $dsc;
		$this->itp_usrid = $usr;
		$this->itp_comments = 0;
		$this->db->insert('tbl_inttopics',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data){
	
		$this->db->set('itp_title',$data['title']);
		$this->db->set('itp_note',$data['note']);
		$this->db->set('itp_date',date("Y-m-d"));
		$this->db->where('itp_id',$id);
		$this->db->update('tbl_inttopics');
		return $this->db->affected_rows();
	}
	
	function delete_records($id){
	
		$this->db->where('itp_id',$id);
		$this->db->delete('tbl_inttopics');
		return $this->db->affected_rows();
	}
	
	function insert_comments($id){
		$this->db->set('itp_comments','itp_comments+1',FALSE);
		$this->db->where('itp_id',$id);
		$this->db->update('tbl_inttopics');
	}
	
	function delete_comments($id){
	
		$this->db->set('itp_comments','itp_comments-1',FALSE);
		$this->db->where('itp_id',$id);
		$this->db->update('tbl_inttopics');
	}
	
	function count_records($dsc){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('itp_intid',$dsc);
		$query = $this->db->get('tbl_inttopics');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function read_limit_records($count,$from,$dsc){
		
		$this->db->where('itp_intid',$dsc);
		$this->db->limit($count,$from);
		$this->db->order_by('itp_id DESC');
		$query = $this->db->get('tbl_inttopics');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function owner($id,$section,$usr){
		
		$this->db->where('itp_id',$id);
		$this->db->where('itp_intid',$section);
		$this->db->where('itp_usrid',$usr);
		$query = $this->db->get('tbl_inttopics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function topic_exist($id,$section){
		
		$this->db->where('itp_id',$id);
		$this->db->where('itp_intid',$section);
		$query = $this->db->get('tbl_inttopics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($topic,$field){
			
		$this->db->where('itp_id',$topic);
		$query = $this->db->get('tbl_inttopics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
}
?>
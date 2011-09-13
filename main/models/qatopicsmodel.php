<?php
class Qatopicsmodel extends CI_Model {
	
	var $qat_id 		= 0;
	var $qat_title 		= "";
	var $qat_date 		= "";
	var $qat_dscid		= 0;
	var $qat_usrid		= 0;
	var $qat_comments	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record($id){
		
		$this->db->where('qat_id',$id);
		$query = $this->db->get('tbl_qa_topics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($qaid){
	
		$this->db->select('qat_id,qat_title,qat_date,qat_usrid,qat_comments');
		$this->db->where('qat_qaid',$qaid);
		$this->db->order_by('qat_date DESC');
		return $this->db->get('tbl_qa_topics');
	}
	
	function insert_records($data,$qaid,$usr){
	
		$this->qat_title = $data['title'];
		$this->qat_date = date("Y-m-d");
		$this->qat_qaid = $qaid;
		$this->qat_usrid = $usr;
		$this->qat_comments = 0;
		$this->db->insert('tbl_qa_topics',$this);
		return $this->db->insert_id();
	}
	
	function update_records($id,$data){
	
		$this->db->set('qat_title',$data['title']);
		$this->db->set('qat_date',date("Y-m-d"));
		$this->db->where('qat_id',$id);
		$this->db->update('tbl_qa_topics');
		return $this->db->affected_rows();
	}
	
	function delete_records($id){
	
		$this->db->where('qat_id',$id);
		$this->db->delete('tbl_qa_topics');
		return $this->db->affected_rows();
	}
	
	function insert_comments($id){
		$this->db->set('qat_comments','qat_comments+1',FALSE);
		$this->db->where('qat_id',$id);
		$this->db->update('tbl_qa_topics');
	}
	
	function delete_comments($id){
	
		$this->db->set('qat_comments','qat_comments-1',FALSE);
		$this->db->where('qat_id',$id);
		$this->db->update('tbl_qa_topics');
	}
	
	function count_records($qaid){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('qat_qaid',$qaid);
		$query = $this->db->get('tbl_qa_topics');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function read_limit_records($count,$from,$qaid){
		
		$this->db->where('qat_qaid',$qaid);
		$this->db->limit($count,$from);
		$this->db->order_by('qat_id DESC');
		$query = $this->db->get('tbl_qa_topics');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function owner($id,$qaid,$usr){
		
		$this->db->where('qat_id',$id);
		$this->db->where('qat_qaid',$qaid);
		$this->db->where('qat_usrid',$usr);
		$query = $this->db->get('tbl_qa_topics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function topic_exist($id,$qaid){
		
		$this->db->where('qat_id',$id);
		$this->db->where('qat_qaid',$qaid);
		$query = $this->db->get('tbl_qa_topics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($topic,$field){
			
		$this->db->where('qat_id',$topic);
		$query = $this->db->get('tbl_qa_topics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
}
?>